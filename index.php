<?php
$pageTitle = "Index";
$pageDesc = 'Toutes les infos du foot en streaming !';

include("_include/head.php");
include("_include/nav.php");
?>
<section class="hero is-large has-carousel is-hidden-mobile">
  <div class="hero-body" style="z-index: 2;">
    <div class="container">
      <img src="img/StreamBet-Logo-Small.png" style="height: 100px; position: fixed;">
    </div>
  </div>
  <div class="hero-carousel carousel-animated carousel-animate-fade" data-autoplay="true" style="position: fixed; z-index: 1;">
    <div class='carousel-container'mobile
      <div class='carousel-item has-background is-active'>
        <img class="is-background" src="http://sport24.lefigaro.fr/var/plain_site/storage/images/football/equipe-de-france/actualites/france-bresil-en-direct-du-stade-de-france-743259/18529966-1-fre-FR/France-Bresil-en-DIRECT-du-Stade-de-France.jpg" alt="" />
      </div>
      <div class='carousel-item has-background'>
        <img class="is-background" src="https://lnt.ma/wp-content/uploads/2018/03/coupe-du-monde.jpg" alt="" />
      </div>
      <div class='carousel-item has-background'>
        <img class="is-background" src="http://img.lemde.fr/2018/01/14/110/0/4896/2448/0/0/60/0/22686c9_ed12889d11a341ddb6d53ebb199af5b4-ed12889d11a341ddb6d53ebb199af5b4-0.jpg" alt="" />
      </div>
    </div>
  </div>
</section>
<section class="hero is-medium" id="main">
  <div class="hero-head" style="z-index: 3; margin-bottom: 20px;">
    <div class="has-text-centered">
    <a class="has-text-white"href="#1">
      <i class="fas fa-arrow-circle-down fa-3x"></i>
    </a>
    </div>
  </div>
<div style="z-index: 3; background-color: white;">
  <div class="hero-body" id="1">
    <div class="container">
      <div class="columns">
        <div class="column">
          <div>
            <i class="fas fa-video fa-7x"></i><br><br>
            <h1 class="title is-4">Streaming</h1>
            <h1 class="subtitle is-4">Regardez tout les matchs en streaming 100% gratuitement !</h1>
            <a href="channel/bein" class="button is-medium is-success is-outlined is-rounded"><i class="fas fa-plus"></i>&nbsp;Voir</i></a>
          </div>
        </div>
        <div class="column">
          <div>
            <i class="fas fa-trophy fa-7x"></i><br><br>
            <h1 class="title is-4">Competitions</h1>
            <h1 class="subtitle is-4">Retrouvez vos competitions préférées et tout les resultats des matchs !</h1>
              <a href="soccer/league?soccerSeasonID=467" class="button is-medium is-success is-outlined is-rounded"><i class="fas fa-plus"></i>&nbsp;Voir</i></a>
          </div>
        </div>
        <div class="column">
          <div>
            <i class="fas fa-shield-alt fa-7x"></i><br><br>
            <h1 class="title is-4">Equipes</h1>
            <h1 class="subtitle is-4">Suivez votre équipe favorite et toutes ses statistiques !</h1>
            <a href="soccer/team?teamID=http://api.football-data.org/v1/teams/524" class="button is-medium is-success is-outlined is-rounded"><i class="fas fa-plus"></i>&nbsp;Voir</i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include('_include/footer.php');
?>
</section>
<script>
function navbarBurgerToggle() {
  var $burger = document.getElementById("navbarBurger");
  var $menu = document.getElementById("navbarMenu");

  $burger.classList.toggle('is-active');
  $menu.classList.toggle('is-active');
}
</script>
<script type="text/javascript" src="/node_modules/bulma-extensions/bulma-carousel/dist/bulma-carousel.min.js"></script>
