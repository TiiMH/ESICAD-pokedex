<!-- 
    Ce fichier représente la page de liste de tous les pokémons.
-->

<?php
require_once("head.php");
require_once('database-connection.php');

$query = $databaseConnection->query("SELECT NomPokemon, IdTypePokemon, IdSecondTypePokemon, urlPhoto from pokemon");
if (!$query) {
    throw new RuntimeException("Cannot execute query. Cause: " . mysqli_error($databaseConnection));
} else {
    $pokemons = $query->fetch_all(MYSQLI_ASSOC);
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    echo "<tr><th>Nom</th><th>Type</th><th>Second Type</th><th>Image</th></tr>";
    
    foreach ($pokemons as $pokemon) {
        echo "<tr><td>" . $pokemon["NomPokemon"] . "</td><td>" . $pokemon['IdTypePokemon'] . "</td><td>" . $pokemon["IdSecondTypePokemon"] . "</td><td><img src='" . $pokemon['urlPhoto']. "' alt='" . $pokemon["NomPokemon"] . "' width='50' height='50'></td></tr>";
    }
    echo "</table>";
}
require_once("footer.php");
?> 


