<div id="work">
    <!-- ------- MODAL --------- -->
    <div class="md-modal md-effect-1 need_to_box" id="modal-2">
        <div class="md-content">
            <div class="md-content-header">
                <h3>Записаться на ТО</h3>
                <span class="md-close"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            <div class="md-content-box">
                <form action="../cont/add_new_work.php" method="POST" class="ajax_form add_new_work">
                    <p>Укажите желаемую дату прохождения ТО</p>
                    <input type="text" name="data" class="input_text data_time" placeholder="Дата">
                    <input type="hidden" name="type" value="1">
                    <input type="hidden" name="id_car" value="<?php echo $my_id_car; ?>">
                    <p>Укажите город прохождения ТО (в случае отличия от указанного в профиле)</p>
                    <input type="text" name="sity" class="input_text" placeholder="Город" value="<?php echo $my_sity; ?>">
                    <button class="buttons blue_buttons" type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>
    <!-- ------- HOME ------------ -->
    <div class="area">
<h2>Услуги и гарантия</h2>
        <div class="sale_to">
            <h3>Ваша скидка на текущее ТО: </h3>
            <span><?php echo $my_discount; ?>%</span>
            <button class="buttons yelow_buttons need_to md-trigger" data-modal="modal-2">Записаться на ТО</button>
        </div>
        <table class="table_user_work tables">
            <thead>
            <tr>
                <td>Дата</td>
                <td>Название услуги</td>
                <td>Статус</td>
                <td>Исполнитель</td>
                <td>До конца гарантии</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id_user='$my_id' AND id_car='$my_id_car' ORDER BY `id` DESC");
            while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                $id_work = $row['id'];
                $id_sto = $row['id_sto'];
                $type_work = $row['type'];
                $name_work = $row['name'];
                $need_post_work = $row['need_post'];
                $garant = $row['garant'];
                $rs2 = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE id_work='$id_work' ORDER BY `time` DESC LIMIT 0,1");
                while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
                    $data_last_work = date('d.m.y', $row2['time']);
                    $time_last_work = $row2['time'];
                    $status_work = $row2['type_work'];
                }
                $rs3 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$id_sto'");
                while ($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
                    $name_sto = $row3['name'];
                    $street_sto = $row3['street'];
                    $tel1_sto = $row3['tel1'];
                    $tel2_sto = $row3['tel2'];
                    $tel3_sto = $row3['tel3'];
                }
                $dates_end = date('d.m.Y', strtotime('+'.$garant.' years', $time_last_work));
                echo '<tr>';
                echo '<td>'.$data_last_work.'</td>';
                echo '<td>'.$name_work.'</td>';
                echo '<td><span class="status_work status_work_'.$status_work.'">'.status_work($status_work).'</span></td>';
                echo '<td>'.$name_sto.'</td>';
                if($status_work==4) {
                    if($type_work==0) {
                        $text_gar = 'до '.$dates_end;
                    } else {
                        $servises = '';
                        $rs4 = mysqli_query($link, "SELECT * FROM `srm_sto_report` WHERE id_work='$id_work'");
                        while ($row4 = mysqli_fetch_array($rs4, MYSQLI_ASSOC)) {
                            $servises = data_service($row4['servises'], $time_last_work);
                        }
                        $data = $servises;
$result_sort = '9999999999';
                        foreach($servises as $sort_val){
                           if($sort_val['data'] >  time() AND $sort_val['data'] <  $result_sort ) {
                               $result_sort = $sort_val['data'];
                           }
                        }
if($result_sort =='9999999999') {
    $text_gar = 'Гарантия закончилась';
} else {
    $text_gar = 'до '.date('d.m.Y', $result_sort);
};
                    }
                } else {
                    $text_gar = 'Нет данных';
                }
                echo '<td>'.$text_gar.'</td>';
                echo '<td><button class="buttons detail_btn detail_work_table" data="'.$id_work.'">Детальнее</button></td>';
                echo '</tr>';
                echo '<tr class="hidden_data" id="hidden_data_'.$id_work.'"><td COLSPAN=6>';
                ?>
                <div class="work_info">
                    <div class="user_data">
                        <ul>
                            <li>
                                <label>Дата</label>
                                <p><span><?php echo $data_last_work; ?></span></p>
                            </li>
                            <li>
                                <label>Название услуги</label>
                                <p><span><?php echo $name_work; ?></span>
                            </li>
                            <li>
                                <label>Исполнитель (партнёр)</label>
                                <p><span><?php echo $name_sto; ?></span>
                            </li>
                            <li>
                                <label>Гарантия услуги</label>
                                <p>
                                <?php
                                if($type_work==0) {
                                    $str_data_end = strtotime($dates_end);
                                    $tek_data = time();
                                    $last_time = ($str_data_end - $tek_data)/ (60 * 60 * 24);
                                    echo '<span>Осталось '.round($last_time).' дн.</span>';
                                } else {
echo $text_gar;
                                }
                                ?>
                                </p>
                            </li>
                            <li>
                                <label>Другие услуги в рамках данного обслуживания:</label>
                                <ul>
                                    <?php
                                    if($status_work==4) {
                                        foreach ($servises as $arr) {
                                            if ($arr['data'] == '0') {
                                                echo '<li>' . $arr['name'] . '</li>';
                                            } else {
                                                echo '<li>' . $arr['name'] . ' (гарантия до ' . date('d.m.Y', $arr['data']) . ')</li>';
                                            };
                                        };
                                    } else {
                                        echo '<li>В режиме наполнения СТО</li>';
                                    };
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php
                echo '</td></tr>';
            }
            ?>
            </tbody>
            </table>

    </div>
</div>