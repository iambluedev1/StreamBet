<?php
$pageTitle = "Inscription";
$pageDesc = "Inscrivez vous afin d'acceder à toutes les fonctionnalités de StreamBet !";

include '../_include/head.php';
include '../_include/nav.php';
 ?>
<section class="hero is-success" style="margin-top: 50px;">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        <?php echo $pageTitle; ?>
      </h1>
      <h1 class="subtitle">
        <?php echo $pageDesc; ?>
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
                <label class="label">Email :</label>
                <p class="control has-icons-left">
                  <input class="input" type="email" placeholder="Email" name="email" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                </p>
              </div>
              <div class="field">
                <label class="label">Pseudo :</label>
                <p class="control has-icons-left">
                  <input class="input" type="username" name="email" placeholder="Username" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                </p>
              </div>
              <div class="field">
                <div class="columns">
                  <div class="column">
                    <label class="label">Nom :</label>
                    <p class="control has-icons-left">
                      <input class="input" type="text" name="surname" placeholder="Surname" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                      </span>
                    </p>
                  </div>
                  <div class="column">
                    <label class="label">Prénom :</label>
                    <p class="control has-icons-left">
                      <input class="input" type="text" name="name" placeholder="Name" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="field">
                <div class="columns">
                  <div class="column">
                    <label class="label">Mot de Passe :</label>
                    <p class="control has-icons-left">
                      <input class="input" type="password" name="password" placeholder="Password" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                      </span>
                    </p>
                  </div>
                  <div class="column">
                    <label class="label">Confirmer le mot de Passe :</label>
                    <p class="control has-icons-left">
                      <input class="input" type="password" name="passwordConfirm" placeholder="Confirm password" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label is-hidden-touch"><input class="checkbox" type="checkbox" name="emailing" value="" checked>&nbsp;Je souhaite recevoir des emails de la part de StreamBet</label>
              </div>
              <div class="field">
                <div class="columns">
                  <div class="column is-2">
                    <button type="submit" name="submit" class="button is-success is-rounded"><strong>Valider</strong></button>
                  </div>
                  <div class="column is-2">
                    <button type="reset" name="reset" class="button is-text is-rounded"><strong>Reset</strong></button>
                  </div>
                  <div class="column is-8">
                  </div>
                </div>
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
