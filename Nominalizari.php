<?php
$db = mysqli_connect('localhost', 'root', '', 'muzicadb') or die('Error connecting to MySQL server.');

$queryAllNominalizations = "SELECT Nominalizari.nume, Nominalizari.categorie, Nominalizari.dataNominalizare, 
          Artisti.nume AS numeArtist, Albume.titlu AS numeAlbum, Melodii.titlu AS numeMelodie
          FROM Nominalizari
          LEFT JOIN Artisti ON Nominalizari.idArtist = Artisti.idArtist
          LEFT JOIN Albume ON Nominalizari.idAlbum = Albume.idAlbum
          LEFT JOIN Melodii ON Nominalizari.idMelodie = Melodii.idMelodie";

$queryByArtist = "SELECT Nominalizari.nume, Nominalizari.categorie, Nominalizari.dataNominalizare, 
          Artisti.nume AS numeArtist, Albume.titlu AS numeAlbum, Melodii.titlu AS numeMelodie
          FROM Nominalizari
          LEFT JOIN Artisti ON Nominalizari.idArtist = Artisti.idArtist
          LEFT JOIN Albume ON Nominalizari.idAlbum = Albume.idAlbum
          LEFT JOIN Melodii ON Nominalizari.idMelodie = Melodii.idMelodie"; 

$queryByAlbum = "SELECT Nominalizari.nume, Nominalizari.categorie, Nominalizari.dataNominalizare, 
          Artisti.nume AS numeArtist, Albume.titlu AS numeAlbum, Melodii.titlu AS numeMelodie 
          FROM Nominalizari
          LEFT JOIN Artisti ON Nominalizari.idArtist = Artisti.idArtist
          LEFT JOIN Albume ON Nominalizari.idAlbum = Albume.idAlbum
          LEFT JOIN Melodii ON Nominalizari.idMelodie = Melodii.idMelodie";

$queryByMelody = "SELECT Nominalizari.nume, Nominalizari.categorie, Nominalizari.dataNominalizare, 
          Artisti.nume AS numeArtist, Albume.titlu AS numeAlbum, Melodii.titlu AS numeMelodie
          FROM Nominalizari
          LEFT JOIN Artisti ON Nominalizari.idArtist = Artisti.idArtist
          LEFT JOIN Albume ON Nominalizari.idAlbum = Albume.idAlbum
          LEFT JOIN Melodii ON Nominalizari.idMelodie = Melodii.idMelodie";

$errorMsgArtist = '';
$errorMsgAlbum = '';
$errorMsgMelody = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['showAll'])) {
        $result = mysqli_query($db, $queryAllNominalizations) or die('Error querying database.');
    } elseif (isset($_POST['searchByArtist']) && isset($_POST['artist'])) {
        $queryByArtist .= " WHERE Artisti.nume LIKE '%" . $_POST['artist'] . "%'";
        $result = mysqli_query($db, $queryByArtist) or die('Error querying database.');

        if (mysqli_num_rows($result) == 0) {
            $errorMsgArtist = "Artistul nu se află în baza de date. Încearcă din nou.";
        }
    } elseif (isset($_POST['searchByAlbum']) && isset($_POST['album'])) {
        $queryByAlbum .= " WHERE Albume.titlu LIKE '%" . $_POST['album'] . "%'";
        $result = mysqli_query($db, $queryByAlbum) or die('Error querying database.');

        if (mysqli_num_rows($result) == 0) {
            $errorMsgAlbum = "Albumul nu se află în baza de date. Încearcă din nou.";
        }
    } elseif (isset($_POST['searchByMelody']) && isset($_POST['melodie'])) {
        $queryByMelody .= " WHERE Melodii.titlu LIKE '%" . $_POST['melodie'] . "%'";
        $result = mysqli_query($db, $queryByMelody) or die('Error querying database.');

        if (mysqli_num_rows($result) == 0) {
            $errorMsgMelody = "Melodia nu se află în baza de date. Încearcă din nou.";
        }
    }
}

echo "<html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Dictionarul Ritmurilor - Nominalizari</title>
            <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap'>
            <style>
                body {
                    font-family: 'Nunito', sans-serif;
                    margin: 0;
                    padding: 0;
                    text-align: center;
                    background-color: #000; /* Schimbarea culorii de fundal la negru */
                    color: #fff; /* Schimbarea culorii fontului la alb */
                    position: relative;
                }

                header {
                    background-image: url('header.jpg');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    color: #fff;
                    padding: 20px;
                    position: relative;
                    display: flex;
                    flex-direction: column; /* Schimbare la directia de afisare a elementelor pe coloana */
                    align-items: center; /* Aliniere pe axa orizontala (centrare) */
                }

                h1 {
                    color: #fff;
                    margin: 0;
                    font-size: 24px;
                }

                h2 {
                    color: #fff;
                    margin: 5px 0;
                    font-size: 18px;
                }

                header img {
                    width: 100%;
                    height: auto;
                    display: block;
                }

                button {
                    background-color: rgb(156, 17, 17);
                    color: white;
                    padding: 10px 20px;
                    margin: 10px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                }

                button:hover {
                    background-color: #8b0000;
                }

                input[type='text'] {
                    padding: 8px;
                    margin: 5px;
                    border: 1px solid #fff; /* Schimbarea culorii border-ului la alb */
                    border-radius: 5px;
                    background-color: #333; /* Schimbarea culorii fundalului la negru */
                    color: #fff; /* Schimbarea culorii fontului la alb */
                }

                input[type='submit'] {
                    background-color: rgb(156, 17, 17);
                    color: white;
                    padding: 8px 15px;
                    margin: 5px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 14px;
                }

                input[type='submit']:hover {
                    background-color: #8b0000;
                }

                a {
                    text-decoration: none;
                    color: #fff;
                }

                a:hover {
                    color: #ccc;
                }
            </style>
        </head>

        <body background='images.jpg'>
            <header>
                <div>
                    <h1>Dicționarul Ritmurilor</h1>
                    <h2>Portalul web unde găsești informații despre artiștii și melodiile tale preferate</h2>
                </div>
                <a href='../myPage'><button>Acasa</button></a>
            </header>
            <main>
                <form method='post'>
                    <input type='submit' name='showAll' value='Afiseaza Nominalizari'>
                    <input type='text' name='artist' placeholder='Nume artist'>
                    <input type='submit' name='searchByArtist' value='Cauta dupa artist'>
                    <input type='text' name='album' placeholder='Nume album'>
                    <input type='submit' name='searchByAlbum' value='Cauta dupa album'>
                    <input type='text' name='melodie' placeholder='Nume melodie'>
                    <input type='submit' name='searchByMelody' value='Cauta dupa melodie'>
                </form>";

echo "<p style='color: red;'>$errorMsgArtist</p>";
echo "<p style='color: red;'>$errorMsgAlbum</p>";
echo "<p style='color: red;'>$errorMsgMelody</p>";

if (isset($result) && mysqli_num_rows($result) > 0) {
    echo "<table border='1' style='color: #fff;'> <!-- Schimbarea culorii fontului la alb -->
        <tr>
            <th>Nume</th>
            <th>Categorie</th>
            <th>Data Nominalizare</th>
            <th>Artist</th>
            <th>Album</th>
            <th>Melodie</th>
        </tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['nume'] . "</td>";
        echo "<td>" . $row['categorie'] . "</td>";
        echo "<td>" . $row['dataNominalizare'] . "</td>";
        echo "<td>" . $row['numeArtist'] . "</td>";
        echo "<td>" . $row['numeAlbum'] . "</td>";
        echo "<td>" . $row['numeMelodie'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

mysqli_close($db);

echo "</body>
    </html>";
?>