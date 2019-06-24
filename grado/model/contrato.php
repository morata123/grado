<?php
require_once('DBAbstract.php');
class contrato extends DBAbstract
{
	private $idcontrato;   
    private $contrato;
    private $idpredio;
	
	public function __construct(){
		$this->idcontrato=0;
        $this->contrato='';
        $this->idpredio=0;
	}
	public function __destruct(){}

	public function get_idcontrato(){

		return $this->idcontrato;
	}
	public function set_idcontrato($idcontrato){

		$this->idcontrato=$idcontrato;
	}
	public function get_contrato(){

		return $this->contrato;
	}
	public function set_contrato($contrato){

		$this->contrato=$contrato;
	}

    public function get_idpredio(){
		return $this->idpredio;
	}
	public function set_idpredio($idpredio){
		$this->idpredio=$idpredio;
	}
	
   public function get_by_idcontrato($idcontrato='') {
		if($idcontrato != ''):
			$this->query = "select idcontrato,contrato,idpredio
		    from contrato
			where idcontrato='$idcontrato';";
			$this->get_results_from_query();
		endif;
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
			$this->$propiedad = $valor;
			endforeach;
		endif;
	}
	public function insert(){
		$this->query="insert into contrato
	   (idcontrato,contrato,idpredio)
	   values
	   ('$this->idcontrato','$this->contrato','$this->idpredio');";
	    $this->execute_single_query();
	}
	public function get_datos_contrato($_P)
	{
         $this->contrato=$_P['contrato'];
         $this->idpredio=$_P['idpredio'];
         $this->idcontrato=$_P['idcontrato'];
         $this->insert();
	}
	public function form_nuevo_contrato()
    {
		/*ESRIVE PARA COMBO*/	
		$sql ='SELECT idpredio,predio
							FROM predios;';
							$combo =$this->get_combo_box_all($sql,"predio","idpredio","idpredio");


    $form="
    <div class='row'>
    <div class='col-xs-4 col-md-2'>.</div>
    <div class='col-xs-10 col-md-8'>
    <div class='form-group'>
    <form name='registrar_contrato' 
    action='handler_contrato.php?pag=registrar_contrato'
      method='POST'>
		<fieldset>
		<legend>Registrar contrato</legend>
	<div>
        <label for='for_orden'>id contrato</label>
        <input type='text' class='form-control' id='idcontrato' name='idcontrato' required autofocus 
        placeholder='ingrese idcontrato' /> 
    </div>

	<div>
        <label for='for_orden'>contrato</label>
        <input type='text' class='form-control' id='contrato' name='contrato' required autofocus 
        placeholder='ingrese contrato' /> 
    </div>
<div>
<label for='nombres'>Id predios</label>
		 $combo
</div>
<div>
<br />

<input type='submit' class='btn btn-success' name='registrar_contrato' value='registrar_contrato' />
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

        $this->query="update contrato set
           
			contrato='$this->contrato',
            idpredio='$this->idpredio'
            where idcontrato='$this->idcontrato';";
		//echo $this->query;
		$this->execute_single_query();
	}
	public function get_datos_modificar_contrato($_P)
	{
         $this->idcontrato=$_P['idcontrato'];
         $this->contrato=$_P['contrato'];
         $this->idpredio=$_P['idpredio'];   
         $this->update();
	}
	public function form_modificar_contrato()
    {
			$sql ='SELECT idpredio,predio
							FROM predios;';
							$combo =$this->get_combo_box_all($sql,"predio","idpredio","idpredio");
     $form="
  <div class='row'>
  <div class='col-xs-4 col-md-2'>.</div>
  <div class='col-xs-10 col-md-8'>

<div class='form-group'>
<form name='modificar_contrato' 
    action='handler_contrato.php?pag=modificar_contrato'
      method='POST'>
<fieldset>
<legend>Modificar contrato</legend>
<div>
<label for='nombres'>idcontrato</label>
<input type='text' class='form-control' value='$this->idcontrato' id='idcontrato' name='idcontrato' 
   required autofocus 
     placeholder='ingrese idcontrato ' /> 
</div>

<div>
<label for='nombres'>contrato</label>
<input type='text' class='form-control' value='$this->contrato' id='contrato' name='contrato' required autofocus 
     placeholder='ingrese contrato' /> 
</div>

<div>
<label for='nombres'>id predios</label>
$combo
</div>
<div>
<br />
<input type='submit' class='btn btn-success' name='modificar_contrato' value=' modificar_contrato' />
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
 public function get_datos_eliminar_contrato($_P)
    {
    	$this->idcontrato=$_P['idcontrato'];
    	$this->delete();
    }
public function form_eliminar_contrato(){
$form="
<div>
<form name='eliminar_contrato' 
    action='handler_contrato.php?pag=eliminar_contrato'
      method='POST'>
<fieldset>
<legend>Eliminar contrato</legend>
<div>
<label for='nombres'>idcontrato</label>
<input type='text' id='idcontrato' name='idcontrato' 
   required autofocus value='$this->idcontrato'
     placeholder='ingrese idcontrato'
     disabled /> 
</div>
<div>
<input type='hidden' name='idcontrato' id='idcontrato' value='$this->idcontrato' />
<input type='submit' name='eliminar_contrato' value='Eliminar contrato' />
</div>
</fieldset>
</form>
</div>
    	";
        echo $form;
    }

public function delete(){
    $this->query="delete from contrato
    where idcontrato='$this->idcontrato';
";
$this->execute_single_query();
	} 









public function get_valores(){
		$sql="SELECT u.idcontrato
				   , u.contrato
				   , u.idpredio
				  
			  FROM contrato u,predios r
			  WHERE u.idpredio=r.idpredio
			   ORDER BY contrato;";
     return $this->get_results_from_query2($sql);		   
}


	public function get_tabla(){
		$sql="SELECT u.idcontrato
		, u.contrato
		, c.predio AS idpredio
		FROM contrato u
		INNER JOIN predios c 
		ON(u.idpredio=c.idpredio)
		ORDER BY contrato;";
$cab="
<h1>Administrador de contrato</h1>
<a href='handler_contrato.php?pag=form_nuevo_contrato'
class='btn btn-success'>
<span class='glyphicon glyphicon-plus'
 aria-hidden='true'></span> Nuevo contrato</a>
 <br/>
<table class='table'>
	   <tr><th>idcontrato</th>
	   <th>contrato</th>
	   <th>idpredio</th><tr>
";
	$cuerpo="";
	
	$result=$this->get_results_from_query2($sql);
	while ($filas = $result->fetch_assoc()){
		$idcontrato=$filas['idcontrato'];
        $contrato=$filas['contrato'];
        $idpredio=$filas['idpredio'];
    $cuerpo=$cuerpo."<tr>
  
<td>$idcontrato</td>
<td>$contrato</td>
<td>$idpredio</td>
<td><a class='btn btn-warning'
href='handler_contrato.php?pag=form_modificar_contrato&idcontrato=$idcontrato'>
<span class='glyphicon glyphicon-pencil'
 aria-hidden='true'></span> 
MODIFICAR</a></td>
<td><a class='btn btn-danger'
href='handler_contrato.php?pag=form_eliminar_contrato&idcontrato=$idcontrato'>
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