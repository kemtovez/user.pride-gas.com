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
?>