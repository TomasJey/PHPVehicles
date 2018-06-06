<html>
<head>
<link rel='stylesheet' href="css.css">
<?php
require_once 'class.inc.php';
require_once 'outputs.inc.php';
?>

</head>
<body>
<?php
$dispay_cars = new OutputArrays();
echo $dispay_cars->displayCars();
?>
</body>
</html>