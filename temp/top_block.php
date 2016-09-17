<?php $href = $params[0]; ?>
<!-- --- Мои реферальные ссылки ---  -->
<div style="display:none;">
<div id="my_url_window">
<?php echo myUrlWindow($my_id, $my_activate_partners, $my_all_partners, $my_transit); ?>
</div>
</div>
<!-- --- /Мои реферальные ссылки/ ---  -->
<div id="top_block">
<div class="area">
<div id="logo"><a href="http://<?php echo  $_SERVER['SERVER_NAME']; ?>/home">

</a></div>
<div id="top_menu">
<?php echo topMenu($my_grup, $href, $my_activate_chek); ?>
</div>
</div>
</div>