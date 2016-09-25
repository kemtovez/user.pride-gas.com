<?php
session_start();
include ("../cont/bd_user.php");
$data = array();

$my_id = $_SESSION['id'];

$name = htmlspecialchars($_POST['name']);
$name = mysqli_real_escape_string($link, $name);

$tel = htmlspecialchars($_POST['tel']);
$tel = mysqli_real_escape_string($link, $tel);

$id_car = htmlspecialchars($_POST['id_car']);
$id_car = mysqli_real_escape_string($link, $id_car);


$query0="INSERT INTO `srm_change_car` (`id_user`, `id_car`, `name`, `tel`)
					VALUES ('$my_id', '$id_car', '$name', '$tel')";
mysqli_query($link, $query0);
      $data['result'] = array(
          'status' => 'ok',
          'do' => 'close_modal',
          'url' => 'modal-1',
          'text' => 'Заявка отправлена',
      );
echo json_encode($data, JSON_NUMERIC_CHECK);
?>
