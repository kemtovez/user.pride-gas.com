<?php
require_once("less.php");
$css_path = "templates-less/css";
  try {
    $formatter = new lessc_formatter_compressed;
    $formatter->compressColors = false;
    $less1 = new lessc;
    $less1->setFormatter($formatter);
    $less1->compileFile($css_path."/sources/main.less", $css_path."/styles.css");
  } catch (exception $e) {
    echo $e->getMessage();
  }

function setting($name) {
    global $link;
    $value = '';
    $rs = mysqli_query($link, "SELECT * FROM `settings` WHERE `name`='$name'");
    while($row = mysqli_fetch_assoc($rs)) {
        $value = $row['value'];
}
return $value;
}
