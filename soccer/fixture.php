<?php
$teamApiKey = $_GET['fixtureID'];
//équipe
$uri = $teamApiKey;
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: bd9e09e95e8948cc9f6d543c36225d48';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$fixture = json_decode($response);
//Variables
$matchName = $fixture->fixture->homeTeamName.' - '.$fixture->fixture->awayTeamName;
$matchDate = $matchDate = date('d/m/y - H:i', strtotime($fixture->fixture->date));

$pageTitle = $matchName;
$pageDesc = 'Toutes les infos sur le match '.$matchName;

include("../include/head.php");
include("../include/nav.php");
?>
<section class="hero is-primary has-fade-in" style="padding-top: 50px;">
  <div class="hero-body">
    <h1 class="title is-3">
      <?php echo $fixture->fixture->homeTeamName.' - '.$fixture->fixture->awayTeamName; ?>
    </h1>
    <h1 class="subtitle is-4">
      <?php echo $matchDate; ?>
    </h1>
  </div>
  <div class="hero-footer">
    <div class="container">
      <nav class="level is-mobile">
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Statut :</p>
            <p class="title"><?php
            if ($fixture->fixture->status === "FINISHED"){
              echo 'Terminé';
            }elseif ($fixture->fixture->status === "IN_PLAY"){
              echo 'En cours.';
            }elseif ($fixture->fixture->status === "SCHEDULED" OR "TIMED") {
              echo 'Prévu.';
            }
             ?></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Score :</p>
            <p class="title"><?php echo $fixture->fixture->result->goalsHomeTeam.' - '.$fixture->fixture->result->goalsAwayTeam ?></p>
          </div>
        </div>
      </nav>
      <br>
    </div>
  </div>
</section>
<br>
<section>
  <div class="container">
    <article class="message is-dark">
      <div class="message-header">
        <h1 class="title is-4 has-text-white">Face à Faces</h1>
      </div>
      <div class="message-body">
        <?php
          $count = $fixture->head2head->count;
        ?>
        <nav class="level is-mobile">
          <div class="level-item has-text-centered">
            <div>
              <p class="heading">Matchs :</p>
              <p class="title"><?php echo $count ?>
              </p>
            </div>
          </div>
          <div class="level-item has-text-centered">
            <div>
              <p class="heading">Victoires - <?php echo $fixture->fixture->homeTeamName ?> :</p>
              <p class="title"><?php echo $fixture->head2head->homeTeamWins ?></p>
            </div>
          </div>
          <div class="level-item has-text-centered">
            <div>
              <p class="heading">Victoires - <?php echo $fixture->fixture->awayTeamName ?></p>
              <p class="title"><?php echo $fixture->head2head->awayTeamWins ?></p>
            </div>
          </div>
          <div class="level-item has-text-centered">
            <div>
              <p class="heading">Nuls</p>
              <p class="title"><?php echo $fixture->head2head->draws ?></p>
            </div>
          </div>
        </nav>
        <article class="message">
          <div class="message-header">
            <h1 class="title is-5 has-text-white"><?php echo $fixture->fixture->homeTeamName ?></h1>
          </div>
          <div class="message-body">
            <h1 class="title is-5">Dernière victoire</h1>
            <?php
            if (!empty($fixture->head2head->lastWinHomeTeam)) {
              if ($fixture->head2head->lastWinHomeTeam->result->goalsHomeTeam === null) {
                $homeGoals = 0;
              }else {
                $homeGoals = $fixture->head2head->lastWinHomeTeam->result->goalsHomeTeam;
              }
              if ($fixture->head2head->lastWinHomeTeam->result->goalsAwayTeam === null) {
                $awayGoals = 0;
              }else {
                $awayGoals = $fixture->head2head->lastWinHomeTeam->result->goalsAwayTeam;
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
              $matchDate = date('d/m/y', strtotime($fixture->head2head->lastWinHomeTeam->date));
              $matchHour = date('H:i', strtotime($fixture->head2head->lastWinHomeTeam->date));
              echo '
              <div class="box">
              <div class="columns is-mobile">
              <div class="column is-1" style="text-align: center;">
                <a href="../channel/bein.php" target="_blank">
                  <i class="far fa-check-circle"></i>
                </a>
                <hr style="margin: 3px 0px 3px 0px;">
                <a href="../soccer/fixture.php?fixtureID='.$fixture->head2head->lastWinHomeTeam->_links->self->href.'">
                  <i class="far fa-plus-square"></i>
                </a>
              </div>
              <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
              <div class="column is-4">
                <p class="'.$homeWon.'"><a href="../soccer/team.php?teamID='.$fixture->head2head->lastWinHomeTeam->_links->homeTeam->href.'"><strong>'.$fixture->head2head->lastWinHomeTeam->homeTeamName.'</strong></a></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p class="'.$awayWon.'"><a href="../soccer/team.php?teamID='.$fixture->head2head->lastWinHomeTeam->_links->awayTeam->href.'"><strong>'.$fixture->head2head->lastWinHomeTeam->awayTeamName.'</strong></a></p>
              </div>
              <div class="column" style="text-align: center;">
                <p class="'.$homeWon.'"><strong>'.$fixture->head2head->lastWinHomeTeam->result->goalsHomeTeam.'</strong></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p class="'.$awayWon.'"><strong>'.$fixture->head2head->lastWinHomeTeam->result->goalsAwayTeam.'</strong></p>
              </div>
              <div class="column" style="text-align: center;">
                <p><time>'.$matchDate.'</time></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p><time>'.$matchHour.'</time></p>
              </div>
            </div>
            </div>';
          }else {
            echo '<p><strong>Cette équipe n\'a jamais remporté ce matchs durant les '.$count.' derniers</strong></p><br>';
          } ?>
        <h1 class="title is-5">Dernière victoire à Domicile</h1>
        <?php
        if (!empty($fixture->head2head->lastHomeWinHomeTeam)) {
          if ($fixture->head2head->lastWinHomeTeam->result->goalsHomeTeam === null) {
            $homeGoals = 0;
          }else {
            $homeGoals = $fixture->head2head->lastWinHomeTeam->result->goalsHomeTeam;
          }
          if ($fixture->head2head->lastWinHomeTeam->result->goalsAwayTeam === null) {
            $awayGoals = 0;
          }else {
            $awayGoals = $fixture->head2head->lastWinHomeTeam->result->goalsAwayTeam;
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
          $matchDate = date('d/m/y', strtotime($fixture->head2head->lastWinHomeTeam->date));
          $matchHour = date('H:i', strtotime($fixture->head2head->lastWinHomeTeam->date));
          echo '
          <div class="box">
          <div class="columns is-mobile">
            <div class="column is-1" style="text-align: center;">
              <a href="../channel/bein.php" target="_blank">
                <i class="far fa-check-circle"></i>
              </a>
              <hr style="margin: 3px 0px 3px 0px;">
              <a href="../soccer/fixture.php?fixtureID='.$fixture->head2head->lastWinHomeTeam->_links->self->href.'">
                <i class="far fa-plus-square"></i>
              </a>
            </div>
            <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
            <div class="column is-4">
              <p class="'.$homeWon.'"><a href="../soccer/team.php?teamID='.$fixture->head2head->lastWinHomeTeam->_links->homeTeam->href.'"><strong>'.$fixture->head2head->lastWinHomeTeam->homeTeamName.'</strong></a></p>
              <hr style="margin: 3px 0px 3px 0px;">
              <p class="'.$awayWon.'"><a href="../soccer/team.php?teamID='.$fixture->head2head->lastWinHomeTeam->_links->awayTeam->href.'"><strong>'.$fixture->head2head->lastWinHomeTeam->awayTeamName.'</strong></a></p>
            </div>
            <div class="column" style="text-align: center;">
              <p class="'.$homeWon.'"><strong>'.$fixture->head2head->lastWinHomeTeam->result->goalsHomeTeam.'</strong></p>
              <hr style="margin: 3px 0px 3px 0px;">
              <p class="'.$awayWon.'"><strong>'.$fixture->head2head->lastWinHomeTeam->result->goalsAwayTeam.'</strong></p>
            </div>
            <div class="column" style="text-align: center;">
              <p><time>'.$matchDate.'</time></p>
              <hr style="margin: 3px 0px 3px 0px;">
              <p><time>'.$matchHour.'</time></p>
            </div>
          </div>
          </div>';
        }else {
          echo '<p><strong>Cette équipe n\'a jamais remporté ce matchs durant les '.$count.' derniers</strong></p><br>';
        } ?>
      </div>
    </article>
      <article class="message">
        <div class="message-header">
          <h1 class="title is-5 has-text-white"><?php echo $fixture->fixture->awayTeamName ?></h1>
        </div>
        <div class="message-body">
        <h1 class="title is-5">Dernière victoire</h1>
        <?php
        if (!empty($fixture->head2head->lastWinAwayTeam)) {
          if ($fixture->head2head->lastWinAwayTeam->result->goalsHomeTeam === null) {
            $homeGoals = 0;
          }else {
            $homeGoals = $fixture->head2head->lastWinAwayTeam->result->goalsHomeTeam;
          }
          if ($fixture->head2head->lastWinAwayTeam->result->goalsAwayTeam === null) {
            $awayGoals = 0;
          }else {
            $awayGoals = $fixture->head2head->lastWinAwayTeam->result->goalsAwayTeam;
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
          $matchDate = date('d/m/y', strtotime($fixture->head2head->lastWinAwayTeam->date));
          $matchHour = date('H:i', strtotime($fixture->head2head->lastWinAwayTeam->date));
          echo '
          <div class="box">
            <div class="columns">
              <div class="column is-1" style="text-align: center;">
                <a href="../channel/bein.php" target="_blank">
                  <i class="far fa-check-circle"></i>
                </a>
                <hr style="margin: 3px 0px 3px 0px;">
                <a href="../soccer/fixture.php?fixtureID='.$fixture->head2head->lastWinAwayTeam->_links->self->href.'">
                  <i class="far fa-plus-square"></i>
                </a>
              </div>
              <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
              <div class="column is-4">
                <p class="'.$homeWon.'"><a href="../soccer/team.php?teamID='.$fixture->head2head->lastWinAwayTeam->_links->homeTeam->href.'"><strong>'.$fixture->head2head->lastWinAwayTeam->homeTeamName.'</strong></a></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p class="'.$awayWon.'"><a href="../soccer/team.php?teamID='.$fixture->head2head->lastWinAwayTeam->_links->awayTeam->href.'"><strong>'.$fixture->head2head->lastWinAwayTeam->awayTeamName.'</strong></a></p>
              </div>
              <div class="column" style="text-align: center;">
                <p class="'.$homeWon.'"><strong>'.$fixture->head2head->lastWinAwayTeam->result->goalsHomeTeam.'</strong></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p class="'.$awayWon.'"><strong>'.$fixture->head2head->lastWinAwayTeam->result->goalsAwayTeam.'</strong></p>
              </div>
              <div class="column" style="text-align: center;">
                <p><time>'.$matchDate.'</time></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p><time>'.$matchHour.'</time></p>
              </div>
            </div>
          </div>';
        }else {
          echo '<p><strong>Cette équipe n\'a jamais remporté ce matchs durant les '.$count.' derniers</strong></p><br>';
        } ?>
        <h1 class="title is-5">Dernière victoire à l'exterieur</h1>
        <?php
        if (!empty($fixture->head2head->lastAwayWinAwayTeam)) {
          if ($fixture->head2head->lastAwayWinAwayTeam->result->goalsHomeTeam === null) {
            $homeGoals = 0;
          }else {
            $homeGoals = $fixture->head2head->lastAwayWinAwayTeam->result->goalsHomeTeam;
          }
          if ($fixture->head2head->lastAwayWinAwayTeam->result->goalsAwayTeam === null) {
            $awayGoals = 0;
          }else {
            $awayGoals = $fixture->head2head->lastAwayWinAwayTeam->result->goalsAwayTeam;
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
          $matchDate = date('d/m/y', strtotime($fixture->head2head->lastAwayWinAwayTeam->date));
          $matchHour = date('H:i', strtotime($fixture->head2head->lastAwayWinAwayTeam->date));
          echo '
          <div class="box">
            <div class="columns">
              <div class="column is-1" style="text-align: center;">
                <a href="../channel/bein.php" target="_blank">
                  <i class="far fa-check-circle"></i>
                </a>
                <hr style="margin: 3px 0px 3px 0px;">
                <a href="../soccer/fixture.php?fixtureID='.$fixture->head2head->lastAwayWinAwayTeam->_links->self->href.'">
                  <i class="far fa-plus-square"></i>
                </a>
              </div>
              <div class="is-divider-vertical" data-content="" style="padding:0px 3px 0px 3px;"></div>
              <div class="column is-4">
                <p class="'.$homeWon.'"><a href="../soccer/team.php?teamID='.$fixture->head2head->lastAwayWinAwayTeam->_links->homeTeam->href.'"><strong>'.$fixture->head2head->lastWinAwayTeam->homeTeamName.'</strong></a></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p class="'.$awayWon.'"><a href="../soccer/team.php?teamID='.$fixture->head2head->lastAwayWinAwayTeam->_links->awayTeam->href.'"><strong>'.$fixture->head2head->lastWinAwayTeam->awayTeamName.'</strong></a></p>
              </div>
              <div class="column" style="text-align: center;">
                <p class="'.$homeWon.'"><strong>'.$fixture->head2head->lastAwayWinAwayTeam->result->goalsHomeTeam.'</strong></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p class="'.$awayWon.'"><strong>'.$fixture->head2head->lastAwayWinAwayTeam->result->goalsAwayTeam.'</strong></p>
              </div>
              <div class="column" style="text-align: center;">
                <p><time>'.$matchDate.'</time></p>
                <hr style="margin: 3px 0px 3px 0px;">
                <p><time>'.$matchHour.'</time></p>
              </div>
            </div>
          </div>';
        }else {
          echo '<p><strong>Cette équipe n\'a jamais remporté ce matchs durant les '.$count.' derniers</strong></p><br>';
        } ?>
      </div>
    </article>
      </div>
    </article>
  </div>
</section>
