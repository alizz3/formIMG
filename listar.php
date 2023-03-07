<?php
// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'formVariasImagenes');

// // Obtener los datos de los usuarios y sus imágenes
// $consulta = "SELECT Usuarios.nombre, Usuarios.email, Usuarios.genero, Usuarios.pais, Imagenes.nombre_archivo 
//              FROM Usuarios 
//              INNER JOIN Imagenes ON Usuarios.id = Imagenes.id_usuario";
// $resultado = mysqli_query($conexion, $consulta);

// // Crear la tabla
// echo "<table>";
// echo "<tr><th>Nombre</th><th>Email</th><th>Género</th><th>País</th><th>Imágenes</th></tr>";
// while ($fila = mysqli_fetch_array($resultado)) {
//   echo "<tr>";
//   echo "<td>" . $fila['nombre'] . "</td>";
//   echo "<td>" . $fila['email'] . "</td>";
//   echo "<td>" . $fila['genero'] . "</td>";
//   echo "<td>" . $fila['pais'] . "</td>";
//   echo "<td>";
//   if (!empty($fila['nombre_archivo'])) {
//     echo "<img src='imageness/" . $fila['nombre_archivo'] . "' width='100'>";
//   } else {
//     echo "Sin imagen";
//   }
//   echo "</td>";
//   echo "</tr>";
// }
// echo "</table>";

// Realizar una consulta SQL para obtener los datos de la tabla "Usuarios" y unir con la tabla "Imagenes" usando el id_usuario
$consulta = "SELECT Usuarios.*, (SELECT GROUP_CONCAT(nombre_archivo SEPARATOR ', ') FROM Imagenes WHERE id_usuario = Usuarios.id) as imagenes FROM Usuarios";
$resultado = mysqli_query($conexion, $consulta);

// Crear una tabla HTML para mostrar los datos obtenidos en la consulta
echo "<table>";
echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Género</th><th>País</th><th>Imágenes</th></tr>";
while ($fila = mysqli_fetch_array($resultado)) {
  echo "<tr>";
  echo "<td>" . $fila['id'] . "</td>";
  echo "<td>" . $fila['nombre'] . "</td>";
  echo "<td>" . $fila['email'] . "</td>";
  echo "<td>" . $fila['genero'] . "</td>";
  echo "<td>" . $fila['pais'] . "</td>";
  echo "<td>" . $fila['imagenes'] . "</td>";
  echo "</tr>";
}
echo "</table>";


// Cerrar la conexión
mysqli_close($conexion);
