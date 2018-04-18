<?php
//Championnats : 444, 445, 446, 447, 448, 449, 450, 451, 452, 453, 455, 456, 457, 459, 466

//Coupes : 458, 464, 467
$championshipsID = array('444', '445', '446', '447', '448', '449', '450', '451', '452', '453', '455', '456', '457', '459', '466');
$cupsID = array('464', '467');

if (!empty($_GET['championnat'])){
  $championnat = htmlspecialchars($_GET['championnat']);
  switch ($championnat) {
    case 'championnat-bresil':
      $soccerSeasonID = '444';
      break;
    case 'premiere-league':
      $soccerSeasonID = '445';
      break;
    case 'championship':
      $soccerSeasonID = '446';
      break;
    case 'league-one':
      $soccerSeasonID = '447';
      break;
    case 'league-two':
      $soccerSeasonID = '448';
      break;
    case 'eredivisie':
      $soccerSeasonID = '449';
      break;
    case 'ligue-1':
      $soccerSeasonID = '450';
      break;
    case 'ligue-2':
      $soccerSeasonID = '451';
      break;
    case 'bundesliga-1':
      $soccerSeasonID = '452';
      break;
    case 'bundesliga-2':
      $soccerSeasonID = '453';
      break;
    case 'liga-santander':
      $soccerSeasonID = '455';
      break;
    case 'serie-a':
      $soccerSeasonID = '456';
      break;
    case 'liga-nos':
      $soccerSeasonID = '457';
      break;
    case 'serie-b':
      $soccerSeasonID = '459';
      break;
    case 'a-league':
      $soccerSeasonID = '459';
      break;
  }
}
if (!empty($_GET['coupe'])){
  $coupe = htmlspecialchars($_GET['coupe']);
  switch ($coupe) {
    case 'champions-league':
      $soccerSeasonID = '464';
      break;
    case 'coupe-du-monde':
      $soccerSeasonID = '467';
      break;
  }
}
if (!empty($_GET['team'])){
  $coupe = htmlspecialchars($_GET['coupe']);
  switch ($coupe) {
    case 'champions-league':
      $soccerSeasonID = '464';
      break;
    case 'coupe-du-monde':
      $soccerSeasonID = '467';
      break;
  }
}

if (in_array($soccerSeasonID, $championshipsID, true )) {
  include('../soccer/championship.php');
}elseif (in_array($soccerSeasonID, $cupsID, true )) {
  include('../soccer/cup.php');
}else {
  echo 'error';
}
?>
<br>
<?php
include('../_include/footer.php');
 ?>
