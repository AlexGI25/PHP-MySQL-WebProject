<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'muzicadb') or die('Error connecting to MySQL server.');

$showMessage = false;


if (isset($_POST['showAllArtists'])) {
    $query = "SELECT Artisti.nume, Artisti.dataNasterii, Artisti.gen, Artisti.origine, Artisti.contact, CasaDiscuri.nume AS numeCasaDiscuri, Manager.nume AS numeManager
              FROM Artisti
              JOIN CasaDiscuri ON Artisti.idCasaDiscuri = CasaDiscuri.idCasaDiscuri
              JOIN Manager ON Artisti.idManager = Manager.idManager";

    $result = mysqli_query($db, $query) or die('Error querying database.');

    echo "<h2>Lista Artiștilor</h2>"; 
    echo "<table border='1'>
            <tr>
                <th>Nume</th>
                <th>Data Nasterii</th>
                <th>Gen Muzical</th>
                <th>Origine</th>
                <th>Contact</th>
                <th>Casa Discuri</th>
                <th>Manager</th>
            </tr>";

    while ($row = mysqli_fetch_array($result)) { 
        echo "<tr>";
        echo "<td>" . $row['nume'] . "</td>";
        echo "<td>" . $row['dataNasterii'] . "</td>";
        echo "<td>" . $row['gen'] . "</td>";
        echo "<td>" . $row['origine'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . $row['numeCasaDiscuri'] . "</td>";
        echo "<td>" . $row['numeManager'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

}

if (isset($_POST['addArtist'])) {
    $nume = mysqli_real_escape_string($db, $_POST['nume']);
    $dataNasterii = mysqli_real_escape_string($db, $_POST['dataNasterii']);
    $gen = mysqli_real_escape_string($db, $_POST['gen']);
    $origine = mysqli_real_escape_string($db, $_POST['origine']);
    $contact = mysqli_real_escape_string($db, $_POST['contact']);
    $idCasaDiscuri = mysqli_real_escape_string($db, $_POST['idCasaDiscuri']);
    $idManager = mysqli_real_escape_string($db, $_POST['idManager']);

    $queryCheckManager = "SELECT idManager FROM Manager WHERE idManager = '$idManager'";
    $resultCheckManager = mysqli_query($db, $queryCheckManager);

    $queryCheckCasaDiscuri = "SELECT idCasaDiscuri FROM CasaDiscuri WHERE idCasaDiscuri = '$idCasaDiscuri'";
    $resultCheckCasaDiscuri = mysqli_query($db, $queryCheckCasaDiscuri);

    if (!empty($nume) && !empty($dataNasterii) && mysqli_num_rows($resultCheckManager) > 0 && mysqli_num_rows($resultCheckCasaDiscuri) > 0) {
        $queryAddArtist = "INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact, idCasaDiscuri, idManager)
                           VALUES ('$nume', '$dataNasterii', '$gen', '$origine', '$contact', '$idCasaDiscuri', '$idManager')";

        $resultAddArtist = mysqli_query($db, $queryAddArtist);

        if ($resultAddArtist) {
            if (mysqli_affected_rows($db) > 0) {
                $addArtistMessage = "Artistul a fost adăugat cu succes!";
            } else {
                $addArtistMessage = "Eroare la adăugarea artistului. Încercați din nou.";
            }
        } else {
            $addArtistMessage = "Eroare la efectuarea interogării. Încercați din nou.";
        }
    } else {
        $addArtistMessage = "ID Manager sau ID Casa Discuri invalid. Încercați din nou.";
    }

    $showMessage = true;
    $confirmationMessage = $addArtistMessage;
}

if (isset($_POST['deleteArtist'])) {
    $idArtistToDelete = mysqli_real_escape_string($db, $_POST['idArtistToDelete']);
    $queryDeleteArtist = "DELETE FROM Artisti WHERE idArtist = '$idArtistToDelete'";
    $resultDeleteArtist = mysqli_query($db, $queryDeleteArtist);

    if ($resultDeleteArtist) {
        if (mysqli_affected_rows($db) > 0) {
            $deleteArtistMessage = "Artistul a fost șters cu succes!";
        } else {
            $deleteArtistMessage = "ID Artist invalid sau artistul nu există.";
        }
    } else {
        $deleteArtistMessage = "Eroare la efectuarea interogării de ștergere. Încercați din nou.";
    }
    $showMessage = true;
    $confirmationMessage = $deleteArtistMessage;
}

if (isset($_POST['searchArtist'])) {
    $artistName = mysqli_real_escape_string($db, $_POST['artistName']);

    $query = "SELECT Artisti.idArtist, Artisti.nume, Artisti.dataNasterii, Artisti.gen, Artisti.origine, Artisti.contact, CasaDiscuri.nume AS numeCasaDiscuri, Manager.nume AS numeManager
              FROM Artisti
              JOIN CasaDiscuri ON Artisti.idCasaDiscuri = CasaDiscuri.idCasaDiscuri
              JOIN Manager ON Artisti.idManager = Manager.idManager
              WHERE Artisti.nume = '$artistName'";

    $result = mysqli_query($db, $query) or die('Error querying database.');

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Artistul Cautat</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Data Nasterii</th>
                    <th>Gen Muzical</th>
                    <th>Origine</th>
                    <th>Contact</th>
                    <th>Casa Discuri</th>
                    <th>Manager</th>
                </tr>";

        $row = mysqli_fetch_array($result);
        echo "<tr>";
        echo "<td>" . $row['idArtist'] . "</td>";
        echo "<td>" . $row['nume'] . "</td>";
        echo "<td>" . $row['dataNasterii'] . "</td>";
        echo "<td>" . $row['gen'] . "</td>";
        echo "<td>" . $row['origine'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . $row['numeCasaDiscuri'] . "</td>";
        echo "<td>" . $row['numeManager'] . "</td>";
        echo "</tr>";

        echo "</table>";
    } else {
        echo "<p>Artistul nu a fost găsit.</p>";
    }
    mysqli_close($db);
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

        form {
            margin-top: 10px;
        }

        form button {
            margin-top: 10px;
        }

        .result-table {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            margin-top: 150px;
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #nume,
        #dataNasterii,
        #gen,
        #origine,
        #contact,
        #idCasaDiscuri,
        #idManager,
        #idArtistToDelete {
            width: 7.5%;
        }

        .add-artist-form {
            display: none;
            margin-top: 20px;
            text-align: center;
        }

        .add-artist-form label,
        .add-artist-form input,
        .add-artist-form button {
            margin-top: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .add-artist-form form,


        .form-column {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .form-group {
            flex-basis: 48%;
            margin-bottom: 10px;
        }

        .form-group-full {
            flex-basis: 100%; 
            margin-bottom: 10px;
        }

        .form-group-full button {
            width: 15%; 
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .add-artist-form h2 {
            font-weight: bold;
            color: #F38F79;
        }

        #toggleAddArtistForm {
            background-color: rgb(156, 17, 17);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px auto;
            display: block;
        }

        #toggleAddArtistForm:hover {
            background-color: #8b0000;
        }

        .delete-artist-form {
            display: none;
            margin-top: 20px;
            text-align: center;
        }

        #toggleDeleteArtistForm {
            background-color: rgb(156, 17, 17);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px auto;
            display: block;
        }
        .form-column {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        #toggleDeleteArtistForm:hover {
            background-color: #8b0000;
        }
        #nume,
        #dataNasterii,
        #gen,
        #origine,
        #contact,
        #idCasaDiscuri,
        #idManager {
            width: 75%; 
        }

        #idArtistToDelete{
            width: 25%;
        }

        .confirmation-message {
            margin-top: 300px;
            text-align: center;
            color: #F38F79; 
            position: relative;
            font-weight: bold;
            z-index: 2;
        }
        .message-container {
            position:c fixed;
            top: 20px; 
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 5px;
            color: #F38F79;
            font-weight: bold;
        }



    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    var addArtistForm = document.querySelector(".add-artist-form");
    var toggleAddArtistFormButton = document.getElementById("toggleAddArtistForm");
    var deleteArtistForm = document.querySelector(".delete-artist-form");
    var toggleDeleteArtistFormButton = document.getElementById("toggleDeleteArtistForm");
    var confirmationMessage = document.querySelector(".confirmation-message");

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
        if (addArtistForm && toggleAddArtistFormButton) {
            toggleAddArtistFormButton.addEventListener("click", function () {
                addArtistForm.style.display = (addArtistForm.style.display === "none") ? "block" : "none";
                deleteArtistForm.style.display = "none";
                confirmationMessage.style.display = "none";
            });
        }

        if (deleteArtistForm && toggleDeleteArtistFormButton) {
            toggleDeleteArtistFormButton.addEventListener("click", function () {
                deleteArtistForm.style.display = (deleteArtistForm.style.display === "none") ? "block" : "none";
                addArtistForm.style.display = "none";
                confirmationMessage.style.display = "none";
            });
        }
    <?php } else { ?>
        if (toggleAddArtistFormButton) {
            toggleAddArtistFormButton.style.display = "none";
        }

        if (toggleDeleteArtistFormButton) {
            toggleDeleteArtistFormButton.style.display = "none";
        }
    <?php } ?>
});

if (deleteArtistForm && toggleDeleteArtistFormButton) {
    toggleDeleteArtistFormButton.addEventListener("click", function () {
        if (deleteArtistForm.style.display === "none") {
            deleteArtistForm.style.display = "block";
            addArtistForm.style.display = "none";
        } else {
            deleteArtistForm.style.display = "none";
        }
    });
} else {
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
        if (toggleAddArtistFormButton) {
            toggleAddArtistFormButton.style.display = "none";
        }

        if (toggleDeleteArtistFormButton) {
            toggleDeleteArtistFormButton.style.display = "none";
        }
    <?php } ?>
}

    </script>
</head>

<body>
    <header>
        <div>
            <h1>Dicționarul Ritmurilor</h1>
            <h2>Portalul web unde găsești informații despre artiștii și melodiile tale preferate</h2>
        </div>
        <div class="header-buttons">
            <?php
            echo '<a href="../myPage"><button>Acasa</button></a>';
            
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                echo '<p>Utilizator autentificat</p>';
                echo '<button type="button" id="toggleAddArtistForm">Adaugă Artist</button>';
                echo '<button type="button" id="toggleDeleteArtistForm">Șterge Artist</button>';
            } else {
                echo '<p>Utilizator neautentificat</p>';
            }
            ?>
        </div>
    </header>

    <div class="main-content">
        <form method="post" action="">
            <button type="submit" name="showAllArtists">Afișare Artiști</button>
        </form>

        <form method="post" action="">
            <label for="artistName">Caută Artist:</label>
            <input type="text" id="artistName" name="artistName" required>
            <button type="submit" name="searchArtist">Caută</button>
        </form>
    </div>



    <div class="add-artist-form">
        <h2>Adaugă Artist</h2>
        <form method="post" action="">
            <div class="form-column">
                <div class="form-group">
                    <label for="nume">Nume:</label>
                    <input type="text" id="nume" name="nume" required>
                </div>

                <div class="form-group">
                    <label for="dataNasterii">Data Nasterii:</label>
                    <input type="date" id="dataNasterii" name="dataNasterii" required>
                </div>

                <div class="form-group">
                    <label for="gen">Gen Muzical:</label>
                    <input type="text" id="gen" name="gen">
                </div>

                <div class="form-group">
                    <label for="origine">Origine:</label>
                    <input type="text" id="origine" name="origine">
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact">
                </div>

                <div class="form-group">
                    <label for="idCasaDiscuri">ID Casa Discuri:</label>
                    <input type="number" id="idCasaDiscuri" name="idCasaDiscuri" required>
                </div>

                <div class="form-group">
                    <label for="idManager">ID Manager:</label>
                    <input type="number" id="idManager" name="idManager" required>
                </div>

                <div class="form-group-full">
                    <button type="submit" name="addArtist">Adaugă Artist</button>
                </div>
            </div>
        </form>
    </div>

    <div class="delete-artist-form">
        <h2>Șterge Artist</h2>
        <form method="post" action="">
            <div class="form-group-full">
                <label for="idArtistToDelete">ID Artist:</label>
                <input type="number" id="idArtistToDelete" name="idArtistToDelete" required>
            </div>

            <div class="form-group-full">
                <button type="submit" name="deleteArtist">Șterge Artist</button>
            </div>
        </form>
    </div>
    <div class="confirmation-message">
        <?php if ($showMessage): ?>
            <p><?php echo $confirmationMessage; ?></p>
        <?php endif; ?>
    </div>


</body>

</html>
