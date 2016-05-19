<?php
$connected[0][0]['action'] = 'destination=login';
$connected[0][0]['libelle'] = 'Me connecter';


$connected[1][0]['action'] = 'destination=listeusers';
$connected[1][0]['libelle'] = 'Utilisateurs';

$connected[1][99]['action'] = 'action=logout';
$connected[1][99]['libelle'] = 'Me déconnecter';

?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li> 
      <li><a href="#">Page 3</a></li> 
    </ul>
  </div>
</nav>
...

