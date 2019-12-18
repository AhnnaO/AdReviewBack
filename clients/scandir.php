<html>
<head>
<title>Scandir</title>
</head>
<body>
<ul> 
<li>



<?php

$origin = "clients";
$clientList = scandir($origin);
print_r($clientList);



?>

</li>
</ul>
</body>
</html>