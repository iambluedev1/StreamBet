<?php
$pageTitle = "Streaming Canal +, Canal + Sport";
$pageDesc = "Streaming Gratuit 24/7 Canal +, Canal + Sport";

include("../_include/head.php");
include("../_include/nav.php");
?>
<section class="hero is-success has-fade-in" style="padding-top: 50px;">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        <i class="far fa-futbol"></i>
        Canal + / Sport
      </h1>
      <h2 class="subtitle">
        Streaming en direct
      </h2>
    </div>
  </div>
  <div class="hero-foot">
    <div class="tabs is-centered is-boxed">
      <ul>
        <li id="canal-tab" class="is-active"><a onclick="switchCatTab('canal')">Canal +</a></li>
        <li id="canalsport-tab"><a onclick="switchCatTab('canalsport')">Canal + Sport</a></li>
      </ul>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div id="canal" class="notification is-white has-fade-in is-active" style="border-radius: 0px 0px 5px 5px;">
      <div class="columns">
        <div class="column is-3">
          <div class="notification">
            <button class="delete"></button>
            Cliquez sur la croix bleue pour supprimer les pubs.
            Attention, les premières fois que vous cliquez, vous serez redirigé sur un autre onglet.
          </div>
        </div>
        <div class="column">
          <iframe src="http://www.beinsport-streaming.info/stream/ch10.php" frameborder="0" height="450" scrolling="no" width="700" allowfullscreen></iframe>
        </div>
        <div class="column is-3s">
        </div>
      </div>
    </div>
    <div id="canalsport" class="notification is-white has-fade-in hidden" style="border-radius: 0px 0px 5px 5px;">
      <div class="columns">
        <div class="column is-one-quarter">
          <div class="notification">
            <button class="delete"></button>
            <strong>Publicité</strong>
          </div>
        </div>
        <div class="column">
          <iframe src="http://www.beinsport-streaming.info/stream/ch11.php" frameborder="0" height="450" scrolling="no" width="700" allowfullscreen></iframe>        </div>
        <div class="column is-one-quarter">
        </div>
      </div>
    </div>
  </div>
</section>
<br>
<?php
include("../_include/footer.php");
?>
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
      $("#canal").addClass("hidden");
      $("#canalsport").addClass("hidden");
  }
</script>
