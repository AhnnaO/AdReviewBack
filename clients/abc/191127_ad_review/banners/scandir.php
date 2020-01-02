<?php

$banners = "./";
$scanned_directory = array_diff(scandir($banners), array('..', '.', 'scandir.php', '.DS_Store'));
print_r(json_encode($scanned_directory));

?>