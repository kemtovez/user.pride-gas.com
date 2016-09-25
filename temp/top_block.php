<header>
    <div class="area">
        <a class="logo" href="/home"></a>
        <div class="menu_box">
            <h3>Добро пожаловать, <?php echo $my_name; ?><a href="exit">Выйти</a></h3>
            <ul>
                <li><a href="/home">Личный профиль</a></li>
                <li><a href="/work">Услуги и гарантия</a></li>
            </ul>
        </div>
        <div class="shuse_car_box">
            <p>Техподдержка: +38 (066) 777 50 89</p>
            <span>Авто:</span>
            <div class="shuse_car_block">
                <?php
                if($kol_auto==0) { echo '<a href="/add_car">Добавить авто</a>'; } else {
                ?>
                <select name="my_cars">
                    <?php
                    $rs2 = mysqli_query($link, "SELECT * FROM `srm_users_cars` WHERE id_user='$my_id' ORDER BY  `is_main`");
                    while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
                        $my_id_car = $row2['id'];
                        $my_type_car = $row2['type_car'];
                        if($row2['is_main']!='1') {
                            echo '<option value="' . $row2['id'] . '">' . $row2['type_car'] . ' ' . $row2['model_car'] . '</option>';
                        } else {
                            echo '<option value="' . $row2['id'] . '" selected>' . $row2['type_car'] . ' ' . $row2['model_car'] . '</option>';
                        }
                    }
                    ?>

                    <option value="add">Добавить авто</option>
                </select>
                <?php }; ?>
            </div>
        </div>
    </div>
</header>