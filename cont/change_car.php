<?php
session_start();
include ("../cont/bd_user.php");
$my_id = $_SESSION['id'];

$id_car = htmlspecialchars($_POST['id']);
$id_car = mysqli_real_escape_string($link, $id_car);

	mysqli_query($link, "UPDATE `srm_users_cars` SET `is_main`='0' WHERE id_user='$my_id'");
    mysqli_query($link, "UPDATE `srm_users_cars` SET `is_main`='1' WHERE id_user='$my_id' AND id='$id_car'");
    echo 'Обновляем данные по авто';


?>
