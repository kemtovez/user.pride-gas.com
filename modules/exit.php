<?php
session_start();//открытие сессии
unset($_SESSION['id']);//закрытие сессии по id
session_destroy();//удаление сессии
header("Location: ../login");//Перенаправление на эту страницу после нажатия кнопки ВЫЙТИ
?>
