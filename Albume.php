<?php
$db = mysqli_connect('localhost', 'root', '', 'muzicadb') or die('Error connecting to MySQL server.');
$showTable = false;
$errorMsgArtist = '';
$errorMsgAlbum = '';

if (isset($_POST['showAlbums'])) {
    $queryAllAlbums = "SELECT a.titlu, a.nrMelodii, ar.nume AS numeArtist
                      FROM Albume a
                      JOIN Artisti ar ON a.idArtist = ar.idArtist";
    $resultAllAlbums = mysqli_query($db, $queryAllAlbums) or die('Error querying database.');
    $result = $resultAllAlbums;
    $showTable = true;
}

if (isset($_POST['searchByArtist'])) {
    $artistName = mysqli_real_escape_string($db, $_POST['artistName']);
    $queryByArtist = "SELECT a.titlu, a.nrMelodii, ar.nume AS numeArtist
                      FROM Albume a
                      JOIN Artisti ar ON a.idArtist = ar.idArtist
                      WHERE ar.nume LIKE '%$artistName%'";
    $result = mysqli_query($db, $queryByArtist) or die('Error querying database.');
    if (mysqli_num_rows($result) == 0) {
        $errorMsgArtist = "Artistul nu se află în baza de date. Încearcă din nou.";
    }
    $showTable = true;
}

if (isset($_POST['searchByAlbum'])) {
    $albumTitle = mysqli_real_escape_string($db, $_POST['albumTitle']);
    $queryByAlbum = "SELECT a.titlu, a.nrMelodii, ar.nume AS numeArtist
                     FROM Albume a
                     JOIN Artisti ar ON a.idArtist = ar.idArtist
                     WHERE a.titlu LIKE '%$albumTitle%'";
    $result = mysqli_query($db, $queryByAlbum) or die('Error querying database.');
    if (mysqli_num_rows($result) == 0) {
        $errorMsgAlbum = "Albumul nu se află în baza de date. Încearcă din nou.";
    }
    $showTable = true;
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
            padding: 0;
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
            margin-top: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
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
        <form method="post" action="">
            <button type="submit" name="showAlbums">Afișare Albume</button>
        </form>
        <form method="post" action="">
            <label for="artistName">Caută Artist:</label>
            <input type="text" id="artistName" name="artistName" required>
            <button type="submit" name="searchByArtist">Caută Artist</button>
        </form>
        <?php echo "<p style='color: red;'>$errorMsgArtist</p>"; ?>
        <form method="post" action="">
            <label for="albumTitle">Caută Album:</label>
            <input type="text" id="albumTitle" name="albumTitle" required>
            <button type="submit" name="searchByAlbum">Caută Album</button>
        </form>
        <?php echo "<p style='color: red;'>$errorMsgAlbum</p>"; ?>
    </div>

    <div class="result-table">
        <?php
        if ($showTable && empty($errorMsgArtist) && empty($errorMsgAlbum)) {
            echo "<h2>Rezultate</h2>";
            echo "<table border='1'>
                <tr>
                    <th>Titlu Album</th>
                    <th>Număr Melodii</th>
                    <th>Nume Artist</th>
                </tr>";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['titlu'] . "</td>";
                echo "<td>" . $row['nrMelodii'] . "</td>";
                echo "<td>" . $row['numeArtist'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </div>
</body>
</html>
