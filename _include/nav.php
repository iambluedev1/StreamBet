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
    <a class="navbar-item" href="../index">
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
          <a class="navbar-item  has-text-weight-bold" href="/channel/bein">
            Beinsport 1/2/3
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item has-text-weight-bold" href="/channel/canal">
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
          <a class="navbar-item has-text-weight-bold" href="/coupe/coupe-du-monde">
            <i class="fas fa-trophy"></i>&nbsp;
            Coupe du Monde
          </a>
          <a class="navbar-item has-text-weight-bold" href="/coupe/champions-league">
            <i class="fas fa-trophy"></i>&nbsp;
            Champion's League
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item has-text-weight-bold" href="/championnat/premiere-league">
            Premiere League
          </a>
          <a class="navbar-item has-text-weight-bold" href="/championnat/liga-santander">
            Liga Santander
          </a>
          <a class="navbar-item has-text-weight-bold" href="/championnat/ligue-1">
            Ligue 1
          </a>
          <a class="navbar-item has-text-weight-bold" href="/championnat/ligue-2">
            Ligue 2
          </a>
          <a class="navbar-item has-text-weight-bold" href="/championnat/serie-a">
            Serie A
          </a>
          <a class="navbar-item has-text-weight-bold" href="/championnat/serie-b">
            Serie B
          </a>
          <a class="navbar-item has-text-weight-bold" href="/championnat/bundesligua-1">
            Bundesliga
          </a>
          <a class="navbar-item has-text-weight-bold" href="/championnat/bundesligua-2">
            Bundesliga 2
          </a>
          <a class="navbar-item has-text-weight-bold" href="/championnat/liga-nos">
            Liga NOS
          </a>
        </div>
      </div>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons has-addons">
          <a href="/user/register" class="button is-rounded is-success">
            <strong>
              Register
            </strong>
          <a href="/user/login" class="button is-rounded is-light">
            <strong>
              Login
            </strong>
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
