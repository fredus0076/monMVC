<?php
$connected[0][0]['action'] = 'destination=login';
$connected[0][0]['libelle'] = 'Me connecter';


$connected[1][0]['action'] = 'destination=listeusers';
$connected[1][0]['libelle'] = 'Utilisateurs';

$connected[1][99]['action'] = 'action=logout';
$connected[1][99]['libelle'] = 'Me déconnecter';

?>
<nav>
    <ul class="menu">
        <li><a href="index.php">home</a></li>
        <?php
        foreach($connected[$_SESSION['connected']] as $menu) {
        ?>
            <li><a href="index.php?<?=$menu['action'];?>"><?=$menu['libelle'];?></a></li>
        <?php
        
        }
        ?>
        
    </ul>
</nav>


