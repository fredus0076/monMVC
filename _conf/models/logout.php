<?php
$objUser = new User($db);
$objUser->logoutUser();
$destination='welcome';
$_SESSION['msg'] = '<div class="success callout">A bientôt</div>';
