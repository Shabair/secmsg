<?php

function set_data($data){
	$CI = &get_instance();
	// set data member of class
	$CI->data = $data;
}



function get_data($str,$file = false){// second para for switch
	$CI = &get_instance();
	if(!$file){
		return (set_value('submit') || set_value('update'))?set_value($str):((isset($CI->data[$str]))?$CI->data[$str]:'');

		// return (set_value($str))?set_value($str):((isset($CI->data[$str]))?$CI->data[$str]:'');
	}else{		// if switch unchecked
		// die('hvj');
		return (set_value($str))?set_value($str):((isset($CI->data[$str]))?$CI->data[$str]:'');
	}
}

function url_generator($URLlength = 8){
	$charray = array_merge(range('a','z'), range('0','9'));
    $max = count($charray) - 1;
    $url = '';
    for ($i = 0; $i < $URLlength; $i++) {
        $randomChar = mt_rand(0, $max);
        $url .= $charray[$randomChar];
    }

    return strtoupper($url);
}


function get_country($abb = false){
	$countries = [
		'AF' => 'AFGHANISTAN',
		'AL' => 'ALBANIA',
		'DZ' => 'ALGERIA',
		'AS' => 'AMERICAN SAMOA',
		'AD' => 'ANDORRA',
		'AO' => 'ANGOLA',
		'AI' => 'ANGUILLA',
		'AQ' => 'ANTARCTICA',
		'AG' => 'ANTIGUA AND BARBUDA',
		'AR' => 'ARGENTINA',
		'AM' => 'ARMENIA',
		'AW' => 'ARUBA',
		'AU' => 'AUSTRALIA',
		'AT' => 'AUSTRIA',
		'AZ' => 'AZERBAIJAN',
		'BS' => 'BAHAMAS',
		'BH' => 'BAHRAIN',
		'BD' => 'BANGLADESH',
		'BB' => 'BARBADOS',
		'BY' => 'BELARUS',
		'BE' => 'BELGIUM',
		'BZ' => 'BELIZE',
		'BJ' => 'BENIN',
		'BM' => 'BERMUDA',
		'BT' => 'BHUTAN',
		'BO' => 'BOLIVIA',
		'BA' => 'BOSNIA AND HERZEGOVINA',
		'BW' => 'BOTSWANA',
		'BV' => 'BOUVET ISLAND',
		'BR' => 'BRAZIL',
		'IO' => 'BRITISH INDIAN OCEAN TERRITORY',
		'BN' => 'BRUNEI DARUSSALAM',
		'BG' => 'BULGARIA',
		'BF' => 'BURKINA FASO',
		'BI' => 'BURUNDI',
		'KH' => 'CAMBODIA',
		'CM' => 'CAMEROON',
		'CA' => 'CANADA',
		'CV' => 'CAPE VERDE',
		'KY' => 'CAYMAN ISLANDS',
		'CF' => 'CENTRAL AFRICAN REPUBLIC',
		'TD' => 'CHAD',
		'CL' => 'CHILE',
		'CN' => 'CHINA',
		'CX' => 'CHRISTMAS ISLAND',
		'CC' => 'COCOS (KEELING) ISLANDS',
		'CO' => 'COLOMBIA',
		'KM' => 'COMOROS',
		'CG' => 'CONGO',
		'CD' => 'CONGO, THE DEMOCRATIC REPUBLIC OF',
		'CK' => 'COOK ISLANDS',
		'CR' => 'COSTA RICA',
		'CI' => 'CÔTE D\'IVOIRE',
		'HR' => 'CROATIA',
		'CU' => 'CUBA',
		'CY' => 'CYPRUS',
		'CZ' => 'CZECH REPUBLIC',
		'DK' => 'DENMARK',
		'DJ' => 'DJIBOUTI',
		'DM' => 'DOMINICA',
		'DO' => 'DOMINICAN REPUBLIC',
		'EC' => 'ECUADOR',
		'EG' => 'EGYPT',
		'SV' => 'EL SALVADOR',
		'GQ' => 'EQUATORIAL GUINEA',
		'ER' => 'ERITREA',
		'EE' => 'ESTONIA',
		'ET' => 'ETHIOPIA',
		'FK' => 'FALKLAND ISLANDS (MALVINAS)',
		'FO' => 'FAROE ISLANDS',
		'FJ' => 'FIJI',
		'FI' => 'FINLAND',
		'FR' => 'FRANCE',
		'GF' => 'FRENCH GUIANA',
		'PF' => 'FRENCH POLYNESIA',
		'TF' => 'FRENCH SOUTHERN TERRITORIES',
		'GA' => 'GABON',
		'GM' => 'GAMBIA',
		'GE' => 'GEORGIA',
		'DE' => 'GERMANY',
		'GH' => 'GHANA',
		'GI' => 'GIBRALTAR',
		'GR' => 'GREECE',
		'GL' => 'GREENLAND',
		'GD' => 'GRENADA',
		'GP' => 'GUADELOUPE',
		'GU' => 'GUAM',
		'GT' => 'GUATEMALA',
		'GN' => 'GUINEA',
		'GW' => 'GUINEA-BISSAU',
		'GY' => 'GUYANA',
		'HT' => 'HAITI',
		'HM' => 'HEARD ISLAND AND MCDONALD ISLANDS',
		'HN' => 'HONDURAS',
		'HK' => 'HONG KONG',
		'HU' => 'HUNGARY',
		'IS' => 'ICELAND',
		'IN' => 'INDIA',
		'ID' => 'INDONESIA',
		'IR' => 'IRAN, ISLAMIC REPUBLIC OF',
		'IQ' => 'IRAQ',
		'IE' => 'IRELAND',
		'IL' => 'ISRAEL',
		'IT' => 'ITALY',
		'JM' => 'JAMAICA',
		'JP' => 'JAPAN',
		'JO' => 'JORDAN',
		'KZ' => 'KAZAKHSTAN',
		'KE' => 'KENYA',
		'KI' => 'KIRIBATI',
		'KP' => 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF',
		'KR' => 'KOREA, REPUBLIC OF',
		'KW' => 'KUWAIT',
		'KG' => 'KYRGYZSTAN',
		'LA' => 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC',
		'LV' => 'LATVIA',
		'LB' => 'LEBANON',
		'LS' => 'LESOTHO',
		'LR' => 'LIBERIA',
		'LY' => 'LIBYAN ARAB JAMAHIRIYA',
		'LI' => 'LIECHTENSTEIN',
		'LT' => 'LITHUANIA',
		'LU' => 'LUXEMBOURG',
		'MO' => 'MACAO',
		'MK' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
		'MG' => 'MADAGASCAR',
		'MW' => 'MALAWI',
		'MY' => 'MALAYSIA',
		'MV' => 'MALDIVES',
		'ML' => 'MALI',
		'MT' => 'MALTA',
		'MH' => 'MARSHALL ISLANDS',
		'MQ' => 'MARTINIQUE',
		'MR' => 'MAURITANIA',
		'MU' => 'MAURITIUS',
		'YT' => 'MAYOTTE',
		'MX' => 'MEXICO',
		'FM' => 'MICRONESIA, FEDERATED STATES OF',
		'MD' => 'MOLDOVA, REPUBLIC OF',
		'MC' => 'MONACO',
		'MN' => 'MONGOLIA',
		'MS' => 'MONTSERRAT',
		'MA' => 'MOROCCO',
		'MZ' => 'MOZAMBIQUE',
		'MM' => 'MYANMAR',
		'NA' => 'NAMIBIA',
		'NR' => 'NAURU',
		'NP' => 'NEPAL',
		'NL' => 'NETHERLANDS',
		'AN' => 'NETHERLANDS ANTILLES',
		'NC' => 'NEW CALEDONIA',
		'NZ' => 'NEW ZEALAND',
		'NI' => 'NICARAGUA',
		'NE' => 'NIGER',
		'NG' => 'NIGERIA',
		'NU' => 'NIUE',
		'NF' => 'NORFOLK ISLAND',
		'MP' => 'NORTHERN MARIANA ISLANDS',
		'NO' => 'NORWAY',
		'OM' => 'OMAN',
		'PK' => 'PAKISTAN',
		'PW' => 'PALAU',
		'PS' => 'PALESTINIAN TERRITORY, OCCUPIED',
		'PA' => 'PANAMA',
		'PG' => 'PAPUA NEW GUINEA',
		'PY' => 'PARAGUAY',
		'PE' => 'PERU',
		'PH' => 'PHILIPPINES',
		'PN' => 'PITCAIRN',
		'PL' => 'POLAND',
		'PT' => 'PORTUGAL',
		'PR' => 'PUERTO RICO',
		'QA' => 'QATAR',
		'RE' => 'RÉUNION',
		'RO' => 'ROMANIA',
		'RU' => 'RUSSIAN FEDERATION',
		'RW' => 'RWANDA',
		'SH' => 'SAINT HELENA',
		'KN' => 'SAINT KITTS AND NEVIS',
		'LC' => 'SAINT LUCIA',
		'PM' => 'SAINT PIERRE AND MIQUELON',
		'VC' => 'SAINT VINCENT AND THE GRENADINES',
		'WS' => 'SAMOA',
		'SM' => 'SAN MARINO',
		'ST' => 'SAO TOME AND PRINCIPE',
		'SA' => 'SAUDI ARABIA',
		'SN' => 'SENEGAL',
		'CS' => 'SERBIA AND MONTENEGRO',
		'SC' => 'SEYCHELLES',
		'SL' => 'SIERRA LEONE',
		'SG' => 'SINGAPORE',
		'SK' => 'SLOVAKIA',
		'SI' => 'SLOVENIA',
		'SB' => 'SOLOMON ISLANDS',
		'SO' => 'SOMALIA',
		'ZA' => 'SOUTH AFRICA',
		'GS' => 'SOUTH GEORGIA AND SOUTH SANDWICH ISLANDS',
		'ES' => 'SPAIN',
		'LK' => 'SRI LANKA',
		'SD' => 'SUDAN',
		'SR' => 'URINAME',
		'SJ' => 'SVALBARD AND JAN MAYEN',
		'SZ' => 'SWAZILAND',
		'SE' => 'SWEDEN',
		'CH' => 'SWITZERLAND',
		'SY' => 'SYRIAN ARAB REPUBLIC',
		'TW' => 'TAIWAN, PROVINCE OF CHINA',
		'TJ' => 'TAJIKISTAN',
		'TZ' => 'TANZANIA, UNITED REPUBLIC OF',
		'TH' => 'THAILAND',
		'TL' => 'TIMOR-LESTE',
		'TG' => 'TOGO',
		'TK' => 'TOKELAU',
		'TO' => 'TONGA',
		'TT' => 'TRINIDAD AND TOBAGO',
		'TN' => 'TUNISIA',
		'TR' => 'TURKEY',
		'TM' => 'TURKMENISTAN',
		'TC' => 'TURKS AND CAICOS ISLANDS',
		'TV' => 'TUVALU',
		'UG' => 'UGANDA',
		'UA' => 'UKRAINE',
		'AE' => 'UNITED ARAB EMIRATES',
		'GB' => 'UNITED KINGDOM',
		'US' => 'UNITED STATES',
		'UM' => 'UNITED STATES MINOR OUTLYING ISLANDS',
		'UY' => 'URUGUAY',
		'UZ' => 'UZBEKISTAN',
		'VU' => 'VANUATU',
		'VN' => 'VIET NAM',
		'VG' => 'VIRGIN ISLANDS, BRITISH',
		'VI' => 'VIRGIN ISLANDS, U.S.',
		'WF' => 'WALLIS AND FUTUNA',
		'EH' => 'WESTERN SAHARA',
		'YE' => 'YEMEN',
		'ZW' => 'ZIMBABWE'

	];
	if($abb != false){

		return ((!empty($countries[$abb]))?$countries[$abb]:false);
	}else{
		return $countries;
	}
}

/*
echo $statsdecode['ip']."<br />";
echo $statsdecode['country']."<br />";
echo $statsdecode['region']."<br />";
echo $statsdecode['city']."<br />";
echo $statsdecode['postal']."<br />";
echo $statsdecode['loc']."<br />";
*/

function getIpInfo($index = NULL){
	$getstats = ('http://ipinfo.io/json');
	$parsestats = file_get_contents($getstats);
	$statsdecode = json_decode($parsestats,true);
	if($index === NULL){
		return $statsdecode;
	}else{
		return $statsdecode[$index];
	}
}

function getTimeByServer($time){

	$datetime = new DateTime($time);
	$la_time = new DateTimeZone('Asia/Karachi');
	$datetime->setTimezone($la_time);
	$endtime =  $datetime->format('h:i:sa');
	return $endtime;
}

function getResult($sql){
	$CI = &get_instance();
	$result = $CI->db->query($sql);
	if($result->num_rows() > 0){
		return $result->result();
	}else{
		return false;
	}
}

function getSingleResult($sql){
	$CI = &get_instance();
	$result = $CI->db->query($sql);
	if($result->num_rows() > 0){
		return $result->row();
	}else{
		return false;
	}
}

function errorPage(){
	$CI = &get_instance();
	$data = [
		"title" => "Error",
		"view" => "error"
	];
	$CI->load->view("user/layout",$data);
}

function userExist($userId){
	$CI = &get_instance();
	$result = $CI->db->select('id')->where('id',$userId)->get('users')->row();
	if(empty($result)){
		return false;
	}else{
		return true;
	}
}


function textEncrypt($text){
	$CI = &get_instance();
	$CI->load->library('encryption','enc');
	return $CI->encryption->encrypt($text);
}

function textDecrypt($ciphertext){
	$CI = &get_instance();
	$CI->load->library('encryption','enc');
	return $CI->encryption->decrypt($ciphertext);
}


function msgPage($text){
	$CI = &get_instance();
	$data = [
		'title'	=>	'Error',
		'text'	=>	$text
	];
	$CI->load->view('msgpage',$data);
	return 0;
}


function message_meta($url,$data = null){

	$CI = &get_instance();
	$message_meta =  $CI->db->select('*')->where('url',$url)->where('key',$data['key'])->get('message_meta');
	if($data !== null){

		if($message_meta->num_rows() > 0){
			$CI->db->where('url', $url);
			$CI->db->update('message_meta', $data);
		}else{
			$data['url'] = $url;
			$CI->db->insert('message_meta',$data);
		}

	}else{

		return $CI->db->select('*')->where('url',$url)->get('message_meta')->result();

	}

}

function delete_message_meta($url,$key){
	$CI = &get_instance();

	$CI->db->where('url', $url);
	$CI->db->where('key', $key);
	$CI->db->delete('message_meta');

}