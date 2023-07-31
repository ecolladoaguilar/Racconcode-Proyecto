<?php
//Iniciar la sesión

//ruta del directorio que contiene los JSON
$directorio = "../jsons";

//array para almacenar los nombres de los archivos
$archivos_array = array();

if ($gestor = opendir($directorio)) {
    while (false !== ($archivo = readdir($gestor))) {

        //verifica que sea un JSON
        if (pathinfo($archivo, PATHINFO_EXTENSION) == "json") {
            //leer contenido del archivo
            $contenido = file_get_contents($directorio . "/" . $archivo);
            $datos = json_decode($contenido, true);

            //Verifica que está el nombre en el objeto
            if (isset($datos["usuario"]) && $datos["usuario"] == $usuario) {
                $archivos_array[] = $archivo;
            }
        }
    }

    //cerrar el directorio
    closedir($gestor);
}

if (count($archivos_array) > 0) {
    echo "Seleccione un archivo: <br>";
    echo "<form method='post' action=''>";
    echo "<select name='archivo'>";

    //option value por cada JSON
    foreach ($archivos_array as $archivo) {
        echo "<option value='" . $archivo . "'>" . $archivo . "</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Elegir'>";
    echo "</form>";

    if (isset($_POST["archivo"])) {
        $archivo_seleccionado = $_POST["archivo"];
        $ruta_archivo = "../jsons/" . $archivo_seleccionado;

        $contenido_archivo = file_get_contents($ruta_archivo);
        $datos = json_decode($contenido_archivo, true);

        if (isset($datos["codificacion"])) {
            //codificación
            $codificacion = $datos["codificacion"];
            //tipo
            $tipo = $datos["tipo"];
            //variable, para saber si es PNG, JPG o PDF
            $variable = $datos["variable"];
            //guardar el num
            $num = $datos["id"];

           // echo "La codificación es: $codificacion <br>";
            echo "<a href='../decode/decode2.php'>Decodificar</a>";
            //variables de sesión de codificación y tipo
            $_SESSION['codificacion'] = $codificacion;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['variable'] = $variable;
            $_SESSION['num'] = $num;

            //si es AES
            if ($tipo == "AES") {
                //crear la variable de sesión con la clave
                $clave = $datos["clave"];
                $_SESSION['clave'] = $clave;
                //crear la variable de sesión con el vector
                $vector = $datos["vector"];
                $_SESSION['vector'] = $vector;
            }

            //si es Blowfish
            if ($tipo == "Blowfish"){
                //crear la variable de sesión con la semilla
                $sal = $datos["sal"];
                $_SESSION['sal'] = $sal;
            }
        } else {
            echo "No se encontró la clave 'codificacion' en el archivo seleccionado.";
        }
    } else {
        echo "No se ha seleccionado ningún archivo.";
    }

}
?>