<?php
session_start();
include ("../cont/bd_user.php");
$my_id = $_SESSION['id'];

$name = htmlspecialchars($_POST['name']);
$name = mysqli_real_escape_string($link, $name);

$value = htmlspecialchars($_POST['value']);
$value = mysqli_real_escape_string($link, $value);

$table = htmlspecialchars($_POST['table']);
$table = mysqli_real_escape_string($link, $table);
if($table=='users') {
    mysqli_query($link, "UPDATE `srm_users` SET `$name`='$value' WHERE id='$my_id'");
    echo 'Данные пользователя обновлены';
};
if($table=='users_cars') {
    mysqli_query($link, "UPDATE `srm_users_cars` SET `$name`='$value' WHERE id_user='$my_id' AND is_main='1'");
    echo 'Данные авто обновлены';
};

?>
