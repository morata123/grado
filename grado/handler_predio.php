<?php
session_start();
include_once('model/predio.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$contr=new predio();
$template=new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_predio':
         echo $contr->get_tabla();
	break;
	case 'registrar_predio':
		$contr->get_datos_predio($_POST);
		echo $contr->get_tabla();
	break;
	case 'form_nuevo_predio':
         $contr->form_nuevo_predio();
	break;
	case 'modificar_predio':
		$contr->get_datos_modificar_predio($_POST);
		echo $contr->get_tabla();
	break;
	case 'form_modificar_predio':
	    $contr->get_by_idpredio($_GET['idpredio']);
		$contr->form_modificar_predio();
	break;
	case 'eliminar_predio':
		$contr->get_datos_eliminar_predio($_POST);
		echo $contr->get_tabla();

	break;
	case 'form_eliminar_predio':
		$contr->get_by_idpredio($_GET['idpredio']);
		$contr->form_eliminar_predio();

	break;
	case 'exportar_pdf':
		$contr->exportar_pdf();
	break;
	case 'exportar_excel':
		$contr->exportar_excel();
	break;
	case 'exportar_word':
		$contr->exportar_word();
	break;
	case 'buscar_predio':

		break;
}

//$template->foot();

}
function helper_pag_data() {
$pag_data=$_GET['pag'];
return $pag_data;
}

handler();

?>