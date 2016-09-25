<div id="add_car">
    <div class="area">
        <h1>Заполните личный профиль, это поможет нам более качественно проводить обслуживание</h1>
        <form action="../cont/add_car.php"  method="POST" class="ajax_form add_car_form">
            <input type="hidden" name="id_user" value="<?php echo $my_id; ?>">
            <div class="groups group">
                <p>
                    <label for="uid">UID</label>
                    <?php
                    if($kol_auto==0) {
                    ?>
                    <input type="text" name="uid" class="input_text" value="<?php echo $my_first_uid; ?>">
                    <?php } else { ?>
                        <input type="text" name="uid" class="input_text"  value="">
                    <?php }; ?>
                </p>
                <p>
                    <label for="type_car">Марка авто</label>
                    <input type="text" name="type_car" class="input_text" value="">
                </p>
                <p>
                    <label for="model_car">Модель авто</label>
                    <input type="text" name="model_car" class="input_text" value="">
                </p>
                <p>
                    <label for="year_car">Год выпуска</label>
                    <input type="text" name="year_car" class="input_text" value="">
                </p>
            </div>
            <div class="groups group2">
                <p>
                    <label for="type_motor">Тип двигателя</label>
                    <input type="text" name="type_motor" class="input_text" value="">
                </p>
                <p>
                    <label for="size_motor">Объем двигателя</label>
                    <input type="text" name="size_motor" class="input_text" value="">
                </p>
                <p>
                    <label for="power_motor">Мощность двигателя</label>
                    <input type="text" name="power_motor" class="input_text" value="">
                </p>
                <p>
                    <label for="garant_book">Номер гарантийной книги</label>
                    <input type="text" name="garant_book" class="input_text" value="">
                </p>
            </div>
            <hr>
            <button class="buttons yelow_buttons" type="submit">Сохранить</button>
        </form>
    </div>
</div>