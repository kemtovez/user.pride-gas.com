<?php
session_start();
include ("../cont/bd_user.php");
$data2 = array();
$my_id = $_SESSION['id'];

$data = htmlspecialchars($_POST['data']);
$data = mysqli_real_escape_string($link, $data);

$id_car = htmlspecialchars($_POST['id_car']);
$id_car = mysqli_real_escape_string($link, $id_car);

$type = htmlspecialchars($_POST['type']);
$type = mysqli_real_escape_string($link, $type);

$sity = htmlspecialchars($_POST['sity']);
$sity = mysqli_real_escape_string($link, $sity);

$time = strtotime($data);

//-------------------
if($type=='1') {
      $need_post = 0;
      $name = 'ТО';
}
if($type=='2') {
      $need_post = 0;
      $name = 'Гарантийное обслуживание';
}
if($type=='3') {
      $need_post = 0;
      $name = 'Ремонт';
}


$query0="INSERT INTO `srm_works` (`id_user`, `id_car`, `type`, `name`, `sity`, `need_post`)
					    VALUES ('$my_id', '$id_car', '$type', '$name', '$sity', '$need_post')";
mysqli_query($link, $query0);
$id_work = mysqli_insert_id($link);

$query00="INSERT INTO `srm_works_data_log` (`id_work`, `type`, `time`)
					              VALUES ('$id_work', '0', '$time')";
mysqli_query($link, $query00);

$data2['result'] = array(
    'status' => 'ok',
    'do' => 'go_url',
    'url' => '/home',
    'text' => 'Заявка добавлена',
);

echo json_encode($data2, JSON_NUMERIC_CHECK);

?>
