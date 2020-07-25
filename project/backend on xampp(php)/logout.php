<?php
require_once("userAttend.php");
//logout.php

setcookie("data", '', time() -3600);
header(401);
exit();

?>
