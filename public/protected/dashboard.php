<?php
require '../../src/auth/verify-token.php';
?>

<h1>Olá, <?= htmlspecialchars($username) ?>!</h1>
<p>Seu token: <?= htmlspecialchars($_SESSION['jwt']) ?></p>
