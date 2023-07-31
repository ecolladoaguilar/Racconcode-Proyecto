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
        color: #000;
    }

    .nombre-archivo {
        font-weight: bold;
    }

    .decodificar-link {
        color: #337ab7;
        text-decoration: none;
        margin-top: 10px;
        display: block;
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
//Iniciar la sesión
session_start();
$usuario = $_SESSION['usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //inicializar $numeros_previamente_generados como un array vacío, meterlo en una variable de sesión
    if (!isset($_SESSION['numeros_previamente_generados'])) {
        // Si no existe, inicializarla como un array vacío
        $_SESSION['numeros_previamente_generados'] = array();
    }
    //Se recupera la variable de sesión en una local
    $numeros_previamente_generados = $_SESSION['numeros_previamente_generados'];

    //inicializar $numero_aleatorio.
    $numero_aleatorio = 0;

    //generar id's no repetidas
    $numero_aleatorio = rand(1, 2000);
    while (in_array($numero_aleatorio, $numeros_previamente_generados)) {
        $numero_aleatorio = rand(1, 2000);
    }
    $numeros_previamente_generados[] = $numero_aleatorio;

    // Actualizar la variable de sesión con los nuevos valores
    $_SESSION['numeros_previamente_generados'] = $numeros_previamente_generados;

    //$texto = $_POST["texto"];
    $metodo = $_POST["metodo"];

    switch ($metodo) {
        case "AES": //para codificar en AES necesitas una clave secreta y un vector. 
            //codificar en AES texto
            if (isset($_POST["texto"]) && !empty($_POST["texto"])) {
                $texto = $_POST["texto"];
                $clave_secreta = openssl_random_pseudo_bytes(16);
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-128-CBC'));
                $texto_codificado = openssl_encrypt($texto, "AES-128-CBC", $clave_secreta, 0, $iv);
                //echo "Texto original: " . $texto . "<br>";
                //echo "Texto codificado: (" . $metodo . "): " . $texto_codificado . "<br>";
                $variable = 0;
            }

            //codificar en AES archivos
            if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
                $archivo = $_FILES["archivo"]["tmp_name"];
                $clave_secreta = openssl_random_pseudo_bytes(16);
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-128-CBC'));
                $archivo_codificado = openssl_encrypt(file_get_contents($archivo), "AES-128-CBC", $clave_secreta, 0, $iv);
                //echo "Archivo codificado: (" . $metodo . "): " . $archivo_codificado . "<br>";

                //guardar la extensión de los archivos para luego poder descodificarlos con la misma extensión.
                $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);

                switch ($extension) {
                    case "jpg":
                        $variable = 1;
                        break;
                    case "png":
                        $variable = 2;
                        break;
                    case "pdf":
                        $variable = 3;
                        break;
                }
            }
            break;

        case "Blowfish": //para codificar necesitas una semilla, que será $2a$07$ ... + ...
            //codificar en Blowfish texto
            if (isset($_POST["texto"]) && !empty($_POST["texto"])) {
                $texto = $_POST["texto"];
                //convierte carácteres binarios en hexadecimal
                $sal = '$2a$07$' . bin2hex(openssl_random_pseudo_bytes(16));
                //el crypt se utiliza para encriptar y verificar contraseñas utilizando varios algoritmos de cifrado.
                $texto_codificado = crypt($texto, $sal);
                //echo "Texto original: " . $texto . "<br>";
                //echo "Texto codificado: (" . $metodo . "): " . $texto_codificado . "<br>";
                $variable = 0;
            }

            //codificar en Blowfish archivos
            if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
                $archivo = $_FILES["archivo"]["tmp_name"];
                $sal = '$2a$07$' . bin2hex(openssl_random_pseudo_bytes(16));
                $archivo_codificado = crypt(file_get_contents($archivo), $sal);
                //echo "Archivo codificado: (" . $metodo . "): " . $archivo_codificado . "<br>";

                //guardar la extensión de los archivos para luego poder descodificarlos con la misma extensión.
                $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);

                switch ($extension) {
                    case "jpg":
                        $variable = 1;
                        break;
                    case "png":
                        $variable = 2;
                        break;
                    case "pdf":
                        $variable = 3;
                        break;
                }
            }
            break;


        case "hash":
            //codificar en Hash texto
            if (isset($_POST["texto"]) && !empty($_POST["texto"])) {
                $texto = $_POST["texto"];
                $texto_codificado = hash("sha256", $texto);
                //echo "Texto original: " . $texto . "<br>";
                //echo "Archivo codificado: (" . $metodo . "): " . $texto_codificado . "<br>";
                $variable = 0;
            }

            //codificar en Hash archivo
            if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
                $archivo = $_FILES["archivo"]["tmp_name"];
                //lee el contenido del archivo file_get_contents y lo devuelve como una cadena de texto
                $archivo_codificado = hash("sha256", file_get_contents($archivo));
                //echo "Archivo codificado: (" . $metodo . "): " . $archivo_codificado . "<br>";

                //guardar la extensión de los archivos para luego poder descodificarlos con la misma extensión.
                $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);

                switch ($extension) {
                    case "jpg":
                        $variable = 1;
                        break;
                    case "png":
                        $variable = 2;
                        break;
                    case "pdf":
                        $variable = 3;
                        break;
                }
            }
            break;

        case "Base64":
            //codificar en Base64 texto
            if (isset($_POST["texto"]) && !empty($_POST["texto"])) {
                $texto = $_POST["texto"];
                $texto_codificado = base64_encode($texto);
                //echo "Texto original: " . $texto . "<br>";
                //echo "Texto codificado: (" . $metodo . "): " . $texto_codificado . "<br>";
                $variable = 0;
            }

            //codificar en Base64 archivos
            if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
                $archivo = $_FILES["archivo"]["tmp_name"];
                $archivo_codificado = base64_encode(file_get_contents($archivo));
                //echo "Archivo codificado: (" . $metodo . "): " . $archivo_codificado . "<br>";

                //guardar la extensión de los archivos para luego poder descodificarlos con la misma extensión.
                $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);

                switch ($extension) {
                    case "jpg":
                        $variable = 1;
                        break;
                    case "png":
                        $variable = 2;
                        break;
                    case "pdf":
                        $variable = 3;
                        break;
                }
            }
            break;
    }


    //si no existe la cookie
    if (!isset($_POST["aviso"]) || empty($_POST["aviso"])) {
        //Si es archivo hash o 64encode
        if (isset($archivo_codificado)) {
            $data = array(
                'usuario' => $usuario,
                'variable' => $variable,
                'id' => $numero_aleatorio,
                'tipo' => $metodo,
                'codificacion' => $archivo_codificado,
            );
        }
        //Si es texto hash o 64encode
        if (isset($texto_codificado)) {
            $data = array(
                'usuario' => $usuario,
                'variable' => $variable,
                'id' => $numero_aleatorio,
                'tipo' => $metodo,
                'codificacion' => $texto_codificado
            );
        }

        //Si es archivo AES
        if (isset($archivo_codificado) && isset($clave_secreta) && isset($iv)) {
            $data = array(
                'usuario' => $usuario,
                'variable' => $variable,
                'id' => $numero_aleatorio,
                'tipo' => $metodo,
                'clave' => bin2hex($clave_secreta),
                'vector' => bin2hex($iv),
                'codificacion' => $archivo_codificado
            );
        }

        //Si es texto AES
        if (isset($texto_codificado) && isset($clave_secreta) && isset($iv)) {
            $data = array(
                'usuario' => $usuario,
                'variable' => $variable,
                'id' => $numero_aleatorio,
                'tipo' => $metodo,
                'clave' => bin2hex($clave_secreta),
                'vector' => bin2hex($iv),
                'codificacion' => $texto_codificado
            );
        }


        //Si es archivo Blowfish
        if (isset($archivo_codificado) && isset($sal)) {
            $data = array(
                'usuario' => $usuario,
                'variable' => $variable,
                'id' => $numero_aleatorio,
                'tipo' => $metodo,
                'sal' => $sal,
                'codificacion' => $archivo_codificado
            );
        }

        //Si es texto Blowfish
        if (isset($texto_codificado) && isset($sal)) {
            $data = array(
                'usuario' => $usuario,
                'variable' => $variable,
                'id' => $numero_aleatorio,
                'tipo' => $metodo,
                'sal' => $sal,
                'codificacion' => $texto_codificado
            );
        }


        //Json encode
        $json = json_encode($data);

        //nombre
        $filename = 'archivo_' . $numero_aleatorio . '.json';

        //ruta
        $dir_path = '../jsons/';

        //combinar nombre y ruta
        $file_path = $dir_path . $filename;

        //guardar en archivo
        file_put_contents($file_path, $json);

        echo "<div class='resultado'>";
        echo "Archivo guardado como <span class='nombre-archivo'>$filename</span><br>";
        echo "<a class='volver-btn' href='../pagina_principal/racconcode.php'>Volver</a>";
        echo "</div>";

    }


    // Si existe el aviso y es texto codificado
    if (isset($_POST["aviso"]) && !empty($_POST["aviso"]) && isset($texto_codificado)) {
        $clave = bin2hex($clave_secreta);
        $vector = bin2hex($iv);
        $base = 'proyecto';
        $tabla = 'historial';

        $bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');

        $preparada = $bd->prepare("INSERT INTO $tabla (id, usuario, fecha, variable, tipo, codificacion, clave, vector, semilla) 
        VALUES (?, ?, NOW(), ?, ?, ?, ?, ?, ?)");
        $preparada->execute(array($numero_aleatorio, $usuario, $variable, $metodo, $texto_codificado, $clave, $vector, $sal));

        //aviso de subido
        echo "<div class='resultado'>";
        echo "Subido a la base de datos, por favor, consultala<br>";
        echo "<a class='volver-btn' href='../pagina_principal/racconcode.php'>Volver</a>";
        echo "</div>";
    }

    // Si existe el aviso y es archivo codificado
    if (isset($_POST["aviso"]) && !empty($_POST["aviso"]) && isset($archivo_codificado)) {
        $clave = bin2hex($clave_secreta);
        $vector = bin2hex($iv);
        $base = 'proyecto';
        $tabla = 'historial';

        $bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');

        $preparada = $bd->prepare("INSERT INTO $tabla (id, usuario, fecha, variable, tipo, codificacion, clave, vector, semilla) 
        VALUES (?, ?, NOW(), ?, ?, ?, ?, ?, ?)");
        $preparada->execute(array($numero_aleatorio, $usuario, $variable, $metodo, $archivo_codificado, $clave, $vector, $sal));

        //aviso de subido
        echo "<div class='resultado'>";
        echo "Subido a la base de datos, por favor, consultala<br>";
        echo "<a class='volver-btn' href='../pagina_principal/racconcode.php'>Volver</a>";
        echo "</div>";
    }


}
?>