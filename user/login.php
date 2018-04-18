<?php
$pageTitle = "Login";
$pageDesc = "Connectez vous afin d'acceder à toutes les fonctionnalités de StreamBet !";

include '../_include/head.php';
include '../_include/nav.php';
 ?>
<section class="hero is-success" style="margin-top: 50px;">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Connexion
      </h1>
      <h1 class="subtitle">
        <?php echo $pageDesc ?>
      </h1>
    </div>
  </div>
</section>
<section class="hero">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column is-3">
        </div>
        <div class="column is-6">
          <div class="box">
            <form class="form" action="login.php" method="post">
              <div class="field">
                <label class="label">Email/Pseudo :</label>
                <p class="control has-icons-left">
                  <input class="input" type="email" placeholder="Email" name="email" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                </p>
              </div>
              <div class="field">
                <label class="label">Mot de Passe :</label>
                <p class="control has-icons-left">
                  <input class="input" type="password" name="password" placeholder="Password" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                  </span>
                </p>
              </div>
              <div class="field">
                <label class="label is-hidden-touch"><input class="checkbox" type="checkbox" name="remember" value="" checked>&nbsp;Rester connecté</label>
              </div>
              <div class="field">
                <button type="submit" name="submit" class="button is-success is-rounded"><strong>Login</strong></button>
              </div>
            </form>
          </div>
        </div>
        <div class="column is-3">
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include '../_include/footer.php';
 ?>
