<?php
require_once("head.php");
require_once('database-connection.php');

$idPokemon = isset($_GET['id']) ? intval($_GET['id']) : 0;
$idPokemon = max(0, $idPokemon);

$stmt = $databaseConnection->prepare("SELECT P.NomPokemon AS 'Nom', P.IdPokemon AS 'Id', P.urlPhoto AS 'Photo', P.PV AS 'PV', P.Attaque AS 'Attaque', P.Defense AS 'Defense', P.Vitesse AS 'Vitesse', P.Special AS 'Special', E.idEvolution AS 'Evolution', P2.NomPokemon AS 'Nom2', P2.IdPokemon AS 'Id2', P2.urlPhoto AS 'Photo2' 
    FROM evolutionpokemon E 
    JOIN pokemon P ON E.IdPokemon = P.idPokemon 
    LEFT JOIN Pokemon P2 ON E.idEvolution = P2.IdPokemon 
    WHERE P.IdPokemon = ?");

$stmt->bind_param("i", $idPokemon);
$stmt->execute();

$result = $stmt->get_result();

if (!$result) {
    error_log("Cannot execute query. Cause: " . $stmt->error);
    throw new RuntimeException("An error occurred while fetching data.");
} else {
    $idpokemon = $result->fetch_assoc();

    echo "<h1> Pokemon n° " . htmlspecialchars($idpokemon['Id']) . "</h1>
        <h3>" . htmlspecialchars($idpokemon['Nom']) . "</h3>
        <img src='" . htmlspecialchars($idpokemon['Photo']). "' alt='" . htmlspecialchars($idpokemon["Nom"]) . "'>";

    echo "<table>";
    echo "<tr>
        <th>PV</th>
        <th>Attaque</th>
        <th>Defense</th>
        <th>Vitesse</th>
        <th>Special</th>
    </tr>";

    echo "<tr>
        <td>" . htmlspecialchars($idpokemon["PV"]) . "</td>
        <td>" . htmlspecialchars($idpokemon["Attaque"]) . "</td>
        <td>" . htmlspecialchars($idpokemon["Defense"]) . "</td>
        <td>" . htmlspecialchars($idpokemon["Vitesse"]) . "</td>
        <td>" . htmlspecialchars($idpokemon["Special"]) . "</td>
    </tr>";
}

echo "</table>";
$databaseConnection->close();

require_once("footer.php");
?>