<?php

$campaigns = "./";
$scanned_directory = array_diff(scandir($campaigns), array('..', '.', 'scandir.php', '.DS_Store'));
print_r(json_encode($scanned_directory));

?>