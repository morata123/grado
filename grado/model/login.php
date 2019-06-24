<?php

include_once('usuarios.php');
$nom=$_POST['txt_nombre'];

$pass=$_POST['txt_password'];

echo $nom;
echo "   ";
echo $pass;

$user = new usuarios();
$res=$user->get_validar_usuario($nom,$pass);

if($res==true){
    
        $user->get_by_name_pass($nom,$pass);
        
        session_start();

        $_SESSION["id_usuario"]=$user->get_id_usuario();
        $_SESSION["nombre"]=$user->get_nombre();
        $_SESSION["rol"]=$user->get_rol();

	header("status:301 Moved Permanently");
        header("location:../handler_arboles.php?pag=listar_arboles");
        exit;
        
}
else
{
        header("status:301 Moved Permanently");
        header("location: http://localhost/grado/index.html");
        exit;
}


?>