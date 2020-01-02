<?php

$size = "./";
$scanned_directory = array_diff(scandir($size), array('..', '.', 'scandir.php', '.DS_Store'));
print_r(json_encode($scanned_directory));

?>