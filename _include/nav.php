<script>
function navbarBurgerToggle() {
  var $burger = document.getElementById("navbarBurger");
  var $menu = document.getElementById("navbarMenu");

  $burger.classList.toggle('is-active');
  $menu.classList.toggle('is-active');
}
</script>
<nav class="navbar is-dark is-fixed-top">
<div class="container">
  <div class="navbar-brand">
    <a class="navbar-item" href="../index.php">
      <img src="../img/StreamBet-Logo-Small.png" width="112" height="28">
    </a>
    <div id="navbarBurger" class="navbar-burger burger" onclick="navbarBurgerToggle()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div id="navbarMenu" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link has-text-weight-bold hvr-underline-reveal">
          <i class="fas fa-video"></i>
          &nbsp;&nbsp;Streaming
        </a>
        <div class="navbar-dropdown is-boxed">
          <a class="navbar-item  has-text-weight-bold" href="/channel/bein.php">
            Beinsport 1/2/3
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item has-text-weight-bold" href="/channel/canal.php">
            Canal + / Sport
          </a>
        </div>
      </div>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link has-text-weight-bold hvr-underline-reveal">
          <i class="far fa-calendar-alt"></i>
          &nbsp;&nbsp;Matchs
        </a>
        <div class="navbar-dropdown is-boxed">
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=467">
            <i class="fas fa-trophy"></i>&nbsp;
            Coupe du Monde
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=464">
            <i class="fas fa-trophy"></i>&nbsp;
            Champion's League
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=445">
            Premiere League
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=455">
            Liga Santander
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=450">
            Ligue 1
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=451">
            Ligue 2
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=456">
            Serie A
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=459">
            Serie B
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=452">
            Bundesliga
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=453">
            Bundesliga 2
          </a>
          <a class="navbar-item has-text-weight-bold" href="/soccer/league.php?soccerSeasonID=457">
            Liga NOS
          </a>
        </div>
      </div>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="dropdown is-hoverable">
          <div class="dropdown-trigger">
            <a class="button is-rounded is-success hvr-icon-grow" href="https://paypal.me/Tagueo" aria-haspopup="true" aria-controls="donate-menu">
                <i class="far fa-credit-card hvr-icon"></i>
              <span class="has-text-weight-bold">
                &nbsp;Donate
              </span>
            </a>
          </div>
          <div class="dropdown-menu" id="donate-menu" role="menu">
            <div class="dropdown-content">
              <div class="dropdown-item">
                <p>Les dons permettent à&nbsp;<strong>StreamBet</strong>&nbsp;de survivre.</p>
              </div>
              <div class="dropdown-item">
                <p>En effet, héberger et développer le site coute de l'argent. Faire un don nous permet donc au site de continuer d'exister.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
