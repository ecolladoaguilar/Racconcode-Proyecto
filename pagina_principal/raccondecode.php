<?php
//Iniciar sesion
session_start();
$usuario = $_SESSION['usuario'];
if (!isset($_SESSION['usuario'])) {
    // Redirigir a otra página
    header("Location: ../index.html");
    exit(); // Asegurarse de que el script se detenga después de la redirección
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../fotos/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../fotos/favicon.ico">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>

    <title>RacconCode</title>
    <link rel="stylesheet" href="../estilos/racconcode.css">
    <!-- Tipo de letra -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
            font-size: 18px;
        }

        #logo {
            width: 100px;
        }

        select {
            width: 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .caja-blanca {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 20px;
            margin: 20px;
            text-align: center;
        }

        .historial {
            background-size: cover;
            background-position: center;
            height: 150px;
            text-align: center;
            color: #fff;
        }

        #codigos{
            color: #fff;
        }

    </style>
    <script>
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("codigos").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "historial.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
    </script>

</head>

<body>
    <?php
    include '../include/include-cabecera.php';
    ?>

    <!-- Encabezado -->
    <div class="encabezado">
        <h1>Decodificación</h1>
    </div>

    <!-- Tarjetas -->
    <div class="tarjetas">
        <div class="card">
            <div class="face front">
                <img src="../fotos/aes.PNG" alt="foto">
                <h3>AES</h3>
            </div>
            <div class="face back">
                <h3>AES</h3>
                <p>
                    Se calcula con un vector y una clave generada aleatoriamente para tu mejor seguridad.
                </p>
            </div>
        </div>

        <div class="card">
            <div class="face front">
                <img src="../fotos/base64.PNG" alt="foto">
                <h3>Base64</h3>
            </div>
            <div class="face back">
                <h3>Base64</h3>
                <p>
                    Permite representar datos binarios en formato de texto ASCII. Lo transforma en una forma segura de
                    transporte.
                </p>
            </div>
        </div>
    </div>

    <div class="caja-blanca">
        <?php
        include '../decode/decode.php';
        ?>
    </div>

    <div class="historial">
        <h1>Historial</h1>
        <p id="codigos" class="acordeon"></p>
    </div>

    <div class="caja-pie">
        <?php
        include '../include/include-pie.php';
        ?>
    </div>
</body>

</html>