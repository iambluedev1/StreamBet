<?php
$soccerSeasonID = htmlspecialchars($_GET['soccerSeasonID']);
$teamApiKey = 'http://api.football-data.org/v1/competitions/'.$soccerSeasonID;
//competition
$uri = $teamApiKey;
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: bd9e09e95e8948cc9f6d543c36225d48';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$competition = json_decode($response);
//classement competition
$uri = $teamApiKey.'/leagueTable';
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: bd9e09e95e8948cc9f6d543c36225d48';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$competitionTable = json_decode($response, true);
//fixtures competition
$uri = $teamApiKey.'/fixtures?matchday='.$competition->currentMatchday;
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: bd9e09e95e8948cc9f6d543c36225d48';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$competitionFixtures = json_decode($response, true);

$pageTitle = $competition->caption;
$pageDesc = 'Toutes les infos des matchs de '.$competition->caption;

include("../include/head.php");
include("../include/nav.php");
?>
<section class="hero is-success has-fade-in" style="padding-top: 50px;">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        <i class="far fa-futbol"></i>
        Matchs - <?php echo $competition->caption; ?>
      </h1>
      <h2 class="subtitle">
        Retrouvez le calendrier des Matchs de <?php echo $competition->caption; ?> !
      </h2>
    </div>
  </div>
  <div class="hero-footer">
    <div class="container">
      <nav class="level">
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Manche :</p>
            <p class="title"><?php echo $competition->currentMatchday.'/'.$competition->numberOfMatchdays; ?></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">équipes :</p>
            <p class="title"><?php echo $competition->numberOfTeams; ?></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Matchs :</p>
            <p class="title"><?php echo $competition->numberOfGames; ?></p>
          </div>
        </div>
      </nav>
      <div class="container">
        <progress class="progress" value="<?php echo $competition->currentMatchday ?>" max="<?php echo $competition->numberOfMatchdays ?>"></progress>
      </div>
    </div>
    <br>
    <br>
  </div>
</section>
<section class="container">
  <br>
  <div class="columns">
    <div class="column">
      <article class="message is-dark">
        <div class="message-header">
          <h1 class="title is-4 has-text-white">Matchs de la Manche:</h1>
        </div>
        <div class="message-body accordion-content">
          <?php
          for ($pos=0; $pos < $competitionFixtures['count']; $pos++) {
            if ($competitionFixtures['fixtures'][$pos]['status'] === 'TIMED') {
              $matchDate = date('d/m', strtotime($competitionFixtures['fixtures'][$pos]['date']));
              $matchHour = date('H:i', strtotime($competitionFixtures['fixtures'][$pos]['date']));
              echo '
              <div class="box">
                <div class="columns is-mobile">
                  <div class="column is-1" style="text-align: center;">
                    <i class="far fa-clock"></i>
                    <hr style="margin: 5px 0px 5px 0px;">
                    <a>
                      <i class="far fa-plus-square"></i>
                    </a>
                  </div>
                  <div class="is-divider-vertical" data-content="" style="padding:0px 5px 0px 5px;"></div>
                  <div class="column is-8">
                    <p><strong>'.$competitionFixtures['fixtures'][$pos]['homeTeamName'].'</strong></p>
                    <hr style="margin: 5px 0px 5px 0px;">
                    <p><strong>'.$competitionFixtures['fixtures'][$pos]['awayTeamName'].'</strong></p>
                  </div>
                  <div class="column" style="text-align: center;">
                    <p><time>'.$matchDate.'</time></p>
                    <hr style="margin: 5px 0px 5px 0px;">
                    <p><time>'.$matchHour.'</time></p>
                  </div>
                </div>
              </div>';
            }elseif ($competitionFixtures['fixtures'][$pos]['status'] === 'IN_PLAY') {
              if ($competitionFixtures['fixtures'][$pos]['result']['goalsHomeTeam'] === null) {
                $homeGoals = 0;
              }else {
                $homeGoals = $competitionFixtures['fixtures'][$pos]['result']['goalsHomeTeam'];
              }
              if ($competitionFixtures['fixtures'][$pos]['result']['goalsAwayTeam'] === null) {
                $awayGoals = 0;
              }else {
                $awayGoals = $competitionFixtures['fixtures'][$pos]['result']['goalsAwayTeam'];
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
                    <hr style="margin: 5px 0px 5px 0px;">
                    <a>
                      <i class="far fa-plus-square"></i>
                    </a>
                  </div>
                  <div class="is-divider-vertical" data-content="" style="padding:0px 5px 0px 5px;"></div>
                  <div class="column is-10">
                    <p class="'.$homeWon.'"><strong>'.$competitionFixtures['fixtures'][$pos]['homeTeamName'].'</strong></p>
                    <hr style="margin: 5px 0px 5px 0px;">
                    <p class="'.$awayWon.'"><strong>'.$competitionFixtures['fixtures'][$pos]['awayTeamName'].'</strong></p>
                  </div>
                  <div class="column" style="text-align: center;">
                    <p class="'.$homeWon.'"><strong>'.$homeGoals.'</strong></p>
                    <hr style="margin: 5px 0px 5px 0px;">
                    <p class="'.$awayWon.'"><strong>'.$awayGoals.'</strong></p>
                  </div>
                </div>
              </div>';
            }elseif ($competitionFixtures['fixtures'][$pos]['status'] === 'FINISHED') {
              if ($competitionFixtures['fixtures'][$pos]['result']['goalsHomeTeam'] === null) {
                $homeGoals = 0;
              }else {
                $homeGoals = $competitionFixtures['fixtures'][$pos]['result']['goalsHomeTeam'];
              }
              if ($competitionFixtures['fixtures'][$pos]['result']['goalsAwayTeam'] === null) {
                $awayGoals = 0;
              }else {
                $awayGoals = $competitionFixtures['fixtures'][$pos]['result']['goalsAwayTeam'];
              }
              $homeWon = null;
              $awayWon = null;
              if ($homeGoals >= $awayGoals){
                $homeWon = 'has-text-success';
                $awayWon = 'has-text-danger';
              }elseif ($awayGoals >= $homeGoals) {
                $awayWon = 'has-text-success';
                $homeWon = 'has-text-danger';
              }elseif ($awayGoals === $homeGoals) {
                $awayWon = 'has-text-warning';
                $homeWon = 'has-text-warning';
              }
              echo '
              <div class="box">
                <div class="columns is-mobile">
                  <div class="column is-1" style="text-align: center;">
                    <i class="far fa-check-circle"></i>
                    <hr style="margin: 5px 0px 5px 0px;">
                    <a>
                      <i class="far fa-plus-square"></i>
                    </a>
                  </div>
                  <div class="is-divider-vertical" data-content="" style="padding:0px 5px 0px 5px;"></div>
                  <div class="column is-10">
                    <p class="'.$homeWon.'"><strong>'.$competitionFixtures['fixtures'][$pos]['homeTeamName'].'</strong></p>
                    <hr style="margin: 5px 0px 5px 0px;">
                    <p class="'.$awayWon.'"><strong>'.$competitionFixtures['fixtures'][$pos]['awayTeamName'].'</strong></p>
                  </div>
                  <div class="column" style="text-align: center;">
                    <p class="'.$homeWon.'"><strong>'.$homeGoals.'</strong></p>
                    <hr style="margin: 5px 0px 5px 0px;">
                    <p class="'.$awayWon.'"><strong>'.$awayGoals.'</strong></p>
                  </div>
                </div>
              </div>';
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript" src="/node_modules/bulma-extensions/bulma-accordion/dist/bulma-accordion.min.js"></script>
