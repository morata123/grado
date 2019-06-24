<?php
session_start();
include_once('model/sitio.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$det=new sitio();
$template=new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_sitio':
         echo $det->get_tabla();
	break;
	case 'registrar_sitio':
		$det->get_datos_sitio($_POST);
		echo $det->get_tabla();
	break;
	case 'form_nuevo_sitio':
         $det->form_nuevo_sitio();
	break;
	case 'modificar_sitio':
		$det->get_datos_modificar_sitio($_POST);
		echo $det->get_tabla();
	break;
	case 'form_modificar_sitio':
	    $det->get_by_idsitio($_GET['idsitio']);
		$det->form_modificar_sitio();
	break;
	case 'eliminar_sitio':
		$det->get_datos_eliminar_sitio($_POST);
		echo $det->get_tabla();

	break;
	case 'form_eliminar_sitio':
		$det->get_by_idsitio($_GET['idsitio']);
		$det->form_eliminar_sitio();

	break;
	case 'exportar_pdf':
		$det->exportar_pdf();
	break;
	case 'exportar_excel':
		$det->exportar_excel();
	break;
	case 'exportar_word':
		$det->exportar_word();
	break;
	case 'buscar_dsitio':

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