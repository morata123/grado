<?php
session_start();
include_once('model/contrato.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$contr=new contrato();
$template=new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_contrato':
         echo $contr->get_tabla();
	break;
	case 'registrar_contrato':
		$contr->get_datos_contrato($_POST);
		echo $contr->get_tabla();
	break;
	case 'form_nuevo_contrato':
         $contr->form_nuevo_contrato();
	break;
	case 'modificar_contrato':
		$contr->get_datos_modificar_contrato($_POST);
		echo $contr->get_tabla();
	break;
	case 'form_modificar_contrato':
	    $contr->get_by_idcontrato($_GET['idcontrato']);
		$contr->form_modificar_contrato();
	break;
	case 'eliminar_contrato':
		$contr->get_datos_eliminar_contrato($_POST);
		echo $contr->get_tabla();

	break;
	case 'form_eliminar_contrato':
		$contr->get_by_idcontrato($_GET['idcontrato']);
		$contr->form_eliminar_contrato();

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
	case 'buscar_contrato':

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