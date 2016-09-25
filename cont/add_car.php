<?php
session_start();
include ("../cont/bd_user.php");
$data = array();

$my_id = $_SESSION['id'];

$uid = htmlspecialchars($_POST['uid']);
$uid = mysqli_real_escape_string($link, $uid);

$type_car = htmlspecialchars($_POST['type_car']);
$type_car = mysqli_real_escape_string($link, $type_car);

$model_car = htmlspecialchars($_POST['model_car']);
$model_car = mysqli_real_escape_string($link, $model_car);

$year_car = htmlspecialchars($_POST['year_car']);
$year_car = mysqli_real_escape_string($link, $year_car);

$type_motor = htmlspecialchars($_POST['type_motor']);
$type_motor = mysqli_real_escape_string($link, $type_motor);

$size_motor = htmlspecialchars($_POST['size_motor']);
$size_motor = mysqli_real_escape_string($link, $size_motor);

$power_motor = htmlspecialchars($_POST['power_motor']);
$power_motor = mysqli_real_escape_string($link, $power_motor);

$garant_book = htmlspecialchars($_POST['garant_book']);
$garant_book = mysqli_real_escape_string($link, $garant_book);

//-------------------
$rs = mysqli_query($link, "SELECT * FROM `srm_users_cars` WHERE id_user='$my_id' AND `uid`='$uid'");
$kol_uid_auto = mysqli_num_rows($rs);
if($kol_uid_auto > 0) {
      $data['error'] = array(
          'text' => 'Извините, такой номер UID уже используется.',
      );
} else {
      mysqli_query($link, "UPDATE `srm_users_cars` SET `is_main`='0' WHERE id_user='$my_id'");
      $query0="INSERT INTO `srm_users_cars` (`id_user`, `uid`, `type_car`, `model_car`, `year_car`, `type_motor`, `size_motor`, `power_motor`, `garant_book`, `is_main`)
					VALUES ('$my_id', '$uid', '$type_car', '$model_car', '$year_car', '$type_motor', '$size_motor', '$power_motor', '$garant_book', '1')";
      mysqli_query($link, $query0);
      $data['result'] = array(
          'status' => 'ok',
          'do' => 'go_url',
          'url' => '/home',
          'text' => 'Авто добавлено',
      );
}
echo json_encode($data, JSON_NUMERIC_CHECK);


?>
