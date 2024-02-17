<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dicționarul Ritmurilor</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap">

    <style>
    body {
        font-family: 'Nunito', sans-serif;
        margin: 0;
        padding: 0;
        text-align: center;
        background-color: #f1f1f1;
        position: relative;
    }

    .login-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 20px auto;
        position: relative;
    }

    #login-section {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        max-width: 200px;
        text-align: center;
        position: absolute;
        top: 50%; 
        left: 50%; 
        transform: translate(-50%, -50%); 
    }

    #login-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px; 
    }

    #login-form input {
        margin: 10px 0;
        padding: 10px;
        width: 60%;
        font-size: 16px;

    }

    #login-form button {
        background-color: rgb(156, 17, 17);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    header {
        background-image: url('header.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #fff;
        padding: 20px;
        position: relative;
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

    a {
        text-decoration: none;
        color: #333;
    }

    a:hover {
        color: #000;
    }

    #description {
        margin: 20px auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        color: #333;
        max-width: 600px;
        text-align: center;
        margin-bottom: 170px;
    }

    #description h3 {
        font-size: 28px;
        color: #1565c0;
    }

    #description p {
        font-size: 18px;
    }

    #image-left,
    #image-right {
        position: absolute;
        top: 100%; 
        width: 450px;
        height: auto;
    }

    #image-left {
        left: 100px;
    }

    #image-right {
        right: 100px;
    }
    #logout-section {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            max-width: 200px;
            text-align: center;
            position: absolute;
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            margin-top: 300px; 
        }

        #logout-section button {
            background-color: rgb(156, 17, 17);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #logout-section button:hover {
            background-color: #8b0000;
        }
</style>



</head>

<body background="images.jpg">
    <header>
        <h1>Dicționarul Ritmurilor</h1>
        <h2>Portalul web unde descoperi informații despre artiști și melodiile tale preferate</h2>
    </header>

    <main>

        <a href="Artisti.php"><button>Artiști</button></a>
        <a href="Melodii.php"><button>Melodii</button></a>
        <a href="Nominalizari.php"><button>Nominalizări</button></a>
        <a href="Albume.php"><button>Albume</button></a>

        <div id="description">
            <h3>Bun venit pe Dicționarul Ritmurilor!</h3>
            <p>Explorează fascinanta lume a muzicii pe acest portal dedicat pasionaților! Aici găsești informații detaliate despre artiști, melodii și multe altele. Descoperă noi experiențe muzicale și lasă-te purtat de ritmurile preferate.</p>
        </div>

        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo "<div id='logout-section'>
                    <h3>Conectat</h3>
                    <a href='logout.php'><button>Deconectare</button></a>
                </div>";
        } else {
            echo "<div class='login-container'>
                    <div id='login-section'>
                        <h3>Autentificare</h3>
                        <form id='login-form' action='auth.php' method='post'>
                            <input type='text' name='username' placeholder='Nume utilizator' required>
                            <input type='password' name='password' placeholder='Parolă' required>
                            <button type='submit'>Autentificare</button>
                        </form>
                    </div>
                </div>";
        }
        ?>

        <img src="images2.jpg" alt="Imagine Stânga" id="image-left">
        <img src="images3.jpg" alt="Imagine Dreapta" id="image-right">
    </main>
</body>

</html>