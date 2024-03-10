<!--Ce fichier représente la page de résultats de recherche de pokémons du site.-->

<?php 
    $servername = "localhost";
        $username = "root";
        $password = "null";
        $database = "tp2-pokemon";
    $conn = new mysqli($servername, $username, $password, $database);

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $searchTerm = $conn->real_escape_string(trim($_GET['search']));
    $sql = "SELECT * FROM pokemon WHERE NomPokemon LIKE '%{$searchTerm}%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<img src='{$row['urlPhoto']}' alt='{$row['NomPokemon']}'>";
            echo "<h2>{$row['NomPokemon']}</h2>";
            echo "</div>";
        }
    } else 
    
    {
    echo "No results found.";
    }

    $_SESSION['search_term'] = $searchTerm;
}

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['add_favorite']) && isset($_SESSION['favorites'])) {
    $pokemonId = intval($_GET['add_favorite']);
    array_push($_SESSION['favorites'], $pokemonId);
}

if (isset($_GET['remove_favorite']) && isset($_SESSION['favorites'])) {
    $pokemonId = intval($_GET['remove_favorite']);
    if (($key = array_search($pokemonId, $_SESSION['favorites'])) !== false) {
        unset($_SESSION['favorites'][$key]);
    }
}

if (isset($_SESSION['favorites'])) {
    echo "<h3>Favorites:</h3>";
    echo "<ul>";
    foreach ($_SESSION['favorites'] as $favoriteId) {
        $sql = "SELECT * FROM pokemon WHERE IdPokemon = {$favoriteId}";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<li><img src='{$row['urlPhoto']}' alt='{$row['NomPokemon']}'>";
            echo "<a href='?remove_favorite={$row['IdPokemon']}'>Remove</a></li>";
        }
    }
    echo "</ul>";
}

$conn->close();
?>