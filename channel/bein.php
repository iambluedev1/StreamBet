<?php
$pageTitle = "Streaming Beinsport 1, 2 et 3";
$pageDesc = "Streaming Gratuit 24/7 Beinsport 1, 2 et 3";

include("../include/head.php");
include("../include/nav.php");
?>
<section class="hero is-success has-fade-in" style="padding-top: 50px;">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        <i class="fas fa-tv"></i>&nbsp;Beinsport
      </h1>
      <h2 class="subtitle">
        Regardez toutes les chaines de Beinsport en streaming gratuitement sur StreamBet !
      </h2>
    </div>
  </div>
  <div class="hero-foot">
    <div class="tabs is-centered is-boxed is-medium">
      <ul>
        <li id="bein1-tab" class="is-active"><a onclick="switchCatTab('bein1')">Beinsport 1</a></li>
        <li id="bein2-tab"><a onclick="switchCatTab('bein2')">Beinsport 2</a></li>
        <li id="bein3-tab"><a onclick="switchCatTab('bein3')">Beinsport 3</a></li>
      </ul>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div id="bein1" class="notification is-white has-fade-in is-active" style="border-radius: 0px 0px 5px 5px;">
      <div class="columns">
        <div class="column is-one-quarter">
          <div class="notification">
            <button class="delete"></button>
            Cliquez sur la croix bleue pour supprimer les pubs.
            Attention, les premières fois que vous cliquez, vous serez redirigé sur un autre onglet.
          </div>
        </div>
        <div class="column">
          <iframe src="http://www.beinsport-streaming.info/stream/ch1.php" frameborder="0" height="720" scrolling="no" width="1280" allowfullscreen></iframe>
        </div>
        <div class="column is-one-quarter">
        </div>
      </div>
    </div>
    <div id="bein2" class="notification is-white has-fade-in hidden" style="border-radius: 0px 0px 5px 5px;">
      <div class="columns">
        <div class="column is-one-quarter">
          <div class="notification">
            <button class="delete"></button>
            Cliquez sur la croix bleue pour supprimer les pubs.
            Attention, les premières fois que vous cliquez, vous serez redirigé sur un autre onglet.
          </div>
        </div>
        <div class="column">
          <iframe src="http://www.beinsport-streaming.info/stream/ch8.php" frameborder="0" height="720" scrolling="no" width="1280" allowfullscreen></iframe>        </div>
        <div class="column is-one-quarter">
        </div>
      </div>
    </div>
    <div id="bein3" class="notification is-white has-fade-in hidden" style="border-radius: 0px 0px 5px 5px;">
      <div class="columns">
        <div class="column is-one-quarter">
          <div class="notification">
            <button class="delete"></button>
            Cliquez sur la croix bleue pour supprimer les pubs.
            Attention, les premières fois que vous cliquez, vous serez redirigé sur un autre onglet.
          </div>
        </div>
        <div class="column">
          <iframe src="http://www.beinsport-streaming.info/stream/ch9.php" frameborder="0" height="720" scrolling="no" width="1280" allowfullscreen></iframe>
        </div>
        <div class="column is-one-quarter">
        </div>
      </div>
    </div>
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
      $("#bein1").addClass("hidden");
      $("#bein2").addClass("hidden");
      $("#bein3").addClass("hidden");
  }
</script>
