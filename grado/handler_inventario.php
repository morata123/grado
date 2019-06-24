<?php
session_start();
include_once('model/inventario.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$cat=new inventario();
$template=new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_inventario':
         echo $cat->get_tabla();
	break;
	case 'registrar_inventario':
		$cat->get_datos_inventario($_POST);
		echo $cat->get_tabla();
	break;
	case 'form_nuevo_inventario':
         $cat->form_nuevo_inventario();
	break;
	case 'modificar_inventario':
		$cat->get_datos_modificar_inventario($_POST);
		echo $cat->get_tabla();
	break;
	case 'form_modificar_inventario':
	    $cat->get_by_idinventario($_GET['idinventario']);
		$cat->form_modificar_inventario();
	break;
	case 'eliminar_inventario':
		$cat->get_datos_eliminar_inventario($_POST);
		echo $cat->get_tabla();


	break;
	case 'form_eliminar_inventario':
		$cat->get_by_idinventario($_GET['idinventario']);
		$cat->form_eliminar_inventario();

	break;
	case 'exportar_pdf':
		$cat->exportar_pdf();
	break;
	case 'exportar_excel':
		$cat->exportar_excel();
	break;
	case 'exportar_word':
		$cat->exportar_word();
	break;
	case 'buscar_inventario':

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