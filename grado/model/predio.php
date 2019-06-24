<?php
require_once('DBAbstract.php');
class predio extends DBAbstract
{
	private $idpredio;   
    private $predio;
    private $zona;
    private $idinventario;
	
	public function __construct(){
		$this->idpredio=0;
        $this->predio='';
        $this->zona='';
        $this->idinventario=0;
	}
	public function __destruct(){}

	public function get_idpredio(){

		return $this->idpredio;
	}
	public function set_idpredio($idpredio){

		$this->idpredio=$idpredio;
	}
	public function get_predio(){

		return $this->predio;
	}
	public function set_predio($predio){

		$this->predio=$predio;
	}
	public function get_zona(){

		return $this->zona;
	}
	public function set_zona($zona){

		$this->zona=$zona;
	}

    public function get_idinventario(){
		return $this->idinventario;
	}
	public function set_idinventario($idinventario){
		$this->idinventario=$idinventario;
	}
	
   public function get_by_idpredio($idpredio='') {
		if($idpredio != ''):
			$this->query = "select idpredio,predio,zona,idinventario
		    from predios
			where idpredio='$idpredio';";
			$this->get_results_from_query();
		endif;
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
			$this->$propiedad = $valor;
			endforeach;
		endif;
	}
	public function insert(){
		$this->query="insert into predios
	   (idpredio,predio,zona,idinventario)
	   values
	   ('$this->idpredio','$this->predio','$this->zona','$this->idinventario');";
	    $this->execute_single_query();
	}
	public function get_datos_predio($_P)
	{
         $this->predio=$_P['predio'];
         $this->zona=$_P['zona'];
         $this->idinventario=$_P['idinventario'];
         $this->idpredio=$_P['idpredio'];
         $this->insert();
	}
	public function form_nuevo_predio()
    {
		/*ESRIVE PARA COMBO*/	
		$sql ='SELECT idinventario,realizo
							FROM inventario;';
							$combo =$this->get_combo_box_all($sql,"realizo","idinventario","idinventario");


    $form="
    <div class='row'>
    <div class='col-xs-4 col-md-2'>.</div>
    <div class='col-xs-10 col-md-8'>
    <div class='form-group'>
    <form name='registrar_predio' 
    action='handler_predio.php?pag=registrar_predio'
      method='POST'>
		<fieldset>
		<legend>Registrar predio</legend>
	<div>
        <label for='for_orden'>id predio</label>
        <input type='text' class='form-control' id='idpredio' name='idpredio' required autofocus 
        placeholder='ingrese idpredio' /> 
    </div>

	<div>
        <label for='for_orden'>predio</label>
        <input type='text' class='form-control' id='predio' name='predio' required autofocus 
        placeholder='ingrese predio' /> 
    </div>

    <div>
        <label for='for_orden'>zona</label>
        <input type='text' class='form-control' id='zona' name='zona' required autofocus 
        placeholder='ingrese zona' /> 
    </div>
<div>
<label for='nombres'>Id inventario</label>
		 $combo
</div>
<div>
<br />

<input type='submit' class='btn btn-success' name='registrar_predio' value='registrar_predio' />
</div>
</fieldset>
</form>
</div>

</div>
  <div class='col-xs-4 col-md-2'></div>
</div>
    	";
        echo $form;
    }


	public function update(){

        $this->query="update predios set
           
			predio='$this->predio',
			zona='$this->zona',
            idinventario='$this->idinventario'
            where idpredio='$this->idpredio';";
		//echo $this->query;
		$this->execute_single_query();
	}
	public function get_datos_modificar_predio($_P)
	{
         $this->idpredio=$_P['idpredio'];
         $this->predio=$_P['predio'];
         $this->zona=$_P['zona'];
         $this->idinventario=$_P['idinventario'];   
         $this->update();
	}
	public function form_modificar_predio()
    {
			$sql ='SELECT idinventario,realizo
							FROM inventario;';
							$combo =$this->get_combo_box_all($sql,"realizo","idinventario","idinventario");
     $form="
  <div class='row'>
  <div class='col-xs-4 col-md-2'>.</div>
  <div class='col-xs-10 col-md-8'>

<div class='form-group'>
<form name='modificar_predio' 
    action='handler_predio.php?pag=modificar_predio'
      method='POST'>
<fieldset>
<legend>Modificar predio</legend>
<div>
<label for='nombres'>idpredio</label>
<input type='text' class='form-control' value='$this->idpredio' id='idpredio' name='idpredio' 
   required autofocus 
     placeholder='ingrese idpredio ' /> 
</div>

<div>
<label for='nombres'>predio</label>
<input type='text' class='form-control' value='$this->predio' id='predio' name='predio' required autofocus 
     placeholder='ingrese predio' /> 
</div>
<div>
<label for='nombres'>zona</label>
<input type='text' class='form-control' value='$this->zona' id='zona' name='zona' required autofocus 
     placeholder='ingrese zona' /> 
</div>

<div>
<label for='nombres'>id inventario</label>
$combo
</div>
<div>
<br />
<input type='submit' class='btn btn-success' name='modificar_predio' value=' modificar_predio' />
</div>
</fieldset>
</form>
</div>

</div>
  <div class='col-xs-4 col-md-2'></div>
</div>
    	";
        echo $form;
    }
 public function get_datos_eliminar_predio($_P)
    {
    	$this->idpredio=$_P['idpredio'];
    	$this->delete();
    }
public function form_eliminar_predio(){
$form="
<div>
<form name='eliminar_predio' 
    action='handler_predio.php?pag=eliminar_predio'
      method='POST'>
<fieldset>
<legend>Eliminar predio</legend>
<div>
<label for='nombres'>idpredio</label>
<input type='text' id='idpredio' name='idpredio' 
   required autofocus value='$this->idpredio'
     placeholder='ingrese idpredio'
     disabled /> 
</div>
<div>
<input type='hidden' name='idpredio' id='idpredio' value='$this->idpredio' />
<input type='submit' name='eliminar_predio' value='Eliminar predio' />
</div>
</fieldset>
</form>
</div>
    	";
        echo $form;
    }

public function delete(){
    $this->query="delete from predios
    where idpredio='$this->idpredio';
";
$this->execute_single_query();
	} 









public function get_valores(){
		$sql="SELECT u.idpredio
				   , u.predio
				   , u.zona
				   , u.idinventario
				  
			  FROM predios u,inventario r
			  WHERE u.idinventario=r.idinventario
			   ORDER BY predio;";
     return $this->get_results_from_query2($sql);		   
}


	public function get_tabla(){
		$sql="SELECT u.idpredio
		, u.predio
		, u.zona
		, c.realizo AS idinventario
		FROM predios u
		INNER JOIN inventario c 
		ON(u.idinventario=c.idinventario)
		ORDER BY predio;";
$cab="
<h1>Administrador de predio</h1>
<a href='handler_predio.php?pag=form_nuevo_predio'
class='btn btn-success'>
<span class='glyphicon glyphicon-plus'
 aria-hidden='true'></span> Nuevo predio</a>
 <br/>
<table class='table'>
	   <tr><th>idpredio</th>
	   <th>predio</th>
	   <th>zona</th>
	   <th>idinventario</th><tr>
";
	$cuerpo="";
	
	$result=$this->get_results_from_query2($sql);
	while ($filas = $result->fetch_assoc()){
		$idpredio=$filas['idpredio'];
        $predio=$filas['predio'];
        $zona=$filas['zona'];
        $idinventario=$filas['idinventario'];
    $cuerpo=$cuerpo."<tr>
  
<td>$idpredio</td>
<td>$predio</td>
<td>$zona</td>
<td>$idinventario</td>
<td><a class='btn btn-warning'
href='handler_predio.php?pag=form_modificar_predio&idpredio=$idpredio'>
<span class='glyphicon glyphicon-pencil'
 aria-hidden='true'></span> 
MODIFICAR</a></td>
<td><a class='btn btn-danger'
href='handler_predio.php?pag=form_eliminar_predio&idpredio=$idpredio'>
<span class='glyphicon glyphicon-trash'
 aria-hidden='true'></span> 
ELIMINAR</a></td>
					</tr>";
		}

		$pie="</table> 
		<script src='js/jquery-1.12.4.min.js'></script>
<script src='js/FileSaver.min.js'></script>
<script src='js/Blob.min.js'></script>
<script src='js/xls.core.min.js'></script>
<script src='js/tableexport.js'></script>


<script>
$('table').tableExport({
	formats: ['xlsx','txt', 'csv'], //Tipo de archivos a exportar ('xlsx','txt', 'csv', 'xls')
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: 'ListadoPaises',    //Nombre del archivo 
});
</script>
		
		
		
		";

		echo $cab.$cuerpo.$pie;
	}
}

?>