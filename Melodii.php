<?php
$db = mysqli_connect('localhost', 'root', '', 'muzicadb') or die('Error connecting to MySQL server.');

if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($db, $_POST['searchTerm']);

    $query = "SELECT Melodii.titlu, Melodii.gen, Melodii.dataLansare, Melodii.rating, Albume.titlu AS numeAlbum, Artisti.nume AS numeArtist, Features.idFeature, Features.idMelodie, Features.idArtist AS idArtistFeature
              FROM Melodii
              JOIN Albume ON Melodii.idAlbum = Albume.idAlbum
              JOIN Artisti ON Albume.idArtist = Artisti.idArtist
              LEFT JOIN Features ON Melodii.idMelodie = Features.idMelodie
              WHERE Melodii.titlu LIKE '%$searchTerm%'";

    $result = mysqli_query($db, $query) or die('Error querying database.');

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Rezultate Căutare Melodii</h2>";

        echo "<table border='1'>
                <tr>
                    <th>Titlu</th>
                    <th>Gen Muzical</th>
                    <th>Data Lansare</th>
                    <th>Rating</th>
                    <th>Album</th>
                    <th>Artist</th>
                    <th>Featuring</th>
                </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['titlu'] . "</td>";
            echo "<td>" . $row['gen'] . "</td>";
            echo "<td>" . $row['dataLansare'] . "</td>";
            echo "<td>" . $row['rating'] . "</td>";
            echo "<td>" . $row['numeAlbum'] . "</td>";
            echo "<td>" . $row['numeArtist'] . "</td>";

            echo "<td>";
            if ($row['idFeature'] !== null) {
                $featureArtists = getFeatureArtists($row['idMelodie']);
                echo implode(", ", $featureArtists);
            }
            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nu au fost găsite melodii conform căutării.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 150px 0 0;
            background: url('images.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-image: url('header.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            padding: 20px;
            text-align: center;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1, h2 {
            margin: 0;
        }

        h2 {
            font-size: 18px;
        }

        .header-buttons {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        button {
            background-color: rgb(156, 17, 17);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 0 10px;
        }

        button:hover {
            background-color: #8b0000;
        }

        .main-content {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .search-form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            width: 300px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: rgb(156, 17, 17);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #8b0000;
        }

        .result-table {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <header>
        <div>
            <h1>Dicționarul Ritmurilor</h1>
            <h2>Portalul web unde găsești informații despre artiștii și melodiile tale preferate</h2>
        </div>
        <div class="header-buttons">
            <a href="../myPage"><button>Acasa</button></a>
        </div>
    </header>

    <div class="main-content">

        <form method='post' action=''>
            <button type='submit' name='displayAll'>Afișare Melodii</button>
        </form>

        <form class="search-form" method='post' action=''>
            <input type='text' name='searchTerm' placeholder='Introduceti titlul melodiei' />
            <button type='submit' name='search'>Cauta Melodie</button>
        </form>

        <?php
        if (isset($_POST['displayAll'])) {
            $query = "SELECT Melodii.titlu, Melodii.gen, Melodii.dataLansare, Melodii.rating, Albume.titlu AS numeAlbum, Artisti.nume AS numeArtist
                      FROM Melodii
                      JOIN Albume ON Melodii.idAlbum = Albume.idAlbum
                      JOIN Artisti ON Albume.idArtist = Artisti.idArtist";

            $result = mysqli_query($db, $query) or die('Error querying database.');

            echo "<h2>Lista Melodiilor</h2>";

            echo "<table border='1'>
                    <tr>
                        <th>Titlu</th>
                        <th>Gen Muzical</th>
                        <th>Data Lansare</th>
                        <th>Rating</th>
                        <th>Album</th>
                        <th>Artist</th>
                    </tr>";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['titlu'] . "</td>";
                echo "<td>" . $row['gen'] . "</td>";
                echo "<td>" . $row['dataLansare'] . "</td>";
                echo "<td>" . $row['rating'] . "</td>";
                echo "<td>" . $row['numeAlbum'] . "</td>";
                echo "<td>" . $row['numeArtist'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>

    </div>

    <?php
    mysqli_close($db);
    ?>

</body>

</html>

<?php
function getFeatureArtists($idMelodie)
{
    global $db;
    $featureArtists = array();
    $query = "SELECT Artisti.nume
              FROM Features
              JOIN Artisti ON Features.idArtist = Artisti.idArtist
              WHERE Features.idMelodie = $idMelodie";
    $result = mysqli_query($db, $query) or die('Error querying database.');

    while ($row = mysqli_fetch_array($result)) {
        $featureArtists[] = $row['nume'];
    }

    return $featureArtists;
}
?>
