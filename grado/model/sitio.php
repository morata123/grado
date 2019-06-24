<?php
require_once('DBAbstract.php');
class sitio extends DBAbstract
{
    private $idsitio;
    private $sitio;
    private $idorden;
    
    public function __construct(){
        $this->idsitio = 0;
        $this->sitio = '';
        $this->idorden = 0;
    }
    public function __destruct(){}

    public function get_idsitio(){

        return $this->idsitio;
    }
    public function set_idsitio($idsitio){

        $this->idsitio=$idsitio;
    }

    public function get_sitio(){

        return $this->sitio;
    }
    public function set_sitio($sitio){

        $this->sitio=$sitio;
    }

    public function get_idorden(){
        return $this->idorden;
    }
    public function set_idorden($idorden){
        $this->idorden=$idorden;
    }

    
   public function get_by_idsitio($idsitio='') {
        if($idsitio != ''):
            $this->query = "select idsitio,sitio,idorden
           from sitio
            where idsitio='$idsitio';";
            $this->get_results_from_query();
        endif;
        if(count($this->rows) == 1):
            foreach ($this->rows[0] as $propiedad=>$valor):
            $this->$propiedad = $valor;
            endforeach;
        endif;
    }
    public function insert(){
        $this->query="insert into sitio
       (idsitio, sitio, idorden)
       values
       ('$this->idsitio','$this->sitio','$this->idorden');";
        $this->execute_single_query();
    }
    public function get_datos_sitio($_P)
    {
         $this->sitio=$_P['sitio'];
         $this->idorden=$_P['idorden'];
         $this->insert();
    }
    public function form_nuevo_sitio()
    {
        /*ESRIVE PARA COMBO*/   
        $sql ='SELECT idorden,anoplanta
                            FROM orden;';
                            $combo =$this->get_combo_box_all($sql,"anoplanta","idorden","idorden");


    $form="
    <div class='row'>
    <div class='col-xs-4 col-md-2'>.</div>
    <div class='col-xs-10 col-md-8'>
    <div class='form-group'>
    <form name='registrar_sitio' 
    action='handler_sitio.php?pag=registrar_sitio'
      method='POST'>
        <fieldset>
        
    <legend>Registrar sitio</legend>
    <div>
<label for='nombres'>idsitio</label>
<input type='text' class='form-control' id='idsitio' name='idsitio' 
   required autofocus 
     placeholder='ingrese idsitio '/> 
</div>

<div>
<label for='nombres'>sitio</label>
<input type='text' class='form-control' id='sitio' name='sitio' 
   required autofocus 
     placeholder='ingrese sitio' /> 
</div>

<div>
<label for='nombres'>idorden</label>
         $combo
</div>
<div>
<br />

<input type='submit' class='btn btn-success' name='registrar_sitio' value='Registrar sitio' />
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

        $this->query="update sitio set
           
                sitio='$this->sitio',
                idorden='$this->idorden'
                where idsitio='$this->idsitio';";
        //echo $this->query;
        $this->execute_single_query();
    }
    public function get_datos_modificar_sitio($_P)
    {
        $this->idsitio=$_P['idsitio'];
        $this->sitio=$_P['sitio'];
        $this->idorden=$_P['idorden'];
        $this->update();
    }
    public function form_modificar_sitio()
    {
            $sql ='SELECT idorden,anoplanta
                            FROM orden;';
                            $combo =$this->get_combo_box_all($sql,"anoplanta","idorden","idorden");
     $form="
  <div class='row'>
  <div class='col-xs-4 col-md-2'>.</div>
  <div class='col-xs-10 col-md-8'>

<div class='form-group'>
<form name='modificar_sitio' 
    action='handler_sitio.php?pag=modificar_sitio'
      method='POST'>
<fieldset>
<legend>Modificar sitio</legend>
<div>
<label for='nombres'>idsitio</label>
<input type='text' class='form-control' value='$this->idsitio' id='idsitio' name='idsitio' 
   required autofocus 
     placeholder='ingrese idsitio ' /> 
</div>

<div>
<label for='nombres'>sitio</label>
<input type='text' class='form-control' value='$this->sitio' id='sitio' name='sitio' required autofocus 
     placeholder='ingrese sitio' /> 
</div>

<div>
<label for='nombres'>idorden</label>
$combo
</div>
<div>
<br />
<input type='submit' class='btn btn-success' name='modificar_sitio' value='modificar_sitio' />
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
 public function get_datos_eliminar_sitio($_P)
    {
        $this->idsitio=$_P['idsitio'];
        $this->delete();
    }
public function form_eliminar_sitio(){
$form="
<div>
<form name='eliminar_sitio' 
    action='handler_sitio.php?pag=eliminar_sitio'
      method='POST'>
<fieldset>
<legend>Eliminar sitio</legend>
<div>
<label for='nombres'>idsitio</label>
<input type='text' id='idsitio' name='idsitio' 
   required autofocus value='$this->idsitio'
     placeholder='ingrese idsitio'
     disabled /> 
</div>
<div>
<input type='hidden' name='idsitio' id='idsitio' value='$this->idsitio' />
<input type='submit' name='eliminar_sitio' value='Eliminar_sitio' />
</div>
</fieldset>
</form>
</div>
        ";
        echo $form;
    }

public function delete(){
    $this->query="delete from sitio 
    where idsitio='$this->idsitio';";
$this->execute_single_query();
    } 









public function get_valores(){
        $sql="SELECT u.idsitio
                   , u.sitio
                   , u.idorden
                  
              FROM sitio u,orden r
              WHERE u.idorden=r.idorden
               ORDER BY sitio;";
     return $this->get_results_from_query2($sql);          
}


    public function get_tabla(){
        $sql="SELECT u.idsitio
                   , u.sitio
                   , u.idorden
              FROM sitio u
           ORDER BY sitio;";
$cab="
<h1>Administrador de sitio</h1>
<a href='handler_sitio.php?pag=form_nuevo_sitio'
class='btn btn-success'>
<span class='glyphicon glyphicon-plus'
 aria-hidden='true'></span> Nuevo sitio</a>
 <br/>
<table class='table'>
       <tr>
       <th>idsitio</th>
       <th>sitio</th>
       <th>idorden</th>
       </tr>
";
    $cuerpo="";
    
    $result=$this->get_results_from_query2($sql);
    while ($filas = $result->fetch_assoc()){
        $idsitio=$filas['idsitio'];
        $sitio=$filas['sitio'];
        $idorden=$filas['idorden'];
    $cuerpo=$cuerpo."<tr>
  
<td>$idsitio</td>
<td>$sitio</td>
<td>$idorden</td>
<td><a class='btn btn-warning'
href='handler_sitio.php?pag=form_modificar_sitio&idsitio=$idsitio'>
<span class='glyphicon glyphicon-pencil'
 aria-hidden='true'></span> 
MODIFICAR</a></td>
<td><a class='btn btn-danger'
href='handler_sitio.php?pag=form_eliminar_sitio&idsitio=$idsitio'>
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
        fileName: 'ListaArboles',    //Nombre del archivo 
    });
    </script>";

        echo $cab.$cuerpo.$pie;
    }
}

?>