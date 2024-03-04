<?php
require_once("head.php");
require_once("database-connection.php");

$idPokemon = $_GET['id'];

$query = $databaseConnection->prepare("SELECT * FROM pokemon WHERE idPokemon = ?");
$query->bind_param("i", $idPokemon);
$query->execute();

$result = $query->get_result()->fetch_assoc();
$query->close();

?>

<h1>Pokemon n° <?php echo var_dump('idPokemon'); ?></h1>

<a href="pokemon-details.php?id=<?php echo $result['idPokemon']; ?>">
  <h2><?php echo $result['NomPokemon']; ?></h2>
</a>

<p>Type: <?php echo $result['type1']; ?></p>  <!-- Autres détails du Pokemon -->

<p>Points de vie: <?php echo $result['hp']; ?></p>  <!-- Ajoutez d'autres détails selon vos besoins -->
