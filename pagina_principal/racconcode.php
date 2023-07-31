<?php
session_start();
// Verificar si la variable de sesión está definida
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

    </style>

</head>

<body>
    <?php
    include '../include/include-cabecera.php';
    ?>

    <!-- Encabezado -->
    <div class="encabezado">
        <h1>Codificación</h1>
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
                <img src="../fotos/blowfish.PNG" alt="foto">
                <h3>BlowFish</h3>
            </div>
            <div class="face back">
                <h3>BlowFish</h3>
                <p>
                    Se calcula con una semilla generada aleatoriamente para ti. Este no tiene opción de decodificación.
                </p>
            </div>
        </div>

        <div class="card">
            <div class="face front">
                <img src="../fotos/hash.PNG" alt="foto">
                <h3>Hash</h3>
            </div>
            <div class="face back">
                <h3>Hash</h3>
                <p>
                    Este es de un sentido único. Se utiliza para la verificación de contraseñas, firma digitales y
                    otras.
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
                    transporte.</p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <form method="POST" enctype="multipart/form-data" action="../codificacion/codificacion.php">

        <div class="container">
            <!-- Tipo de codificación -->
            <label for="metodo">Método de codificación:</label>
            <select id="metodo" name="metodo">
                <option value="AES">AES</option>
                <option value="Blowfish">Blowfish</option>
                <option value="hash">Hash</option>
                <option value="Base64">Base64</option>
            </select><br><br>
        </div>

        <!-- Métodos -->
        <div class="options-container">
            <div class="left-option">
                <!-- Codificar texto -->
                <h2>Introducir texto</h2>
                <textarea id="texto" name="texto" placeholder="Escribe aquí tu texto largo"></textarea>
            </div>
            <div class="right-option">
                <!-- Codificar archivos -->
                <h2>Meter archivos</h2>
                Recuerda que se guarda en la carpeta jsons.<br>
                <input type="file" name="archivo" id="archivo"> <br>
                <button id="quitar-archivo" onclick="vaciar()">Quitar archivo</button>
            </div>
        </div>


        <!-- Botones -->
        <div class="container">
            <input type="submit" class="button" id="aviso" name="aviso" value="Subir a la nube" onclick="validar()">
            <input type="submit" class="button" value="Generar json" onclick="validar()">
        </div>

        <!-- Cerrar formulario -->
    </form>

    <!-- Mensaje -->
    <div id="resultado"></div>

    <?php
    include '../include/include-pie.php';
    ?>

    <script>
        //validación de que solamente se pueda rellenar un campo
        function validar() {
            const texto = document.getElementById("texto");
            const archivo = document.getElementById("archivo");

            if (texto.value.trim() !== "" && archivo.value.trim() !== "") {
                alert("Por favor, solo completa uno de los campos.");
                event.preventDefault();
            } else if (texto.value.trim() === "" && archivo.value.trim() === "") {
                alert("Por favor, completa al menos uno de los campos.");
                event.preventDefault();
            }
        }


        function vaciar() {
            const inputArchivo = document.getElementById("archivo");
            inputArchivo.value = ""; // Establece el valor del input de archivo a una cadena vacía
            event.preventDefault();
        }


    </script>
</body>

</html>