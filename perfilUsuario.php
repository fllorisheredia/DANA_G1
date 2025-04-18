<?php
include 'includes/header.php';
//include 'includes/db.php';
?>


<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Usuario</title>
</head>
<body>

<!-- Tabla principal -->
<table border="0" cellspacing="20">
  <tr>
    <!-- Panel 1 -->
    <td valign="top">
      <table border="1" cellpadding="10" width="300">
        <tr>
          <td>
            <h3>Datos del usuario</h3>
            <p><strong>Email:</strong> email@gmail.com</p>
            <p><a href="#">Edita el perfil</a></p>
          </td>
        </tr>
      </table>
    </td>

    <!-- Separador -->


  <tr>
    <!-- Panel 3 -->
    <td valign="top">
      <table border="1" cellpadding="10" width="300">
        <tr>
          <td>
            <h3>Detalle del Usuario</h3>
            <ul>
              <li><strong>Nombre:</strong> nombre</li>
              <li><strong>Apellidos:</strong> apellido</li>
              <li><strong>Contraseña:</strong> contraseña</li>
              <li><strong>Tokens:</strong> nº tokens</li>
              <li><strong>Insignias:</strong> nº Insignias</li>
              <li><strong>Valoración:</strong> nº Valoración</li>
            </ul>
          </td>
        </tr>
      </table>
    </td>

    <!-- Separador -->
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

    <!-- Panel 4 -->
    <td valign="top">
      <table border="1" cellpadding="10" width="300">
        <tr>
          <td>
            <h3>Descripción</h3>
            <textarea rows="8" cols="100" placeholder="Bio"></textarea>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>



<div style="height: 300px;"></div>

<?php
include 'includes/footer.php';
?>