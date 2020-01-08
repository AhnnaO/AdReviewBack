

<?php
$client=$_GET["client"];
$clients = $client."";
$clientList = scandir($clients);
print_r($clientList);






?>
