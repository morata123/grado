<?php
require_once('DBAbstract.php');
class orden extends DBAbstract
{
	private $idorden;
    private $anoplanta;
    private $superficie;
    private $bloque;
    private $idcontrato;
	
	public function __construct(){
		$this->idorden = 0;
        $this->anoplanta = 0;
        $this->superficie = 0;
        $this->bloque = 0;
        $this->idcontrato = 0;
	}
	public function __destruct(){}

	public function get_idorden(){

		return $this->idorden;
	}
	public function set_idorden($idorden){

		$this->idorden=$idorden;
	}
	public function get_anoplanta(){

		return $this->anoplanta;
	}
	public function set_anoplanta($anoplanta){

		$this->anoplanta=$anoplanta;
	}

    public function get_superficie(){
		return $this->superficie;
	}
	public function set_superficie($superficie){
		$this->superficie=$superficie;
	}

	public function get_bloque(){

		return $this->bloque;
	}
	public function set_bloque($bloque){

		$this->bloque=$bloque;
	}
	public function get_idcontrato()
    {
        return $this->idcontrato;
    }

    public function set_idcontrato($idcontrato)
    {
        $this->idcontrato=$idcontrato;
    }

	
   public function get_by_idorden($idorden='') {
		if($idorden != ''):
			$this->query = "select idorden,anoplanta,superficie,bloque,idcontrato
		    from orden
			where idorden='$idorden';";
			$this->get_results_from_query();
		endif;
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
			$this->$propiedad = $valor;
			endforeach;
		endif;
	}
	public function insert(){
		$this->query="insert into orden
	   (idorden,anoplanta,superficie,bloque,idcontrato)
	   values
	   ('$this->idorden','$this->anoplanta','$this->superficie','$this->bloque','$this->idcontrato');";
	    $this->execute_single_query();
	}
	public function get_datos_orden($_P)
	{
         $this->anoplanta=$_P['anoplanta'];
         $this->superficie=$_P['superficie'];
   	     $this->bloque=$_P['bloque'];
         $this->idcontrato=$_P['idcontrato'];
         $this->insert();
	}
	public function form_nuevo_orden()
    {
		/*ESRIVE PARA COMBO*/	
		$sql ='SELECT idcontrato,contrato
							FROM contrato;';
							$combo =$this->get_combo_box_all($sql,"contrato","idcontrato","idcontrato");


    $form="
    <div class='row'>
    <div class='col-xs-4 col-md-2'>.</div>
    <div class='col-xs-10 col-md-8'>
    <div class='form-group'>
    <form name='registrar_orden' 
    action='handler_orden.php?pag=registrar_orden'
      method='POST'>
		<fieldset>
		<legend>Registrar Orden</legend>
	<div>
        <label for='for_orden'>id Orden</label>
        <input type='text' class='form-control' id='idorden' name='idorden' required autofocus 
        placeholder='ingrese Orden' /> 
    </div>

	<div>
        <label for='for_orden'>Anoplanta</label>
        <input type='text' class='form-control' id='anoplanta' name='anoplanta' required autofocus 
        placeholder='ingrese anoplanta' /> 
    </div>

	<div>
        <label for='for_orden'>Superficie</label>
        <input type='text' class='form-control' id='superficie' name='superficie' required autofocus 
        placeholder='ingrese Superficie' /> 
    </div>

    <div>
        <label for='for_orden'>Bloque</label>
        <input type='text' class='form-control' id='bloque' name='bloque' required autofocus 
        placeholder='ingrese Bloque' /> 
    </div>

<div>
<label for='nombres'>Id Contrato</label>
		 $combo
</div>
<div>
<br />

<input type='submit' class='btn btn-success' name='registrar_orden' value='registrar_orden' />
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

        $this->query="update orden set
           
			anoplanta='$this->anoplanta',
            superficie='$this->superficie',
            bloque='$this->bloque',
            idcontrato='$this->idcontrato'
            where idorden='$this->idorden';";
		//echo $this->query;
		$this->execute_single_query();
	}
	public function get_datos_modificar_orden($_P)
	{
         $this->idorden=$_P['idorden'];
         $this->anoplanta=$_P['anoplanta'];
         $this->superficie=$_P['superficie'];
         $this->bloque=$_P['bloque'];
         $this->idcontrato=$_P['idcontrato'];   
         $this->update();
	}
	public function form_modificar_orden()
    {
			$sql ='SELECT idcontrato,contrato
							FROM contrato;';
							$combo =$this->get_combo_box_all($sql,"contrato","idcontrato","idcontrato");
     $form="
  <div class='row'>
  <div class='col-xs-4 col-md-2'>.</div>
  <div class='col-xs-10 col-md-8'>

<div class='form-group'>
<form name='modificar_orden' 
    action='handler_orden.php?pag=modificar_orden'
      method='POST'>
<fieldset>
<legend>Modificar Orden</legend>
<div>
<label for='nombres'>idorden</label>
<input type='text' class='form-control' value='$this->idorden' id='idorden' name='idorden' 
   required autofocus 
     placeholder='ingrese id Orden ' /> 
</div>

<div>
<label for='nombres'>Anoplanta</label>
<input type='text' class='form-control' value='$this->anoplanta' id='anoplanta' name='anoplanta' required autofocus 
     placeholder='ingrese anoplanta' /> 
</div>
<div>
<label for='nombres'>Superficie</label>
<input type='text' class='form-control' value='$this->superficie' id='superficie' name='superficie'  required autofocus 
     placeholder='ingrese Superficie /> 
</div>
<div>
<label for='nombres'>Bloque</label>
<input type='text' class='form-control' value='$this->bloque' id='bloque' name='bloque'  required autofocus 
     placeholder='ingrese Bloque /> 
</div>
<div>
<label for='nombres'>id Contrato</label>
$combo
</div>
<div>
<br />
<input type='submit' class='btn btn-success' name='modificar_orden' value='Modificar Orden' />
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
 public function get_datos_eliminar_orden($_P)
    {
    	$this->idorden=$_P['idorden'];
    	$this->delete();
    }
public function form_eliminar_orden(){
$form="
<div>
<form name='eliminar_orden' 
    action='handler_orden.php?pag=eliminar_orden'
      method='POST'>
<fieldset>
<legend>Eliminar Orden</legend>
<div>
<label for='nombres'>idorden</label>
<input type='text' id='idorden' name='idorden' 
   required autofocus value='$this->idorden'
     placeholder='ingrese idorden'
     disabled /> 
</div>
<div>
<input type='hidden' name='idorden' id='idorden' value='$this->idorden' />
<input type='submit' name='eliminar_orden' value='Eliminar Orden' />
</div>
</fieldset>
</form>
</div>
    	";
        echo $form;
    }

public function delete(){
    $this->query="delete from orden
    where idorden='$this->idorden';
";
$this->execute_single_query();
	} 









public function get_valores(){
		$sql="SELECT u.idorden
				   , u.anoplanta
				   , u.superficie
				   , u.bloque
				   , u.idcontrato
				  
			  FROM orden u,contrato r
			  WHERE u.idcontrato=r.idcontrato
			   ORDER BY anoplanta;";
     return $this->get_results_from_query2($sql);		   
}


	public function get_tabla(){
		$sql="SELECT u.idorden
		, u.anoplanta
		, u.superficie
		, u.bloque
		, c.contrato AS idcontrato
		FROM orden u
		INNER JOIN contrato c 
		ON(u.idcontrato=c.idcontrato)
		ORDER BY anoplanta;";
$cab="
<h1>Administrador de orden</h1>
<a href='handler_orden.php?pag=form_nuevo_orden'
class='btn btn-success'>
<span class='glyphicon glyphicon-plus'
 aria-hidden='true'></span> Nuevo orden</a>
 <br/>
<table class='table'>
	   <tr><th>idorden</th>
	   <th>anoplanta</th>
       <th>superficie</th>
       <th>bloque</th>
	   <th>idcontrato</th><tr>
";
	$cuerpo="";
	
	$result=$this->get_results_from_query2($sql);
	while ($filas = $result->fetch_assoc()){
		$idorden=$filas['idorden'];
        $anoplanta=$filas['anoplanta'];
        $superficie=$filas['superficie'];
        $bloque=$filas['bloque'];
        $idcontrato=$filas['idcontrato'];
    $cuerpo=$cuerpo."<tr>
  
<td>$idorden</td>
<td>$anoplanta</td>
<td>$superficie</td>
<td>$bloque</td>
<td>$idcontrato</td>
<td><a class='btn btn-warning'
href='handler_orden.php?pag=form_modificar_orden&idorden=$idorden'>
<span class='glyphicon glyphicon-pencil'
 aria-hidden='true'></span> 
MODIFICAR</a></td>
<td><a class='btn btn-danger'
href='handler_orden.php?pag=form_eliminar_orden&idorden=$idorden'>
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