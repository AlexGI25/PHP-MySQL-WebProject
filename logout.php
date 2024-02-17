<?php
session_start();

session_destroy();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deconectare</title>
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

        p {
            margin-bottom: 20px;
        }

        button {
            background-color: rgb(156, 17, 17);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #8b0000;
        }
    </style>
</head>

<body>
    <p>Utilizatorul a fost deconectat.</p>
    <a href="../myPage"><button>Acasă</button></a>
</body>

</html>
