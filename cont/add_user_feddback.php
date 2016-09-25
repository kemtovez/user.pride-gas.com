<?php
session_start();
include ("../cont/bd_user.php");
$data = array();

if (isset($_POST['stat1'])) {
      $stat1 = htmlspecialchars($_POST['stat1']);
      $stat1 = mysqli_real_escape_string($link, $stat1);
} else {
      $stat1 = 0;
}
if (isset($_POST['stat2'])) {
      $stat2 = htmlspecialchars($_POST['stat2']);
      $stat2 = mysqli_real_escape_string($link, $stat2);
} else {
      $stat2 = 0;
}
if (isset($_POST['stat3'])) {
      $stat3 = htmlspecialchars($_POST['stat3']);
      $stat3 = mysqli_real_escape_string($link, $stat3);
} else {
      $stat3 = 0;
}

$id_work = htmlspecialchars($_POST['id_work']);
$id_work = mysqli_real_escape_string($link, $id_work);

$text = htmlspecialchars($_POST['text']);
$text = mysqli_real_escape_string($link, $text);

if (isset($_POST['add_video'])) {
      $add_video = htmlspecialchars($_POST['add_video']);
      $add_video = mysqli_real_escape_string($link, $add_video);
} else {
      $add_video = 0;
}

//-------------------
$rs = mysqli_query($link, "SELECT * FROM `srm_users_feedback` WHERE `id_work`='$id_work'");
$kol_id_work = mysqli_num_rows($rs);

if($kol_id_work==0) {

      $query0 = "INSERT INTO `srm_users_feedback` (`id_work`, `text`, `add_video`, `stat1`, `stat2`, `stat3`)
				                	VALUES ('$id_work', '$text', '$add_video', '$stat1', '$stat2', '$stat3')";
      mysqli_query($link, $query0);


      mysqli_query($link, "UPDATE `srm_works` SET `need_post`='0' WHERE id='$id_work'");

      $data['result'] = array(
          'status' => 'ok',
          'do' => 'go_url',
          'url' => '/home',
          'text' => 'Отзыв добавлен. Спасибо',
      );
} else {
      $data['result'] = array(
          'status' => 'ok',
          'do' => 'go_url',
          'url' => '/home',
          'text' => 'Данные уже добавлены',
      );
}
echo json_encode($data, JSON_NUMERIC_CHECK);

?>
