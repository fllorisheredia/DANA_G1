<?php
include 'header_cliente.php';
include '../includes/db.php';
$id = $usuario_id = $_SESSION['usuario']['id'];

    $sacardatos = $conexion->prepare("SELECT nombre, password, tonkens, insignias, valoracion, email, perfil_publico FROM usuarios WHERE id = ?");
    $sacardatos->bind_param("i", $id);
    $sacardatos->execute();
    $result = $sacardatos->get_result();
    if ($usuario = $result->fetch_assoc()) {
      $nombre =  $usuario["nombre"]; 
      $password =  $usuario["password"];  
      $tonkens =  $usuario["tonkens"];  
      $insignias =  $usuario["insignias"];  
      $valoracion =  $usuario["valoracion"];  
      $email =  $usuario["email"];
      $descripcion = $usuario["perfil_publico"];  
    } else {
        echo "<tr><td>No se encontró el usuario.</td></tr>";
    }

    $sacardatos->close();

?>
              <tr>
                  <td>
                    <h3>Detalle del Usuario</h3>
                    <p><strong>Email:</strong> <?php echo $email ?> </p>
                  </td>
              </tr>
              <tr>
                <td> 
                    <ul>
                        <li><strong>Nombre:</strong> <?php echo $nombre ?></li>
                        <li><strong>Contraseña:</strong> <?php echo $password ?></li>
                        <li><strong>Tokens:</strong> <?php echo $tonkens ?></li>
                        <li><strong>Insignias:</strong> <?php echo $insignias ?></li>
                        <li><strong>Valoración:</strong> <?php echo $valoracion ?></li>
                        <fieldset class="fieldset">
                        <legend class="fieldset-legend"><strong>Descripción</strong> </legend>
                        <textarea style="width: 30%; height: 200px;" class="textarea h-24" placeholder="Bio"> <?php echo $descripcion ?></textarea>
                        </fieldset>
                    </ul>
                </td>
              </tr>


<?php
include 'footer_cliente.php';
?>