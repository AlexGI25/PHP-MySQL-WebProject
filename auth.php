<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'muzicadb') or die('Error connecting to MySQL server.');

$messageSuccess = "Conectarea a fost realizată cu succes.";
$messageFail = "Autentificarea a eșuat. Nume de utilizator sau parolă incorecte.";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $query = "SELECT * FROM utilizatori WHERE nume_utilizator='$username' AND parola='$password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['logged_in'] = true;

        header("Location: auth.php");
        exit();
    }
}

mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare</title>
    <style>
        body {
            background: url('images.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
        }

        button {
            background-color: rgb(156, 17, 17);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #8b0000;
        }
    </style>
</head>

<body>
    <h1>Rezultat Autentificare</h1>
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        echo "<p>$messageSuccess</p>";
    } else {
        echo "<p>$messageFail</p>";
    }
    ?>
    <a href="../myPage"><button>Acasă</button></a>
</body>

</html>
