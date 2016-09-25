<div id="home">
    <!-- ------- MODAL --------- -->
    <div class="md-modal md-effect-1 new_auto_user_box" id="modal-1">
        <div class="md-content">
            <div class="md-content-header">
                <h3>У авто новый владелец</h3>
                <span class="md-close"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            <div class="md-content-box">
                <form action="../cont/new_auto_user.php" method="POST" class="ajax_form new_auto_user">
                    <input type="text" name="name" class="input_text" placeholder="Имя нового владельца">
                    <input type="text" name="tel" class="input_text" placeholder="Телефон">
                    <input type="hidden" name="id_car" value="<?php echo $my_id_car; ?>">
                    <button class="buttons blue_buttons" type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>
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
    <div class="md-modal md-effect-1 need_help_box" id="modal-3">
        <div class="md-content">
            <div class="md-content-header">
                <h3>Записаться на обслуживание</h3>
                <span class="md-close"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            <div class="md-content-box">
                <form action="../cont/add_new_work.php" method="POST" class="ajax_form add_new_work">
                    <p>Укажите желаемую дату обслуживания</p>
                    <input type="text" name="data" class="input_text data_time" placeholder="Дата">
                    <input type="hidden" name="id_car" value="<?php echo $my_id_car; ?>">
                    <p>Укажите тип обслуживания:</p>
                    <select name="type">
                        <option value="2">Гарантийное обслуживание</option>
                        <option value="3">Ремонт</option>
                    </select>
                    <input type="hidden" name="sity" class="input_text" placeholder="Город" value="<?php echo $my_sity; ?>">
                    <button class="buttons blue_buttons" type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>
    <div class="md-modal md-effect-1 hate_you_box" id="modal-4">
        <div class="md-content">
            <div class="md-content-header">
                <h3>Книга жалоб</h3>
                <span class="md-close"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            <div class="md-content-box">
                <form action="../cont/add_comment_sto_users.php" method="POST" class="ajax_form add_new_work">
                    <p>Оставьте Ваши комментарии, жалобы и предложения по поводу работы Вашего СТО:</p>
                    <input type="hidden" name="id_car" value="<?php echo $my_id_car; ?>">
                    <input type="hidden" name="sto_id" value="<?php echo $my_sto_id; ?>">
                    <textarea name="text" placeholder="Введите текст"></textarea>
                    <button class="buttons blue_buttons" type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>
    <div class="md-modal md-effect-1 ajax_detail_work_box" id="modal-5">
        <div class="md-content">
            <div class="md-content-header">
                <h3>Информация о услуге</h3>
                <span class="md-close"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            <div class="md-content-box">
                <div class="user_data data_table_work">
                    <ul>
                        <li>
                            <label>Дата</label>
                            <p><span id="ajax_data_last_work"></span></p>
                        </li>
                        <li>
                            <label>Название услуги</label>
                            <p><span id="ajax_name_work"></span></p>
                        </li>
                        <li>
                            <label>Исполнитель (партнёр)</label>
                            <p><span id="ajax_name_sto"></span></p>
                        </li>
                        <li>
                            <label>Гарантия услуги</label>
                            <p><span id="ajax_global_gar"></span></p>
                        </li>
                        <li>
                            <label>Другие услуги в рамках данного обслуживания:</label>
                            <ul id="ajax_other_work"></ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ------- HOME ------------ -->
    <div class="area">
        <?php
        // Notification
if($kol_need_post>0) {
    ?>
    <div class="notification_box green_notification_box">
        <p>У Вас есть возможность получить скидку на следующее ТО <span>заполнив отзыв</span> об обслуживании.Вы также  можете получить бесплатно следующее ТО и мойку автомобиля, если после отзыва согласитесь записать видеообзор установленного оборудования представителями СТО.</p>
    </div>
        <?php
}
        ?>
<h2><?php echo $my_name; ?><span class="edit_profile"><i class="fa fa-pencil" aria-hidden="true"></i>Редактировать профиль</span></h2>
        <div class="home_info_box">
            <div class="user_data">
                <ul>
                    <li>
                        <label>Телефон:</label>
                        <span name="tel" data="users"><?php echo $my_tel; ?></span>
                    </li>
                    <li>
                        <label>Почта:</label>
                        <span name="email" data="users"><?php echo $my_email; ?></span>
                    </li>
                    <li>
                        <label>Город:</label>
                        <span name="sity" data="users"><?php echo $my_sity; ?></span>
                    </li>
                    <li>
                        <label>Регион:</label>
                        <span name="region" data="users"><?php echo $my_region; ?></span>
                    </li>
                    <li>
                        <label>Марка авто:</label>
                        <span name="type_car" data="users_cars"><?php echo $my_type_car; ?></span>
                    </li>
                    <li>
                        <label>Модель:</label>
                        <span name="model_car" data="users_cars"><?php echo $my_model_car; ?></span>
                    </li>
                    <li>
                        <label>Год:</label>
                        <span name="year_car" data="users_cars"><?php echo $my_year_car; ?></span>
                    </li>
                    <li>
                        <label>Тип двигателя:</label>
                        <span name="type_motor" data="users_cars"><?php echo $my_type_motor; ?></span>
                    </li>
                    <li>
                        <label>Объём двигателя:</label>
                        <span name="size_motor" data="users_cars"><?php echo $my_size_motor; ?></span>
                    </li>
                    <li>
                        <label>Мощность двигателя:</label>
                        <span name="power_motor" data="users_cars"><?php echo $my_power_motor; ?></span>
                    </li>
                    <li>
                        <label>Ваша дата рождения:</label>
                        <span name="data_bd" data="users"><?php echo $my_data_bd; ?></span>
                    </li>
                    <li>
                        <label>Серийный номер гарантийной книжки:</label>
                        <span name="garant_book" data="users_cars"><?php echo $my_garant_book; ?></span>
                    </li>
                </ul>
            </div>
            <div class="sidebar">
                <button class="buttons blue_buttons new_user_in_auto md-trigger" data-modal="modal-1">У авто новый владелец</button>
                <hr>
                <button class="buttons yelow_buttons need_to md-trigger" data-modal="modal-2">Записаться на ТО</button>
                <button class="buttons yelow_buttons need_help md-trigger" data-modal="modal-3">Записаться на обслуживание</button>
                <hr>
                <div class="sale_to">
                    <h3>Ваша скидка на текущее ТО: </h3>
                    <span><?php echo $my_discount; ?>%</span>
                </div>
                <hr>
                <div class="send_settings">
                    <h3>Управление подписками:</h3>
                    <div class="list_send_settings">
                        <?php
                        if($my_send_email=='1') {
                            echo '<div class="checkbox_box"><input type="checkbox" value="1" name="check" id="send_email" checked /><label for="send_email"></label></div><p><b>Подписаться на новостную рассылку</b></p>';
                        } else {
                            echo '<div class="checkbox_box"><input type="checkbox" value="1" name="check" id="send_email" /><label for="send_email"></label></div><p>Подписаться на новостную рассылку</p>';
                        }
                        ?>
                    </div>
                    <div class="list_send_settings">
                        <?php
                        if($my_send_sms=='1') {
                            echo '<div class="checkbox_box"><input type="checkbox" value="1" name="check" id="send_sms" checked /><label for="send_sms"></label></div><p><b>Оповещать меня по SMS об новых услугах</b></p>';
                        } else {
                            echo '<div class="checkbox_box"><input type="checkbox" value="1" name="check" id="send_sms" /><label for="send_sms"></label></div><p>Оповещать меня по SMS об новых услугах</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="users_sto">
            <h3>Прикреплён к СТО:</h3>
            <a href="//pride-gas.com/sto/<?php echo $my_sto_id; ?>"><i class="fa fa-wrench" aria-hidden="true"></i><span><?php echo $my_sto_name; ?></span></a>
            <button class="hate_you md-trigger" data-modal="modal-4"><i class="fa fa-book" aria-hidden="true"></i><span>Книга жалоб и предложений</span></button>
        </div>
        <hr>
         <table class="table_user_work tables">
            <thead>
            <tr>
                <td>Дата</td>
                <td>Статус</td>
                <td>Услуга</td>
                <td>СТО</td>
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
                $status_work = 0;
                $rs2 = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE id_work='$id_work' ORDER BY `time` DESC LIMIT 0,1");
                while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
                    $time_last_work = date('d.m.y H:i', $row2['time']);
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
                echo '<tr>';
                echo '<td>'.$time_last_work.'</td>';
                echo '<td><span class="status_work status_work_'.$status_work.'">'.status_work($status_work).'</span> <button data="'.$id_work.'" class="buttons no_opacity_btn ajax_detail_work">Детальнее</button></td>';
                echo '<td>'.$name_work.'</td>';
                echo '<td><b>'.$name_sto.'</b><br>'.$street_sto.'<br>'.$tel1_sto.'<br>'.$tel2_sto.'</td>';
                if($need_post_work==1) {
                    echo '<td><p>Оставить отзыв и получить <b>скидку до 7%</b> на следующее обслуживание</p><a href="/add_post_work/'.$id_work.'" class="buttons min_yelow_buttons add_post_work">Оставить отзыв</a></td>';
                } else {
                    echo '<td></td>';
                }
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>