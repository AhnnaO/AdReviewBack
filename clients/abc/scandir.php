<?php
/*
$_POST[]
$client = $_GET["client"]

$campaign = $_GET["campaign"]
$adtype = $_GET["adtype"]

"."
$path = "../".$client."/".$campaign."/".$adtype;
*/
$campaigns = "./";
$scanned_directory = array_diff(scandir($campaigns), array('..', '.', 'scandir.php', '.DS_Store'));
//print_r(json_encode($scanned_directory));

$returnArray=array();
//print_r($scanned_directory);
//for($i=0;$i<count($scanned_directory);$i++){
   // $scanned_directory[$i];
  // $returnArray[$i]=$scanned_directory[$i+3];
  //  $returnArray[$scanned_directory[$i+3]] = $scanned_directory[$i+3];
//}
foreach($scanned_directory as $key=>$value){
    $returnArray[$value] = $value;
}
echo json_encode($returnArray);
?>