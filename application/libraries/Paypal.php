<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once "./assets/plugins/paypal/vendor/autoload.php";




use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;

class paypal{
	  private $api;
    public $config;

    public function __construct()
    {
        $this->api = new ApiContext(
          new OAuthTokenCredential(
            'ARVJXtDK2gzQHhMQHwmwH6U3IXPHWcX4GTCQz0HG6HPYxYcmuTy4BaoSthx1-FhMGDVB5LhB7jYHqMJT',
            'EMzXnWR-_iVyASTACxa4f0l6nudxgmqiowqkCR23VLGc_AhcM29DSUwS9RhVXt1WoTTADmo7IXZKZKej'
          )
        );

        $this->api->setConfig([
          'mode' => 'sandbox',
          'http.ConnectionTimeOut'=>30,
          'log.LogEnabled'=>false,
          'log.FileName'=> '',
          'log.LogLevel'=>'DEBUG',
          'validation.level'=>'log'

        ]);
    }

    function paypalLink($name,$price,$sku,$quantity = 1,$tax = 0.0,$shipping = 0.0){

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item1 = new Item();
        $item1->setName($name)
            ->setCurrency('USD')
            ->setQuantity($quantity)
            ->setSku($sku) // Similar to `item_number` in Classic API
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));
        // payer

        $total = $price;

        $details = new Details();
        $details->setSubtotal($price);

        //amount
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total)
            ->setDetails($details);



        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description");

        //payment
        $redirectUrls = new RedirectUrls();

        $redirectUrls->setReturnUrl(base_url().'payment/approval/?approved=true')
        ->setCancelUrl(base_url().'payment/approval/?approved=false');



        $payment = new Payment();
        $payment->setIntent("sale")
          ->setPayer($payer)
          ->setRedirectUrls($redirectUrls)
          ->setTransactions(array($transaction));

        $request = clone $payment;



        try{

          $payment->create($this->api);
        // $hash = md5($payment->getId());
        // //generate and store hash 
        // //prepare and execute transaction
        // $sql = "INSERT INTO paypal_trans (user_id, payment_id, hash,complete)
        //  VALUES ('".$_SESSION['user_id']."', '".$payment->getId()."', '".$hash."','0')";

        //  if (mysqli_query($conn, $sql)) {
        //      echo "New record created successfully";
        //  } else {
        //      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        //  }

      }catch(\PayPal\Exception\PayPalConnectionException $e){
         echo $ex;
        // header('location:'.site_url().'/error.php');
      }



      //wordpress
      $payment_id = $payment->getId();
      $hash = md5($payment_id);

        
      // add_user_meta($user_id,'buy_package',0,true);
      $data= ['link'=>$payment->getApprovalLink(),'hash'=>$hash];
      return $data;
    }

    function userPayment(){
      if(isset($_POST['user_payment_submit']) && wp_verify_nonce($_POST['user_payment_nonce'], 'user-payment-nonce')) { 
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sku = $_POST['sku'];


        $user_id = get_current_user_id();

        $data= paypalLink($name,$price,$sku);


        

        if(!empty($packages = get_user_meta($user_id,'packages',true))){
          $packages = unserialize($packages);
          $packages[$sku] = ['hash'=> $data['hash'],'buy'=>null];
        }else{
          $packages = [];
          $packages[$sku] =['hash'=> $data['hash'],'buy'=>null];
        }

        if($sku == '1000'){

          if(isset($_POST['jump']))
            $packages[$_POST['jump']] = ['hash'=> $data['hash'].$_POST['jump'],'buy'=>null];
          if(isset($_POST['turn']))
            $packages[$_POST['turn']] = ['hash'=> $data['hash'].$_POST['turn'],'buy'=>null];
          if(isset($_POST['leg']))
            $packages[$_POST['leg']] = ['hash'=> $data['hash'].$_POST['leg'],'buy'=>null];

        }

        $packages = serialize($packages);
        update_user_meta($user_id,'packages',$packages);

        wp_redirect($data['link']);
        exit;
      }
    }

    function payment_success($payment_id){

      $user_id = get_current_user_id();

      $paymentidhash = md5($payment_id);

      if(!empty($packages = get_user_meta($user_id,'packages',true))){
        $packages = unserialize($packages);
        // $packages[$sku] = ['hash'=> $data['hash'],'buy'=>null];

        foreach ($packages as $key => $package) {
          if($key == '1000'){
            $isBuy = false;
            $skillSubCat = ['1001','1002','1003'];
            for ($i=0; $i < count($skillSubCat); $i++) { 
              if($packages[$skillSubCat[$i]]['hash'] == $paymentidhash.$skillSubCat[$i]){
                $packages[$skillSubCat[$i]]['buy'] = 1;
                $isBuy =true;
              }
            }
            if($isBuy){
              update_user_meta($user_id,'packages',serialize($packages));
              return true;
              break;
            }
          }else{
            if($package['hash'] == $paymentidhash){
              $packages[$key]['buy'] = 1;
              update_user_meta($user_id,'packages',serialize($packages));
              return true;
              break;
            }
          }

        }
        return false;
      }
    }

}// CLASS END