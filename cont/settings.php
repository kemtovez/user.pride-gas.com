<?php
function setting($name) {
    global $link;
    $value = '';
    $rs = mysqli_query($link, "SELECT * FROM `settings` WHERE `name`='$name'");
    while($row = mysqli_fetch_assoc($rs)) {
        $value = $row['value'];
}
return $value;
}
function status_work($id) {
    if($id=='0') { $text = 'Новая заявка'; }
    if($id=='1') { $text = 'Распределена в СТО'; }
    if($id=='2') { $text = 'В работе у СТО'; }
    if($id=='3') { $text = 'Оформление отчета'; }
    if($id=='4') { $text = 'Выполнено'; }
    return $text;
}
//------------------------------
function list_service($arr) {
    //ser1:2;ser3;Ser4
    $html = '';
    $arr_ser = explode(";", $arr);
    foreach ($arr_ser as $value) {
        $gar = '';
        $is_garant = substr_count($value, ':');
        if($is_garant>0) {
            $title_arr = explode(":", $value);
            $title = $title_arr[0];
            $gar = '('.$title_arr[1].' мес. гарантия)';
        } else {
            $title = $value;
        }
        $arr_result = get_service($title);
        $html = $html.'<span>'.$arr_result['name'].' '.$gar.'</span>';
    }

    return $html;
}
function data_service($arr, $time) {
    $data = array();
    $data_year=array();
    //ser1:2;ser3;Ser4
    // 1474725600
    $html = '';
    $arr_ser = explode(";", $arr);
    foreach ($arr_ser as $value) {
        $gar = '';
        $is_garant = substr_count($value, ':');
        if ($is_garant > 0) {
            $title_arr = explode(":", $value);
            $title = $title_arr[0];
            $gar = $title_arr[1];
            $arr_result = get_service($title);
            $dates_end = strtotime(date('d.m.Y H:i', strtotime('+' . $gar . ' months', $time)));
            $data[] = array(
                'name' => $arr_result['name'],
                'data' => $dates_end
            );
        } else {
            $arr_result = get_service($value);
            $data[] = array(
                'name' => $arr_result['name'],
                'data' => '0'
            );
        }
    };

    return $data;



      //  $html = $html.'<span>'.$arr_result['name'].' '.$gar.'</span>';



}
function get_service($title) {
    global $link;
    $value = '';
    $rs = mysqli_query($link, "SELECT * FROM `srm_sto_services` WHERE `title`='$title'");
    while($row = mysqli_fetch_assoc($rs)) {
        $arr = array('id' => $row['id'], 'name' => $row['name'], 'title' => $row['title'], 'type' => $row['type'], '$is_garant' => $row['$is_garant']);
    }

    return $arr;
}