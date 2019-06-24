<?php

require_once('DBAbstract.php');
class inventario extends DBAbstract{

    private $idinventario;
    private $realizo;
    
    public function __construct(){

        $this->idinventario=0;
        $this->realizo='';
    }
    public  function __destruct(){}



    public function get_idinventario()
    {

        return $this->idinventario;
    }
    public function set_idinventario($idinventario){
         $this ->$idinventario=$idinventario;
    }

    public function get_realizo(){
        return $this ->realizo;
    }
    public function set_realizo($realizo){

        $this->$realizo=$realizo;
    }
    public function get_by_idinventario($idinventario=''){

        if($idinventario!= ''):
            $this->query="select idinventario,realizo from inventario
            where idinventario='$idinventario';";
            $this ->get_results_from_query();
        endif;
        if(count($this->rows)==1):
            foreach($this ->rows[0] as $propiedad=>$valor):
                $this ->$propiedad =$valor;
            endforeach;
        endif;

    }
    
    public function insert(){
        $this->query="insert into inventario
       (realizo,idinventario)
       values
       ('$this->realizo','$this->idinventario');";
        $this->execute_single_query();
    }
    
    public function get_datos_inventario($_P)
    {
         $this->realizo=$_P['realizo'];
         $this->idinventario=$_P['idinventario'];
         $this->insert();
    }
    public function form_nuevo_inventario()
    {
    $form="
    <div class='row'>
    <div class='col-xs-4 col-md-2'>.</div>
    <div class='col-xs-10 col-md-8'>
    <div class='form-group'>
    <form name='registrar_inventario' 
    action='handler_inventario.php?pag=registrar_inventario'
      method='POST'>
    <fieldset>
    <legend>Registrar Inventario</legend>
    <div>
<label for='realizo'>id Inventario</label>
<input type='text' class='form-control' id='idinventario' name='idinventario' 
   required autofocus 
     placeholder='ingrese Inventario '/> 
</div>
<div>
<label for='realizo'>realizo</label>
<input type='text' class='form-control' id='realizo' name='realizo' 
   required autofocus 
     placeholder='Ingrese realizo'/> 
</div>
<div>
<br/>

<input type='submit' class='btn btn-success' name='registrar_inventario' value=' registrar_inventario' />
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

        $this->query="update inventario set
            
            realizo='$this->realizo'
            where idinventario='$this->idinventario';";
        //echo $this->query;
        $this->execute_single_query();
    }
    public function get_datos_modificar_inventario($_P)
    {
         $this->idinventario=$_P['idinventario'];
         $this->realizo=$_P['realizo'];       
         $this->update();
    }  
    public function form_modificar_inventario()
    {
     $form="
  <div class='row'>
  <div class='col-xs-4 col-md-2'>.</div>
  <div class='col-xs-10 col-md-8'>

<div class='form-group'>
<form name='modificar_inventario' 
    action='handler_inventario.php?pag=modificar_inventario'
    method='POST'>
<fieldset>
<legend>Modificar Inventario</legend>
<div>
<label for='idinventario'>id Inventario</label>
<input type='text' class='form-control' value='$this->idinventario' id='idinventario' name='idinventario' 
   required autofocus 
     placeholder='ingrese Inventario' /> 
</div>
<div>
<label for='realizo'> Realizo</label>
<input type='text' class='form-control' value='$this->realizo' id='realizo' name='realizo' 
   required autofocus 
     placeholder='ingrese nombre de Realizo ' /> 
</div>
<div>
<br />
<input type='submit' class='btn btn-success' name='modificar_inventario' value=' modificar_inventario' />
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
    public function get_datos_eliminar_inventario($_P)
    {
        $this->idinventario=$_P['idinventario'];
        $this->delete();
    }
public function form_eliminar_inventario(){
$form="
<div>
<form name='eliminar_inventario' 
    action='handler_inventario.php?pag=eliminar_inventario'
      method='POST'>
<fieldset>
<legend>Eliminar Inventario</legend>
<div>
<label for='idinventario'>id inventario</label>
<input type='text' id='idinventario' name='idinventario' 
   required autofocus value='$this->idinventario'
     placeholder='ingrese nombres de Realizo'
     disabled /> 
</div>
<div>
<input type='hidden' name='idinventario' id='idinventario' value='$this->idinventario' />
<input type='submit' name='eliminar_inventario' value='eliminar_inventario ' />
</div>
</fieldset>
</form>
</div>
        ";
        echo $form;
    }
    public function delete(){
        $this->query="delete from inventario 
                      where idinventario='$this->idinventario';
                ";
        $this->execute_single_query();
    }
    
   /* public function get_valores(){
        $sql="SELECT u.idinventario
              u.realizo  
              FROM predios u,
               ORDER BY predios;";
     return $this->get_results_from_query2($sql);          
}*/

public function get_tabla(){
    $sql="SELECT u.idinventario
               , u.realizo
          FROM Inventario u
       ORDER BY realizo;";
$cab="
<h1 >Administrador de Inventarios</h1>
<a href='handler_inventario.php?pag=form_nuevo_inventario'
class='btn btn-success'>
<span class='glyphicon glyphicon-plus'
aria-hidden='true'></span> Nuevo Inventario</a>
<table class='table'>
   <tr>
   <th>id Inventario</th>
   <th>realizo</th></tr>
";
$cuerpo="";

$result=$this->get_results_from_query2($sql);
while ($filas = $result->fetch_assoc()){
    $idinventario=$filas['idinventario'];
    $realizo=$filas['realizo'];
$cuerpo=$cuerpo."<tr>
<td>$idinventario</td>
<td>$realizo</td>
<td><a class='btn btn-warning'
href='handler_inventario.php?pag=form_modificar_inventario&idinventario=$idinventario'>
<span class='glyphicon glyphicon-pencil'
aria-hidden='true'></span> 
MODIFICAR</a></td>
<td><a class='btn btn-danger'
href='handler_inventario.php?pag=form_eliminar_inventario&idinventario=$idinventario'>
<span class='glyphicon glyphicon-trash'
aria-hidden='true'></span> 
ELIMINAR</a></td>
                </tr>";
    }

    $pie="</table>";

    echo $cab.$cuerpo.$pie;
}
}


?>