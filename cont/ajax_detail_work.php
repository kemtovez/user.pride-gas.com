<?php
include ("../cont/bd_user.php");
include ("../cont/settings.php");

$id = htmlspecialchars($_POST['id']);
$id = mysqli_real_escape_string($link, $id);

//-------------------
$rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id='$id'");
$kol_uid_auto = mysqli_num_rows($rs);
if($kol_uid_auto > 0) {
while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
      $id_work = $row['id'];
      $id_user = $row['id_user'];
      $id_sto = $row['id_sto'];
      $type_work = $row['type'];
      $name_work = $row['name'];
      $need_post_work = $row['need_post'];
      $garant = $row['garant'];
      $data_last_work = '';
      $status_work = 0;
      $rs2 = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE id_work='$id_work' ORDER BY `time` DESC LIMIT 0,1");
      while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
            $data_last_work = date('d.m.y', $row2['time']);
            $time_last_work = $row2['time'];
            $status_work = $row2['type_work'];
      }
      $name_sto = '';

      $rs3 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$id_sto'");
      while ($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
            $name_sto = $row3['name'];
            $street_sto = $row3['street'];
            $tel1_sto = $row3['tel1'];
            $tel2_sto = $row3['tel2'];
            $tel3_sto = $row3['tel3'];
      }
      $dates_end = date('d.m.Y', strtotime('+' . $garant . ' years', $time_last_work));
      $servises = array();
      $rs4 = mysqli_query($link, "SELECT * FROM `srm_sto_report` WHERE id_work='$id_work'");
      while ($row4 = mysqli_fetch_array($rs4, MYSQLI_ASSOC)) {
            $servises = data_service($row4['servises'], $time_last_work);
      }
       if ($status_work == 4) {
            if ($type_work == 0) {
                  $text_gar = 'до ' . $dates_end;
            } else {
               $result_sort = '9999999999';
                  foreach ($servises as $sort_val) {
                        if ($sort_val['data'] > time() AND $sort_val['data'] < $result_sort) {
                              $result_sort = $sort_val['data'];
                        }
                  }
                  if ($result_sort == '9999999999') {
                        $text_gar = 'Гарантия закончилась';
                  } else {
                        $text_gar = 'до ' . date('d.m.Y', $result_sort);
                  };
            }
      } else {
            $text_gar = 'Нет данных';
      };

      if($type_work==0) {
            $str_data_end = strtotime($dates_end);
            $tek_data = time();
            $last_time = ($str_data_end - $tek_data)/ (60 * 60 * 24);
            $global_gar =  'Осталось '.round($last_time).' дн.';
      } else {
            $global_gar = $text_gar;
      };


      $data['result'] = array(
          'status' => 'ok',
          'data' => array(
              'data_last_work' => $data_last_work,
              'name_work' => $name_work,
              'status_work' => $status_work,
              'status_work_text' => status_work($status_work),
              'name_sto' => $name_sto,
              'id_sto' => $id_sto,
              'text_gar' => $text_gar,
              'global_gar' => $global_gar
          )
      );


      if($status_work==4) {
            foreach ($servises as $arr) {
                  if ($arr['data'] == '0') {
                        $data['result']['data']['other_work'][] = array(
                            $arr['name']
                        );
                  } else {
                        $data['result']['data']['other_work'][] = array(
                                $arr['name'] . ' (гарантия до '.date('d.m.Y', $arr['data']).')'
                        );
                  };
            };
      } else {
            $data['result']['data']['other_work'][] = array(
               'В режиме наполнения СТО'
            );
      };
};




} else {

      $data['error'] = array(
          'text' => 'Извините, такой заявки нет.',
      );


}
echo json_encode($data, JSON_NUMERIC_CHECK);
?>
