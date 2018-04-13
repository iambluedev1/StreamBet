<nav class="panel">
<p class="panel-heading">
  <a href="admin.php">
    Administration
  </a>
</p>
<div class="panel-block">
  <p class="title is-6">
    Résumés
  </p>
</div>
<a class="panel-block <?php echo $newPostActif ?>" href="newPost.php">
  <span class="panel-icon">
    <i class="fas fa-plus"></i>
  </span>
  Ajouter
</a>
<a class="panel-block <?php echo $deletePostActif ?>" href="deletePost.php">
  <span class="panel-icon">
    <i class="fas fa-times"></i>
  </span>
  Supprimer
</a>
<div class="panel-block">
  <p class="title is-6">
    Index
  </p>
</div>
<a class="panel-block" disabled>
  <span class="panel-icon">
    <i class="fas fa-edit"></i>
  </span>
  Editer
</a>
</nav>
