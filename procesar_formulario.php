<?php
// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'formVariasImagenes');

// Insertar datos en la tabla "Usuarios"
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
$genero = $_POST['genero'];
$pais = $_POST['pais'];
$insertar_usuario = "INSERT INTO Usuarios (nombre, email, password, genero, pais) VALUES ('$nombre', '$email', '$password', '$genero', '$pais')";
mysqli_query($conexion, $insertar_usuario);

// Obtener el ID del usuario insertado
$id_usuario = mysqli_insert_id($conexion);

$folder_name = "./imageness/{$id_usuario}";
if(!file_exists($folder_name)) {
  mkdir($folder_name);
}



// Definir la ruta del directorio donde se almacenarán las imágenes
$ruta_almacenamiento = $folder_name;

// Insertar datos en la tabla "Imagenes"
foreach ($_FILES as $imagen) {
  $nombre_archivo = $imagen['name'];
  $ruta_archivo_temporal = $imagen['tmp_name'];
  $ruta_archivo_final = $ruta_almacenamiento . $nombre_archivo;
  if (move_uploaded_file($ruta_archivo_temporal, $ruta_archivo_final)) {
    $insertar_imagen = "INSERT INTO Imagenes (id_usuario, nombre_archivo) VALUES ('$id_usuario', '$nombre_archivo')";
    mysqli_query($conexion, $insertar_imagen);
  } else {
    echo "Error al subir la imagen.";
  }
}


// Cerrar la conexión
mysqli_close($conexion);
?>
