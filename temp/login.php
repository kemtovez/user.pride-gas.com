<div id="login_page">
    <header>
        <div class="area">
            <a class="logo" href="/home"></a>
            <div class="menu_box"><h3>Страница входа</h3></div>
        </div>
    </header>
    <div class="login_box">
<?php if (empty($_SESSION['id'])) { ?>
    <div class="area">
<form action="../cont/login.php" method="POST" class="ajax_form login_form">
    <h3>Введите данные для входа:</h3>
    <input type="text" name="email" class="input_text" placeholder="Email">
    <input type="text" name="pass" class="input_text" placeholder="Pass">
    <button class="buttons blue_buttons" type="submit">Login</button>
</form>
        </div>
<?php } else { 	 header('Location: ../home'); 	 }; ?>
    </div>
</div>
