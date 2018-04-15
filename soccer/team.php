<?php
$teamApiKey = $_GET['teamID'];
//équipe
$uri = $teamApiKey;
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: bd9e09e95e8948cc9f6d543c36225d48';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$team = json_decode($response);
//Joueurs
$uri = $teamApiKey.'/players';
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: bd9e09e95e8948cc9f6d543c36225d48';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$teamPlayer = json_decode($response, true);
//Matchs
$uri = $teamApiKey.'/fixtures';
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: bd9e09e95e8948cc9f6d543c36225d48';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$teamFixtures = json_decode($response, true);

$pageTitle = $team->name;;
$pageDesc = 'Toutes les infos de '.$team->code;

include("../include/head.php");
include("../include/nav.php");
?>
<section class="hero is-primary has-fade-in" style="padding-top: 50px;">
  <div class="hero-body">
    <div class="container">
      <article class="media">
        <figure class="media-left">
          <p class="image is-64x64">
            <img src="<?php echo $team->crestUrl; ?>">
          </p>
        </figure>
        <div class="media-content">
          <div class="content">
            <h1 class="title has-text-weight-bold"><?php echo $team->name; ?></h1>
            <h1 class="subtitle is-4"><?php echo $team->code; ?></h1>
          </div>
        </div>
      </article>
    </div>
  </div>
</section>
<section class="container">
<br>
  <div class="columns">
    <div class="column">
      <article>
        <div class="message-header">
          <h1 class="title is-4 has-text-white">Matchs à venir :</h1>
        </div>
        <div class="message-body">
          <?php
          for ($pos=0; $pos < $teamFixtures['count']; $pos++) {
            if ($teamFixtures['fixtures'][$pos]['status'] === 'TIMED') {
              $matchDate = date('d/m', strtotime($teamFixtures['fixtures'][$pos]['date']));
              $matchHour = date('H:i', strtotime($teamFixtures['fixtures'][$pos]['date']));
              echo '
              <div class="box">
                <div class="columns is-mobile">
                  <div class="column is-1" style="text-align: center;">
                    <i class="far fa-clock"></i>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <a>
                      <i class="far fa-plus-square"></i>
                    </a>
                  </div>
                  <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
                  <div class="column is-8">
                    <p><strong>'.$teamFixtures['fixtures'][$pos]['homeTeamName'].'</strong></p>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <p><strong>'.$teamFixtures['fixtures'][$pos]['awayTeamName'].'</strong></p>
                  </div>
                  <div class="column" style="text-align: center;">
                    <p><time>'.$matchDate.'</time></p>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <p><time>'.$matchHour.'</time></p>
                  </div>
                </div>
              </div>';
            }elseif ($teamFixtures['fixtures'][$pos]['status'] === 'IN_PLAY') {
              if ($teamFixtures['fixtures'][$pos]['result']['goalsHomeTeam'] === null) {
                $homeGoals = 0;
              }else {
                $homeGoals = $teamFixtures['fixtures'][$pos]['result']['goalsHomeTeam'];
              }
              if ($teamFixtures['fixtures'][$pos]['result']['goalsAwayTeam'] === null) {
                $awayGoals = 0;
              }else {
                $awayGoals = $teamFixtures['fixtures'][$pos]['result']['goalsAwayTeam'];
              }
              $homeWon = null;
              $awayWon = null;
              if ($awayGoals === $homeGoals AND $awayGoals != 0) {
                $awayWon = 'has-text-warning';
                $homeWon = 'has-text-warning';
              }elseif ($awayGoals > $homeGoals) {
                $awayWon = 'has-text-success';
                $homeWon = 'has-text-danger';
              }elseif ($homeGoals > $awayGoals){
                $homeWon = 'has-text-success';
                $awayWon = 'has-text-danger';
              }
              echo '
              <div class="box">
                <div class="columns is-mobile">
                  <div class="column is-1" style="text-align: center;">
                    <a href="../channel/bein.php" target="_blank">
                      <i class="far fa-play-circle"></i>
                    </a>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <a>
                      <i class="far fa-plus-square"></i>
                    </a>
                  </div>
                  <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
                  <div class="column is-8">
                    <p class="'.$homeWon.'"><strong>'.$teamFixtures['fixtures'][$pos]['homeTeamName'].'</strong></p>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <p class="'.$awayWon.'"><strong>'.$teamFixtures['fixtures'][$pos]['awayTeamName'].'</strong></p>
                  </div>
                  <div class="column" style="text-align: center;">
                    <p class="'.$homeWon.'"><strong>'.$homeGoals.'</strong></p>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <p class="'.$awayWon.'"><strong>'.$awayGoals.'</strong></p>
                  </div>
                </div>
              </div>';
            }
          }
            ?>
        </div>
      </article>
    </div>
    <div class="column">
      <article class="message">
        <div class="message-header">
          <h1 class="title is-4 has-text-white">Joueurs :</h1>
        </div>
        <div class="message-body">
          <?php
          $count = $teamPlayer['count'];
          for ($pos=0; $pos < $count; $pos++) {
            echo
            '
            <div class="box">
              <div class="columns is-mobile">
                <div class="column is-5">
                  <p>
                    <strong>'.$teamPlayer['players'][$pos]['name'].'</strong>
                  </p>
                  <p>
                    <small>'.$teamPlayer['players'][$pos]['position'].' - n°'.$teamPlayer['players'][$pos]['jerseyNumber'].'</small>
                  </p>
                </div>
              <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
                <div class="column is-3">
                  <p>
                    <strong>'.$teamPlayer['players'][$pos]['nationality'].'</strong>
                  </p>
                  <p>
                    <small>'.$teamPlayer['players'][$pos]['dateOfBirth'].'</small>
                  </p>
                </div>
              <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
              <div class="column is-4">
                <p>
                  <strong>Fin de contrat :</strong>
                </p>
                <p>
                  <small>'.$teamPlayer['players'][$pos]['contractUntil'].'</small>
                </p>
              </div>
              </div>
            </div>
          ';
        }
      ?>
        </div>
      </article>
    </div>
  </div>
</section>