<?php
session_start();
include_once('model/orden.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$orde=new orden();
$template=new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_orden':
         echo $orde->get_tabla();
	break;
	case 'registrar_orden':
		$orde->get_datos_orden($_POST);
		echo $orde->get_tabla();
	break;
	case 'form_nuevo_orden':
         $orde->form_nuevo_orden();
	break;
	case 'modificar_orden':
		$orde->get_datos_modificar_orden($_POST);
		echo $orde->get_tabla();
	break;
	case 'form_modificar_orden':
	    $orde->get_by_idorden($_GET['idorden']);
		$orde->form_modificar_orden();
	break;
	case 'eliminar_orden':
		$orde->get_datos_eliminar_orden($_POST);
		echo $orde->get_tabla();

	break;
	case 'form_eliminar_orden':
		$orde->get_by_idorden($_GET['idorden']);
		$orde->form_eliminar_orden();

	break;
	case 'exportar_pdf':
		$orde->exportar_pdf();
	break;
	case 'exportar_excel':
		$orde->exportar_excel();
	break;
	case 'exportar_word':
		$orde->exportar_word();
	break;
	case 'buscar_orden':

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