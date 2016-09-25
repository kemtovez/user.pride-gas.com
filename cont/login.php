<?php
session_start();
$data = array();
//$data['result'] = array();
if (isset($_POST['email'])) {

    $login = htmlspecialchars($_POST['email']);
    $login = addslashes($login);

    if ($login == '') {
        unset($login);
    }
};
//-----
if (isset($_POST['pass'])) {
$password = htmlspecialchars($_POST['pass']);
$password = addslashes($password);

    if ($password =='') {
        unset($password);
    }
};
//-----
if (empty($login) or empty($password)) {
    $data['error'] = array(
        'text' => 'Вы ввели не всю информацию. Заполните все поля!',
    );

}
//--------
$login = stripslashes($login);//удаляет экранирование символов, произведенное функцией addslashes()
$login = htmlspecialchars($login);//преобразует специальные символы в HTML-сущности (обрабатываем их, чтобы теги и скрипты не работали на случай от действий умников-спамеров)
$password = stripslashes($password); //удаляет экранирование символов, произведенное функцией addslashes()
$password = htmlspecialchars($password);

$login = trim($login);//удаляет пробелы (или другие символы) из начала и конца строки
$password = trim($password);
//---------
// Подключаемся к БД
include ("../cont/bd_user.php");
$result = mysqli_query($link, "SELECT * FROM srm_users WHERE `email`='$login'");
$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
if (empty($myrow['pass'])) {
    //если пользователя с введенным логином не существует
    $data['error'] = array(
        'text' => 'Извините, введённый вами логин неверный.',
    );

} else {
    //если существует, то сверяем пароли
    if ($myrow['pass'] == "$password" ){
             //если пароли совпадают, то запускаем данному пользователю сессию
            $_SESSION['id']=$myrow['id'];
            $_SESSION['email']=$myrow['email'];
            $_SESSION['root']=$myrow['root'];
        $data['result'] = array(
            'status' => 'ok',
            'do' => 'go_url',
            'url' => '/home',
            'text' => 'Добро пожаловать',
        );
    } else {
        $data['error'] = array(
            'text' => 'Извините, введённый вами пароль неверный.',
        );

    }
}
echo json_encode($data, JSON_NUMERIC_CHECK);
?>