<?php
//Championnats : 444, 445, 446, 447, 448, 449, 450, 451, 452, 453, 455, 456, 457, 459, 466

//Coupes : 458, 464, 467

$soccerSeasonID = htmlspecialchars($_GET['soccerSeasonID']);

$championshipsID = array('444', '445', '446', '447', '448', '449', '450', '451', '452', '453', '455', '456', '457', '459', '466');
$cupsID = array('464', '467');

if (in_array($soccerSeasonID, $championshipsID, true )) {
  include('../soccer/championnat.php');
}elseif (in_array($soccerSeasonID, $cupsID, true )) {
  include('../soccer/coupe.php');
}else {
  include('../_errors/404.php');
}
?>
<br>
<?php
include('../_include/footer.php');
 ?>
