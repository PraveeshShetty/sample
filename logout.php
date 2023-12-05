<?php
session_start();
session_destroy();
header("Location:../viproject/signinup/login.php")
?>