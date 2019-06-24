<?php
require_once('DBAbstract.php');
class arboles extends DBAbstract
{
    private $idarbol;
    private $fuente;
    private $especie;
    private $edad;
    private $numarbol;
    private $diametro;
    private $altura;
    private $idsitio;
    private $fechaplan;

    public function __construct(){

        $this->idarbol = 0;
        $this->fuente = '';
        $this->especie = '';
        $this->edad = 0;
        $this->numarbol = 0;
        $this->diametro = 0;
        $this->altura = 0;
        $this->idsitio = 0;
        $this->fechaplan = 0;
    }
    public function __destruct(){}

    public function get_idarbol(){

        return $this->idarbol;
    }
    public function set_idarbol($idarbol){

        $this->idarbol=$idarbol;
    }

    public function get_fuente(){

        return $this->fuente;
    }
    public function set_fuente($fuente){

        $this->fuente=$fuente;
    }

    public function get_especie()
    {
        return $this->especie;
    }
    public function set_especie($especie)
    {
        $this->especie=$especie;
    }

    public function get_edad()
    {
        return $this->edad;
    }
    public function set_edad($edad)
    {
        $this->edad=$edad;
    }

    public function get_numarbol()
    {
        return $this->numarbol;
    }
    public function set_numarbol($numarbol)
    {
        $this->numarbol=$numarbol;
    }

    public function get_diametro()
    {
        return $this->diametro;
    }
    public function set_diametro($diametro)
    {
        $this->diametro=$diametro;
    }

    public function get_altura(){
        return $this->altura;
    }
    public function set_altura($altura){
        $this->altura=$altura;
    }
    
    public function get_idsitio(){
        return $this->idsitio;
    }
    public function set_idsitio($idsitio){
        $this->idsitio=$idsitio;
    }

    public function get_fechaplan(){
        return $this->fechaplan;
    }
    public function set_fechaplan($fechaplan){
        $this->fechaplan=$fechaplan;
    }
   public function get_by_idarbol($idarbol='') {
        if($idarbol!= ''):
            $this->query = "select
            idarbol,fuente,especie,edad,numarbol,diametro,altura,idsitio,fechaplan
           from arboles
            where idarbol='$idarbol';";
            $this->get_results_from_query();
        endif;
        if(count($this->rows) == 1):
            foreach ($this->rows[0] as $propiedad=>$valor):
            $this->$propiedad = $valor;
            endforeach;
        endif;
    }
    public function insert(){
        $this->query="insert into arboles
       (idarbol,fuente,especie,edad,numarbol,diametro,altura,idsitio,fechaplan)
       values
       ('$this->idarbol','$this->fuente','$this->especie','$this->edad','$this->numarbol','$this->diametro','$this->altura','$this->idsitio','$this->fechaplan');";
        $this->execute_single_query();
    }
    public function get_datos_arbol($_P)
    {
        $this->fuente=$_P['fuente'];
        $this->especie=$_P['especie'];
        $this->edad=$_P['edad'];
        $this->numarbol=$_P['numarbol'];
        $this->diametro=$_P['diametro'];
        $this->altura=$_P['altura'];
        $this->idsitio=$_P['idsitio'];
        $this->fechaplan=$_P['fechaplan'];
        $this->insert();
    }
    public function form_nuevo_arbol()
    {
        /*ESRIVE PARA COMBO*/   
        $sql ='SELECT idsitio,sitio
                            FROM sitio;';
                            $combo =$this->get_combo_box_all($sql,"sitio","idsitio","idsitio");


    $form="
        
    <div class='row'>
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
        <div class='form-group'>
    <form name='registrar_arbol' 
        action='handler_arboles.php?pag=registrar_arbol'
        method='POST'>
    <fieldset>
    <legend>Registrar Arbol</legend>
    
    <div>
        <label >idarbol</label>
        <input type='text' class='form-control' id='idarbol' name='idarbol'  required autofocus 
        placeholder='ingrese idarbol' /> 
    </div>
    <div>
        <label >Fuente</label>
        <input type='text' class='form-control' id='fuente' name='fuente'  required autofocus 
        placeholder='ingrese Fuente' /> 
    </div>

    <div>
        <label >Especie</label>
        <input type='text' class='form-control' id='especie' name='especie'  required autofocus 
        placeholder='ingrese Especie' /> 
    </div>   

    <div>
        <label >Edad</label>
        <input type='int' class='form-control' id='edad' name='edad'  required autofocus 
        placeholder='ingrese Edad' /> 
    </div>    
    
    <div>
        <label >Num. Arbol</label>
        <input type='int' class='form-control' id='numarbol' name='numarbol'  required autofocus 
        placeholder='ingrese Num. Arbol' /> 
    </div>
    
    <div>
        <label >Diametro</label>
        <input type='int' class='form-control' id='diametro' name='diametro'  required autofocus 
        placeholder='ingrese Diametro' /> 
    </div>

    <div>
        <label >Altura</label>
        <input type='int' class='form-control' id='altura' name='altura'  required autofocus 
        placeholder='ingrese Altura' /> 
    </div>

    <div>
<label for='nombres'>idsitio</label>
         $combo
</div>

    <div>
    <label>Fecha Plan</label>
    <input type='date' class='form-control' id='fechaplan' name='fechaplan'  required autofocus 
    placeholder='Fecha Plan' /> 
    </div>

    <div>
        <br/>
        <input type='submit' class='btn btn-success' name='registrar_arbol' value='registrar_arbol' />
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

        $this->query="update arboles set
           
            fuente='$this->fuente',
            especie='$this->especie',
            edad ='$this->edad',
            numarbol ='$this->numarbol',
            diametro='$this->diametro',
            altura ='$this->altura',  
            idsitio='$this->idsitio',
            fechaplan='$this->fecha_plan'
            where idarbol='$this->idarbol';";
        //echo $this->query;
        $this->execute_single_query();
    }
    public function get_datos_modificar_arbol($_P)
    {
         $this->idarbol=$_P['idarbol'];
        $this->fuente=$_P['fuente'];
        $this->especie=$_P['especie'];
        $this->edad=$_P['edad'];
        $this->numarbol=$_P['numarbol'];
        $this->diametro=$_P['diametro'];
        $this->altura=$_P['altura'];
        $this->idsitio=$_P['idsitio'];
        $this->fecha_plan=$_P['fechaplan'];    
        $this->update();
    }
    public function form_modificar_arbol()
    {
            $sql ='SELECT idsitio,sitio
                            FROM sitio;';
                            $combo =$this->get_combo_box_all($sql,"sitio","idsitio","idsitio");
     $form = "
    <div class='row'>
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
        <div class='form-group'>
    <form name='modificar_arbol' 
        action='handler_arboles.php?pag=modificar_arbol'
        method='POST'>
    <fieldset>
    <legend>Modificar Arbol</legend>
    <div>
        <label for='arbol'>ID. ARBOL</label>
        <input type='text' class='form-control' value='$this->idarbol' id='idarbol' readonly='readonly' name='idarbol'  required autofocus 
        placeholder='ingrese I.D ARBOL' /> 
    </div>
    <div>
        <label for='arbol'>Fuente</label>
        <input type='text' class='form-control' value='$this->fuente' id='fuente' name='fuente'  required autofocus 
        placeholder='ingrese Fuente' /> 
    </div>

    <div>
        <label for='arbol'>Especie</label>
        <input type='text' class='form-control' value='$this->especie' id='especie' name='especie'  required autofocus 
        placeholder='ingrese Especie' /> 
    </div>   

    <div>
        <label for='arbol'>Edad</label>
        <input type='text' class='form-control' value='$this->edad 'id='edad' name='edad'  required autofocus 
        placeholder='ingrese Edad' /> 
    </div>    
    
    <div>
        <label for='arbol'>Num. Arbol</label>
        <input type='text' class='form-control' 
        value='$this->numarbol'id='numarbol' name='numarbol'  required autofocus 
        placeholder='ingrese Num. Arbol' /> 
    </div>
    
    <div>
        <label for='arbol'>Diametro</label>
        <input type='text' class='form-control' 
        value='$this->diametro'id='diametro' name='diametro'  required autofocus 
        placeholder='ingrese Diametro' /> 
    </div>

    <div>
        <label for='arbol'>Altura</label>
        <input type='text' class='form-control' value='$this->altura 'id='altura' name='altura'  required autofocus 
        placeholder='ingrese Altura' /> 
    </div>

    <div>
        <label for='arbol'>idarbol</label>
        $combo
    </div>

    <div>
    <label for='arbol'>Fecha Plan</label>
    <input type='date' class='form-control'
    value='$this->fechaplan' id='fechaplan' name='fechaplan'  required autofocus 
    placeholder='Fecha Plan' /> 
    </div>

    <div>
        <br />
        <input type='submit' class='btn btn-success'
        name='modificar_arbol'
        value='Modificar arbol'
        />
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
 public function get_datos_eliminar_arbol($_P)
    {
        $this->idarbol=$_P['idarbol'];
        $this->delete();
    }
public function form_eliminar_arbol(){
$form = "
        
        <div class='row'>
    
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
            <div class='form-group'>
            <form
                name='eliminar_arbol'
                action='handler_arboles.php?pag=eliminar_arbol'
                method='POST'>
                <fieldset>
                <legend>Eliminar Arbol</legend>
       
        <div>
            <label for='arbolito'>idarbol</label>
                <input type='num'value='$this->idarbol' class='form-control'  id='idarbol' name='idarbol' 
                required autofocus placeholder='Ingrese Fuente'/>
        </div>
        <div><br/></div>
        <div>
            <input type='hidden' name='idarbol' id='idarbol' value='$this->idarbol'/>
            <input type='submit' name='eliminar_arbol' value='Eliminar Arbol' />
        </div>
            </fieldset>
        </form>
        </div>
        </div>
        <div class='col-xs-4 col-md-2'></div>
        </div>";
        echo $form;
    }

public function delete(){
    $this->query="delete from arboles 
    where idarbol='$this->idarbol';
";
$this->execute_single_query();
    } 









public function get_valores(){
        $sql="SELECT u.idarbol,
        u.fuente,
        u.especie,
        u.edad,
        u.numarbol,
        u.diametro,
        u.altura,
        u.fechaplan,
        u.idsitio
              
        FROM arboles u,sitio r
        WHERE u.idsitio=r.idsitio
        ORDER BY fuente;";
     return $this->get_results_from_query2($sql);          
}


    public function get_tabla(){
        $sql="SELECT u.idarbol,
        u.fuente,
        u.especie,
        u.edad,
        u.numarbol,
        u.diametro, 
        u.altura,
        u.fechaplan,
        c.sitio AS idsitio
        FROM arboles u
        INNER JOIN sitio c
        ON(u.idsitio=c.idsitio)
        ORDER BY fuente;";

        
 $cab="
    <h1>Administrador de Arbol</h1>
    <a href='handler_arboles.php?pag=form_nuevo_arbol'
    class='btn btn-success'>
    <span class='glyphicon glyphicon-plus'
     aria-hidden='true'></span> Nuevo Arbol</a>
     <br/>
    <table class='table'>
           <tr>
           <th>I.D arbol</th>
           <th>fuente</th>
           <th>especie</th>
           <th>edad</th>
           <th>numarbol</th>
           <th>diametro</th>
           <th>altura</th>
           <th>idsitio</th>
           <th>fechaplan</th>
           <th></th></tr>
    ";
    $cuerpo="";
    
    $result=$this->get_results_from_query2($sql);
    while ($filas = $result->fetch_assoc()){
            $idarbol=$filas['idarbol'];
            $fuente=$filas['fuente'];
            $especie=$filas['especie'];
            $edad=$filas['edad'];
            $numarbol=$filas['numarbol'];
            $diametro=$filas['diametro'];
            $altura=$filas['altura'];
            $idsitio=$filas['idsitio'];
            $fechaplan=$filas['fechaplan'];
    $cuerpo=$cuerpo."<tr>
  
    <td>$idarbol</td>
    <td>$fuente</td>
    <td>$especie</td>
    <td>$edad</td>
    <td>$numarbol</td>
    <td>$diametro</td>
    <td>$altura</td>
    <td>$idsitio</td>
    <td>$fechaplan</td>
    <td><a class='btn btn-warning'
    href='handler_arboles.php?pag=form_modificar_arbol&idarbol=$idarbol'>
    <span class='glyphicon glyphicon-pencil'
     aria-hidden='true'></span> 
    MODIFICAR</a></td>
    <td><a class='btn btn-danger'
    href='handler_arboles.php?pag=form_eliminar_arbol&idarbol=$idarbol'>
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