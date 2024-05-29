<?php
session_start(); //bắt đầu phiên làm việc
require_once"./MVC/Bridge.php";
$myApp = new Application(); // tạo 1 đối tượng myApp của đối tượng Application nằm trong thư mục processing
?>