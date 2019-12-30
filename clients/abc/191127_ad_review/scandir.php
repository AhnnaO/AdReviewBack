<?php

$adType = "./";
$scanned_directory = array_diff(scandir($adType), array('..', '.', 'scandir.php', '.DS_Store'));
print_r(json_encode($scanned_directory));

?>