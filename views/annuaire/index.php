<?php
// $agents est fourni par AnnuaireController::index()
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annuaire des agents - Intranet Mairie d'Yzeure</title>
    <link rel="stylesheet" href="/intranet-yzeure/public/css/style.css">
</head>
<body>
    <h1>Annuaire des agents</h1>

    <form method="get" action="/intranet-yzeure/public/index.php">
        <input type="hidden" name="route" value="annuaire">
        <label for="q">Recherche (nom, prénom, service, direction) :</label>
        <input type="text" name="q" id="q" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
        <button type="submit">Rechercher</button>
    </form>

    <?php if (empty($agents)) : ?>
        <p>Aucun agent trouvé.</p>
    <?php else : ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Direction</th>
                    <th>Service</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($agents as $agent) : ?>
                <tr>
                    <td><?= htmlspecialchars($agent['nom'] ?? '') ?></td>
                    <td><?= htmlspecialchars($agent['prenom'] ?? '') ?></td>
                    <td><?= htmlspecialchars($agent['direction'] ?? '') ?></td>
                    <td><?= htmlspecialchars($agent['service'] ?? '') ?></td>
                    <td><?= htmlspecialchars($agent['email'] ?? '') ?></td>
                    <td><?= htmlspecialchars($agent['telephone'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>

