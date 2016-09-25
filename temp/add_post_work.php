<div id="add_post_work">
    <div class="area">
<a href="/home" class="buttons no_opacity_blue_btn"><< Назад</a>
<?php
if(isset($params[1])) {
   $id_work = $params[1];
    $rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id='$id_work' AND id_user='$my_id' AND id_car='$my_id_car' AND `need_post`='1'");
    $this_need_post = mysqli_num_rows($rs);
    if($this_need_post!=0){
        $rs3 = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE id_work='$id_work' AND type_work='4'");
        while ($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
            $time_close_work = $row3['time'];
        }

        $rs2 = mysqli_query($link, "SELECT * FROM `srm_sto_report` WHERE id_work='$id_work'");
        while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
            $servises = $row2['servises'];
        }

        while ($row4 = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
            $name_work = $row4['name'];
            $garant_work = $row4['garant'];
            $id_sto = $row4['id_sto'];
        }

        $rs5 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$id_sto'");
        while ($row5 = mysqli_fetch_array($rs5, MYSQLI_ASSOC)) {
            $name_sto = $row5['name'];
        }
        $list_service = list_service($servises);
        ?>
        <div class="work_info">
            <div class="user_data">
                <ul>
                    <li>
                        <label>Дата</label>
                        <p><span><?php echo date('d.m.y', $time_close_work); ?></span></p>
                    </li>
                    <li>
                        <label>Название услуги</label>
                        <p><span><?php echo $name_work.' (гарантия '.$garant_work.' г.)'; ?></span>
                        <?php echo $list_service; ?></p>
                    </li>
                    <li>
                        <label>Исполнитель (партнёр)</label>
                        <p><span><b><?php echo '<a href="http://pride-gas.com/sto/'.$id_sto.'">'.$name_sto.'</a>'; ?></b></span></p>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <form action="../cont/add_user_feddback.php"  method="POST" class="ajax_form add_user_feddback">
            <input type="hidden" name="id_work" value="<?php echo $id_work; ?>">
        <div class="raitings_box">
            <div class="raitings_add">
                <h3>Ваш отзыв и оценка исполнителю:</h3>
                <table>
                    <thead>
                    <tr>
                        <td></td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Оценка параметра 1</td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat1" value="1" id="stat1_1"><label for="stat1_1"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat1" value="2" id="stat1_2"><label for="stat1_2"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat1" value="3" id="stat1_3"><label for="stat1_3"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat1" value="4" id="stat1_4"><label for="stat1_4"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat1" value="5" id="stat1_5"><label for="stat1_5"></label></div></td>
                    </tr>
                    <tr>
                        <td>Оценка параметра 2</td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat2" value="1" id="stat2_1"><label for="stat2_1"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat2" value="2" id="stat2_2"><label for="stat2_2"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat2" value="3" id="stat2_3"><label for="stat2_3"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat2" value="4" id="stat2_4"><label for="stat2_4"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat2" value="5" id="stat2_5"><label for="stat2_5"></label></div></td>
                    </tr>
                    <tr>
                        <td>Оценка параметра 3</td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat3" value="1" id="stat3_1"><label for="stat3_1"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat3" value="2" id="stat3_2"><label for="stat3_2"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat3" value="3" id="stat3_3"><label for="stat3_3"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat3" value="4" id="stat3_4"><label for="stat3_4"></label></div></td>
                        <td><div class="radio_raitings"><input type="checkbox" name="stat3" value="5" id="stat3_5"><label for="stat3_5"></label></div></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
        <hr>
        <div class="text_feed">
            <h3>Отзыв (+3% скидка):</h3>
            <textarea class="feed_text" name="text"></textarea>
            <p>*минимальное количество символов в отзыве не может быть менее 20 символов</p>
        </div>
        <hr>
        <div class="add_video">
            <h3>Получить беплатне ТО и мойку автомобиля:</h3>
            <div class="video_send_settings">
                <div class="checkbox_box">
                    <input type="checkbox" value="1" name="add_video" id="add_video">
                    <label for="add_video"></label>
                </div>
                <span>Подать заявку на видеообзор Вашего автомобиля</span>
            </div>
            <p>*после выбора данного пункта с вами свяжется менеджер для уточнения даты и времени съёмок</p>
        </div>
        <hr>
        <button class="buttons yelow_buttons" type="submit">Оставить отзыв</button>
        </form>
        <?php
    } else {
        ?>
        <div class="notification_box red_notification_box">
            <p>Не верный идентификатор заявки. Возможно Вы уже оставляли отзыв, или смените авто</p>
        </div>
        <?php
    }
} else {
?>
    <div class="notification_box red_notification_box">
        <p>Нет идентификатора заявки.</p>
    </div>
<?php
}
?>
        </div>
    </div>
