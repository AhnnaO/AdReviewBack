<?php

$campaigns = "./";
$scanned_directory = array_diff(scandir($campaigns), array('..', '.', 'scandir.php', '.DS_Store'));
print_r(json_encode($scanned_directory));

//     foreach (scandir($campaigns) as $scanned_directory)
//    $fl = scandir($campaigns);
//    foreach (scandir($campaigns) as $fl)
//    echo $fl."<br>";
//    $files = preg_grep("/^(\d+)?\.\d+$/", scandir($campaigns));
//    foreach (scandir($campaigns) as $files)
//    echo json_encode($files);
//    
//    echo $files;
?>