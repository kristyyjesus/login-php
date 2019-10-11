<?php  


$alert=" ";

if(!empty($_POST))
{
 if(empty($_POST['usuario']) || empty ($_POST['clave'])){
   $alert = "Ingrese el usuario y su clave";
 }else{
   require_once "conexion.php";
   $user = mysqli_real_escape_string($conection, $_POST['usuario']);
   $contra = mysqli_real_escape_string($conection,$_POST['clave']);
    
   $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$contra' ");
   $res = mysqli_num_rows($query);
  if($res > 0){
    $data = mysqli_fetch_array($query);
    session_start();
    $_SESSION['active'] = true;
    $_SESSION['idUser'] = $data['id_usuario'];
    $_SESSION['nombre'] = $data['nombre'];
    $_SESSION['email'] = $data['correo'];
    $_SESSION['user'] = $data['usuario'];
    $_SESSION['rol'] = $data['rol'];

    header('location: principal/menu.php');
     
  }else{
    $alert = 'El usuario o la clave son incorrectos';
     session_destroy();
   }
  }
 }
 
?> 


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col md-4 p-4 card">
            <form action="" method="POST">
                <h1> LOGIN</h1>

                <div class="input-group">
                    <input type="text" name="usuario" placeholder="Usuario"  class="form-control" required autofocus>
                </div>
                <div class="input-group">
                <input type="password" name="clave" placeholder="Contraseña"  class="form-control">
                </div>
                <div class="input-group">
                        <button type="submit" class="btn btn-success btn-block">Enviar</button>
                    </div>
                    <div class="alert"><?php echo isset($alert)? $alert : '';?></div>
                
            
        </form>
    </div>
        </div> 
    </div>
    
</body>
</html>