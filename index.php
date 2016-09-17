<?php
$params = array();
// получили строку
$query_string = str_replace("q=","",trim($_SERVER['QUERY_STRING']));
// на всякий случай декодируем
$query_string = urldecode($query_string);
 // разбиваем на массив
$query_params = explode("/",$query_string);
 // и проверяем
// а вдруг в конец слеш не дописали?
// да и почистим сразу от SQL-инъекций
foreach ($query_params as $query_param)
  if ($query_param != "")
  $params[] = $query_param;
 // if (file_exists('cont/bd_user.php')) { // установка
require_once ("cont/bd_user.php"); 
require_once ("cont/settings.php"); 
// посмотрим что получилось
if (isset($params[0])){
if (file_exists("modules/".$params[0].".php")) {
	require_once("modules/".$params[0].".php");
	require_once("cont/cheak.php"); // проверки	
  }  else {
  require_once("modules/404.php");
  }
  } else {
  //header('Location: http://cms.freebiz.pro');
  require_once("modules/login.php");
  }; // конец проверки 
  
 // } else {
//require_once("_install_/install.php");
//}
 ?>
