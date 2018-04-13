<?php
$pageTitle = "Streaming Canal +, Canal + Sport";
$pageDesc = "Streaming Gratuit 24/7 Canal +, Canal + Sport";

include("../include/head.php");
include("../include/nav.php");
?>
<section class="hero is-success has-fade-in" style="padding-top: 50px;">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        <i class="far fa-futbol"></i>
        Canal +
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
      <h3 class="title is-5">En cours de dévellopement</h3>
      <h3 class="subtitle is-5">Patience, ce sera bientôt disponible ;)</h3>
    </div>
    <div id="canalsport" class="notification is-white has-fade-in hidden" style="border-radius: 0px 0px 5px 5px;">
      <h3 class="title is-5">En cours de dévellopement</h3>
      <h3 class="subtitle is-5">Patience, ce sera bientôt disponible ;)</h3>
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
      $("#canal").addClass("hidden");
      $("#canalsport").addClass("hidden");
  }
</script>
