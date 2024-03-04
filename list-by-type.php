<!-- Ce fichier représente la page de liste par type de pokémon du site -->

<?php
require_once("head.php");
?>

<?php
require_once("footer.php");
require_once ('config.php');
$sql = "SELECT DISTINCT type FROM pokemons";
$result = $conn->query($sql);
?>
<?php while($row = $result->fetch_assoc()): ?>
<h2><?php echo $row['type']; ?></h2>
<table>
    <tr>
        <th>Numéro</th>
        <th>Image</th>
        <th>Nom</th>
    </tr>
    <?php
    $sql2 = "SELECT * FROM pokemons WHERE type = '".$row['type']."' ORDER BY nom";
    $result2 = $conn->query($sql2);
    while($row2 = $result2->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row2['id_pokemon']; ?></td>
        <td><img src="<?php echo $row2['image']; ?>" alt="<?php echo $row2['nom']; ?>" width="50" height="50"></td>
        <td><a href="pokemon_detail.php?id=<?php echo $row2['id_pokemon']; ?>"><?php echo $row2['nom']; ?></a></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php endwhile; 
?>


