<?php 

require "src/start.php";


// var_dump($user);


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php if($user['member']): ?>
	you are member
<?php else: ?>
    you are not member
    <?php //echo __DIR__. '/../vendor/autoload.php'; ?>
<?php endif; ?>


</body>
</html>

