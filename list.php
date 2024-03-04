<!--  Ce fichier représente la page de liste de tous les pokémons -->

<?php
require_once("head.php");
require_once('database-connection.php');

try {
    $query = $databaseConnection->query("SELECT NomPokemon, urlPhoto, T.libelleType AS 'Type 1', T2.libelleType AS 'Type 2' from pokemon P JOIN typepokemon T ON P.IdTypePokemon = T.IdType LEFT JOIN typepokemon T2 ON P.IdSecondTypePokemon = T2.IdType ORDER BY IdPokemon");
    if (!$query) {
        throw new RuntimeException("Cannot execute query. Cause: " . mysqli_error($databaseConnection));
    }

    $pokemons = $query->fetch_all(MYSQLI_ASSOC);

    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    echo "<tr>
      <th>Nom</th>
      <th>Type</th>
      <th>SecondType</th>
      <th>Image</th></tr>";

    foreach ($pokemons as $pokemon) {
        echo "<tr>";     
        echo "<td>" . ($pokemon["NomPokemon"]) . "</td>";
        echo "<td>" . ($pokemon['Type 1']) . "</td>";
        echo "<td>" . ($pokemon["Type 2"]) . "</td>";
        echo "<td><img src='" . ($pokemon['urlPhoto']) . "' alt='" . ($pokemon["NomPokemon"]) . "' width='50' height='50'></td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (Exception $e) {
    echo "Une erreur s'est produite : " . ($e->getMessage());
} finally {
    require_once("footer.php");
}
?>
