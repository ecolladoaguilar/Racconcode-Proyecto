<style>
    body {
        background-image: url("../fotos/fondo2.jpg");
    }

    .resultado {
        background-color: #f2f2f2;
        border: 2px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        width: 400px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .volver-btn {
        margin-top: 10px;
        background-color: #71128B;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
    }
</style>
<?php
//Abrimos la sesión
session_start();

//recuperar variables: tipo, codificacion, variable e id.
$tipo = $_SESSION['tipo'];
$codificacion = $_SESSION['codificacion'];
$variable = $_SESSION['variable'];
$num = $_SESSION['num'];

switch ($tipo) {
    case "AES":
        //Recuperar las variables
        $clave = $_SESSION['clave'];
        $vector = $_SESSION['vector'];

        //pasar de hexadecimal a binario
        $clave_secreta = hex2bin($clave);
        $iv = hex2bin($vector);

        //decodificación
        $archivo_decodificado = openssl_decrypt($codificacion, 'AES-128-CBC', $clave_secreta, 0, $iv);

        switch ($variable) {
            case 1:
                $ruta_destino = "../descargas/$num.jpg";
                file_put_contents($ruta_destino, $archivo_decodificado);
                echo "<div class='resultado'>";
                echo "Archivo decodificado guardado en: " . $ruta_destino . "<br>";
                echo "<a class='volver-btn' href='../pagina_principal/raccondecode.php'>Volver</a>";
                echo "</div>";
                break;
            case 2:
                $ruta_destino = "../descargas/$num.png";
                file_put_contents($ruta_destino, $archivo_decodificado);
                echo "<div class='resultado'>";
                echo "Archivo decodificado guardado en: " . $ruta_destino . "<br>";
                echo "<a class='volver-btn' href='../pagina_principal/raccondecode.php'>Volver</a>";
                echo "</div>";
                break;
            case 3:
                $ruta_destino = "../descargas/$num.pdf";
                file_put_contents($ruta_destino, $archivo_decodificado);
                echo "<div class='resultado'>";
                echo "Archivo decodificado guardado en: " . $ruta_destino . "<br>";
                echo "<a class='volver-btn' href='../pagina_principal/raccondecode.php'>Volver</a>";
                echo "</div>";
                break;
            case 0:
                echo "Decodificacion: $archivo_decodificado";
                break;
        }
        break;

    case "Blowfish":
        //Recuperar las variables
        $sal = $_SESSION['sal'];

        echo "<div class='resultado'>";
        echo "La función crypt() con el algoritmo Blowfish se utiliza únicamente para cifrar datos de forma irreversible.";
        echo "<a class='volver-btn' href='../pagina_principal/raccondecode.php'>Volver</a>";
        echo "</div>";

        break;

    case "Hash":
        //solamente tiene un único sentido
        echo "<div class='resultado'>";
        echo "Recuerda que para Hash solamente es un sentido único, no se puede desencriptar, solamente comparar archivos hasheados";
        echo "<a class='volver-btn' href='../pagina_principal/raccondecode.php'>Volver</a>";
        echo "</div>";
        break;

    case "Base64":
        //no se necesita recuperar variables
        $archivo_decodificado = base64_decode($codificacion);
        switch ($variable) {
            case 1:
                $ruta_destino = "../descargas/$num.jpg";
                file_put_contents($ruta_destino, $archivo_decodificado);
                echo "<div class='resultado'>";
                echo "Archivo decodificado guardado en: " . $ruta_destino . "<br>";
                echo "<a class='volver-btn' href='../pagina_principal/raccondecode.php'>Volver</a>";
                echo "</div>";
                break;
            case 2:
                $ruta_destino = "../descargas/$num.png";
                file_put_contents($ruta_destino, $archivo_decodificado);
                echo "<div class='resultado'>";
                echo "Archivo decodificado guardado en: " . $ruta_destino . "<br>";
                echo "<a class='volver-btn' href='../pagina_principal/raccondecode.php'>Volver</a>";
                echo "</div>";
                break;
            case 3:
                $ruta_destino = "../descargas/$num.pdf";
                file_put_contents($ruta_destino, $archivo_decodificado);
                echo "<div class='resultado'>";
                echo "Archivo decodificado guardado en: " . $ruta_destino . "<br>";
                echo "<a class='volver-btn' href='../pagina_principal/raccondecode.php'>Volver</a>";
                echo "</div>";
                break;
            case 0:
                echo "Decodificacion: $archivo_decodificado";
                break;
        }
        break;
}

?>