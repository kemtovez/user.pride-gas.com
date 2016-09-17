<?php
session_start();
if (isset($_SESSION['id'])){
    require_once("../cont/info.php");
    require_once("../temp/header.php");

if (file_exists("temp/headers/".$params[0]."-header.php")) {
    require_once("temp/headers/".$params[0]."-header.php");
}
    require_once( "../temp/top_block.php");
    require_once( "../temp/".$params[0].".php");
    require_once( "../temp/footer_block.php");
} else {
    require_once("../modules/login.php");
}
