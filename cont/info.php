<?php
$id = $_SESSION['id'];
$rs = mysqli_query($link, "SELECT * FROM `srm_users` WHERE id='$id'");
while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
$my_id = $row['id']; 
$my_email = $row['email'];
$my_first_uid = $row['uid'];
$my_name = $row['name'];
$my_tel = $row['tel'];
$my_pass = $row['pass'];
$my_region = $row['region'];
$my_sity = $row['sity'];
$my_data_bd = $row['data_bd'];
$my_sto_id = $row['sto_id'];
$my_send_email = $row['send_email'];
$my_send_sms = $row['send_sms'];
}
$rs2 = mysqli_query($link, "SELECT * FROM `srm_users_cars` WHERE id_user='$my_id' AND `is_main`='1'");
$kol_auto = mysqli_num_rows($rs2);

if($kol_auto>0) {
    while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
        $my_id_car = $row2['id'];
        $my_uid_car = $row2['uid'];
        $my_type_car = $row2['type_car'];
        $my_model_car = $row2['model_car'];
        $my_year_car = $row2['year_car'];
        $my_type_motor = $row2['type_motor'];
        $my_size_motor = $row2['size_motor'];
        $my_power_motor = $row2['power_motor'];
        $my_garant_book = $row2['garant_book'];
        $my_discount = $row2['discount'];
        $my_is_main_car = $row2['is_main'];
    }
} else {
   // header("Location: /add_car");
}
$rs3 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$my_sto_id'");
while ($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
    $my_sto_name = $row3['name'];
}
//------------------ Post_need_block
$rs4 = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id_user='$my_id' AND `id_car`='$my_id_car' AND `need_post`='1'");
$kol_need_post = mysqli_num_rows($rs4);