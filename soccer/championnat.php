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

//équipes competition
$uri = $teamApiKey.'/teams';
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: bd9e09e95e8948cc9f6d543c36225d48';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$competitionTeams = json_decode($response, true);

$pageTitle = $competition->caption;
$pageDesc = 'Toutes les infos des matchs de '.$competition->caption;

include("../include/head.php");
include("../include/nav.php");
?>
<section class="hero is-primary has-fade-in" style="padding-top: 50px;">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        <i class="fas fa-trophy"></i>
        <?php echo $competition->caption; ?>
      </h1>
    </div>
  </div>
  <div class="hero-foot">
    <div class="container">
      <nav class="level is-mobile">
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Journée :</p>
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
      <br>
      <div class="tabs is-centered is-boxed">
        <ul>
          <li id="matchs-tab" class="is-active">
            <a onclick="switchCatTab('matchs')">
              <span class="icon is-small"><i class="fas fa-futbol"></i></span>
              <span>Matchs</span>
            </a>
          </li>
          <li id="leagueTable-tab">
            <a onclick="switchCatTab('leagueTable')">
              <span class="icon is-small"><i class="fas fa-trophy"></i></span>
              <span>Classement</span>
            </a>
          </li>
          <li id="teams-tab">
              <a onclick="switchCatTab('teams')">
                <span class="icon is-small"><i class="fas fa-shield-alt"></i></span>
                <span>Equipes</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
<section class="container">
  <br>
  <article id="matchs" class="message is-dark">
    <div class="message-header">
      <h1 class="title is-4 has-text-white">Matchs de la Journée:</h1>
    </div>
    <div class="message-body">
      <?php
        for ($pos=0; $pos < $competitionFixtures['count']; $pos++) {
          if ($competitionFixtures['fixtures'][$pos]['status'] === 'TIMED') {
              $matchDate = date('d/m', strtotime($competitionFixtures['fixtures'][$pos]['date']));
              $matchHour = date('H:i', strtotime($competitionFixtures['fixtures'][$pos]['date']));
              echo '
              <div class="box">
                <div class="columns is-mobile">
                  <div class="column is-1" style="text-align: center;">
                    <a class="tooltip" data-tooltip="Match à venir">
                      <i class="far fa-clock"></i>
                    </a>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <a href="../soccer/fixture.php?fixtureID='.$competitionFixtures['fixtures'][$pos]['_links']['self']['href'].'" class="tooltip" data-tooltip="Plus">
                      <i class="far fa-plus-square"></i>
                    </a>
                  </div>
                  <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
                  <div class="column is-8">
                    <p><a href="../soccer/team.php?teamID='.$competitionFixtures['fixtures'][$pos]['_links']['homeTeam']['href'].'"><strong>'.$competitionFixtures['fixtures'][$pos]['homeTeamName'].'</strong></a></p>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <p><a href="../soccer/team.php?teamID='.$competitionFixtures['fixtures'][$pos]['_links']['awayTeam']['href'].'"><strong>'.$competitionFixtures['fixtures'][$pos]['awayTeamName'].'</strong></a></p>
                  </div>
                  <div class="column" style="text-align: center;">
                    <p><time>'.$matchDate.'</time></p>
                    <hr style="margin: 3px 0px 3px 0px;">
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
                    <a href="../channel/bein.php" target="_blank" class="tooltip" data-tooltip="Regarder le match">
                      <i class="far fa-play-circle"></i>
                    </a>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <a href="../soccer/fixture.php?fixtureID='.$competitionFixtures['fixtures'][$pos]['_links']['self']['href'].'" class="tooltip" data-tooltip="Plus">
                      <i class="far fa-plus-square"></i>
                    </a>
                  </div>
                  <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
                  <div class="column is-8">
                    <p class="'.$homeWon.'"><a href="../soccer/team.php?teamID='.$competitionFixtures['fixtures'][$pos]['_links']['homeTeam']['href'].'"><strong>'.$competitionFixtures['fixtures'][$pos]['homeTeamName'].'</strong></a></p>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <p class="'.$awayWon.'"><a href="../soccer/team.php?teamID='.$competitionFixtures['fixtures'][$pos]['_links']['awayTeam']['href'].'"><strong>'.$competitionFixtures['fixtures'][$pos]['awayTeamName'].'</strong></a></p>
                  </div>
                  <div class="column" style="text-align: center;">
                    <p class="'.$homeWon.'"><strong>'.$homeGoals.'</strong></p>
                    <hr style="margin: 3px 0px 3px 0px;">
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
                    <a class="tooltip" data-tooltip="Match Terminé">
                      <i class="far fa-check-circle"></i>
                    </a>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <a href="../soccer/fixture.php?fixtureID='.$competitionFixtures['fixtures'][$pos]['_links']['self']['href'].'" class="tooltip" data-tooltip="Plus">
                      <i class="far fa-plus-square"></i>
                    </a>
                  </div>
                  <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
                  <div class="column is-8">
                    <p class="'.$homeWon.'"><a href="../soccer/team.php?teamID='.$competitionFixtures['fixtures'][$pos]['_links']['homeTeam']['href'].'"><strong>'.$competitionFixtures['fixtures'][$pos]['homeTeamName'].'</strong></a></p>
                    <hr style="margin: 3px 0px 3px 0px;">
                    <p class="'.$awayWon.'"><a href="../soccer/team.php?teamID='.$competitionFixtures['fixtures'][$pos]['_links']['awayTeam']['href'].'"><strong>'.$competitionFixtures['fixtures'][$pos]['awayTeamName'].'</strong></a></p>
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
        <article id="teams" class="message is-dark hidden">
          <div class="message-header">
            <h1 class="title is-4 has-text-white">Equipes</h1>
          </div>
          <div class="message-body">
            <?php
              $teamCount = $competitionTeams['count'];
              for ($pos=0; $pos < $teamCount; $pos++) {
                echo '
                  <article class="media">
                    <a href="../soccer/team.php?teamID='.$competitionTeams['teams'][$pos]['_links']['self']['href'].'">
                      <figure class="media-left">
                        <p class="image is-32x32">
                          <img src="'.$competitionTeams['teams'][$pos]['crestUrl'].'">
                        </p>
                      </figure>
                      <div class="media-content">
                        <div class="content">
                          <p>
                            <a href="../soccer/team.php?teamID='.$competitionTeams['teams'][$pos]['_links']['self']['href'].'"><strong>'.$competitionTeams['teams'][$pos]['name'].'</strong></a>
                            <br>
                            <small>'.$competitionTeams['teams'][$pos]['code'].' - '.$competitionTeams['teams'][$pos]['shortName'].'</small>
                            <br>
                          </p>
                        </div>
                      </div>
                    </a>
                  </article>
                  ';
                }
              ?>
            </div>
          </article>
          <article id="leagueTable" class="message is-dark hidden">
            <div class="message-header">
              <h1 class="title is-4 has-text-white">Classement:</h1>
            </div>
            <div class="message-body">
              <table class="table is-striped is-hoverable is-hidden-touch">
                <thead>
                  <tr>
                    <th>Pos</th>
                    <th>Equipe</th>
                    <th>Joués</th>
                    <th>Victoires</th>
                    <th>Nuls</th>
                    <th>Défaites</th>
                    <th>Goals Marqués</th>
                    <th>Goals Encaissés</th>
                    <th>Goal Average</th>
                    <th>Points</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Pos</th>
                    <th>Equipe</th>
                    <th>Joués</th>
                    <th>Victoires</th>
                    <th>Nuls</th>
                    <th>Défaites</th>
                    <th>Goals Marqués</th>
                    <th>Goals Encaissés</th>
                    <th>Goal Average</th>
                    <th>Points</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  // Classement de la Compétition
                  for ($pos=0; $pos < $competition->numberOfTeams; $pos++) {
                    echo '
                    <tr>
                      <th>'.$competitionTable['standing'][$pos]['position'].'</th>
                      <td><a href="../soccer/team.php?teamID='.$competitionTable['standing'][$pos]['_links']['team']['href'].'">'.$competitionTable['standing'][$pos]['teamName'].'</a></td>
                      <td>'.$competitionTable['standing'][$pos]['playedGames'].'</td>
                      <td>'.$competitionTable['standing'][$pos]['wins'].'</td>
                      <td>'.$competitionTable['standing'][$pos]['draws'].'</td>
                      <td>'.$competitionTable['standing'][$pos]['losses'].'</td>
                      <td>'.$competitionTable['standing'][$pos]['goals'].'</td>
                      <td>'.$competitionTable['standing'][$pos]['goalsAgainst'].'</td>
                      <td>'.$competitionTable['standing'][$pos]['goalDifference'].'</td>
                      <td>'.$competitionTable['standing'][$pos]['points'].'</td>
                    </tr>';
                  }
                  ?>
                </tbody>
              </table>
              <!-- MOBILE TABLE -->
              <table class="table is-striped is-hoverable is-hidden-desktop">
                <thead>
                  <tr>
                    <th>Pos</th>
                    <th>Equipe</th>
                    <th>V:N:D</th>
                    <th>Points</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Pos</th>
                    <th>Equipe</th>
                    <th>V:N:D</th>
                    <th>Points</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  // Classement de la Compétition
                  for ($pos=0; $pos < $competition->numberOfTeams; $pos++) {
                    echo '
                    <tr>
                      <th>'.$competitionTable['standing'][$pos]['position'].'</th>
                      <td><a href="../soccer/team.php?teamID='.$competitionTable['standing'][$pos]['_links']['team']['href'].'">'.$competitionTable['standing'][$pos]['teamName'].'</a></td>
                      <td>'.$competitionTable['standing'][$pos]['wins'].':'.$competitionTable['standing'][$pos]['draws'].':'.$competitionTable['standing'][$pos]['losses'].'</td>
                      <td>'.$competitionTable['standing'][$pos]['points'].'</td>
                    </tr>';
                  }
                  ?>
                </tbody>
              </table>
          </article>
        </div>
</section>
<script>
  function switchCatTab(type) {
      removeActive();
      hideAllCat();
      $(`#${type}-tab`).addClass("is-active");
      $(`#${type}`).removeClass("hidden");
  }

  function switchTab(type) {
      removeActive();
      hideAllCat();
      $("#list-content").addClass("hidden");
      $("#add-content").addClass("hidden");
      $(`#${type}-tab`).addClass("is-active");
      $(`#${type}`).removeClass("hidden");
  }

  function removeActive() {
      $("li").each(function() {
      $(this).removeClass("is-active");
      });
  }

  function hideAllCat() {
      $("#teams").addClass("hidden");
      $("#leagueTable").addClass("hidden");
      $("#matchs").addClass("hidden");
  }
</script>
