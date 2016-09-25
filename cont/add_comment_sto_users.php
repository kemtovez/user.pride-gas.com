<?php
session_start();
include ("../cont/bd_user.php");
$data = array();
$my_id = $_SESSION['id'];

$id_car = htmlspecialchars($_POST['id_car']);
$id_car = mysqli_real_escape_string($link, $id_car);

$sto_id = htmlspecialchars($_POST['sto_id']);
$sto_id = mysqli_real_escape_string($link, $sto_id);

$text = htmlspecialchars($_POST['text']);
$text = mysqli_real_escape_string($link, $text);


$query0="INSERT INTO `srm_comment_sto_users` (`id_user`, `id_sto`, `id_car`, `text`)
					                  VALUES ('$my_id', '$sto_id', '$id_car', '$text')";
mysqli_query($link, $query0);

$data['result'] = array(
    'status' => 'ok',
    'do' => 'close_modal',
    'url' => 'modal-4',
    'text' => 'Отзыв отправлен',
);

echo json_encode($data, JSON_NUMERIC_CHECK);

?>
