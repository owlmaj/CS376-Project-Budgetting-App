<?php
require('user_class.php');

$user = new User("", "", 0);
$user->logout();
//session destroy and redirect handled in logout;

exit();
?>
