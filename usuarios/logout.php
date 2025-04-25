<?php
session_start();
session_unset();
session_destroy();
header("Location: /DANA_G1/index.php");
exit();