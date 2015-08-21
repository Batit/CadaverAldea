<?php
error_reporting(E_ALL);
ini_set("display_errors",1); 
//require_once ('class/tools/processes.class.php');
ini_set('max_execution_time', 1200);//the time of the script increases to 15 minutes
ini_set('max_input_time','1000');//increases the size of the file uploaded
ini_set('post_max_size','100M');//increases the size of the file uploaded
ini_set('memory_limit','100M');//increases the size of the file uploaded
ini_set('upload_max_filesize','100M');//increases the size of the file uploaded

class uploadFiles {

    private $allowed = array(
        'EXT1' => 'application/msword',
        'EXT2' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'EXT3' => 'application/vnd.ms-excel',
        'EXT4' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'EXT5' => 'image/png',
        'EXT6' => 'image/jpeg',
        'EXT7' => 'odt',
        'EXT8' => 'application/pdf',
        'EXT9' => 'pdf',
        'EXT10' => 'vnd.openxmlformats-officedocument.wordprocessingml.document',
        'EXT11' => 'jpeg',
        'EXT12' => 'png',
        'EXT13' => 'msword',
        'EXT14' => 'pdf',
        'EXT15' => 'ms-excel',
        'EXT16' => 'xls',
        'EXT17' => 'vnd.ms-excel',
        'EXT18' => 'vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'EXT19' => 'octet-stream',
    );
    private $carpeta = "";
    private $directorio;

//construct--------------------------------------------------------------------------------------------------------------------------------------------------------
    function __construct($carpeta) {
        $this->carpeta = $carpeta;
        $this->directorio = getcwd()."../../../".$this->carpeta;
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------
    function upLoadFiles($files) {
        if (!is_array($files) || $files == "" || $files == null) {
            echo "No existe archivo que subir";
        } else {
            $nombre = basename($files['userfile']['name']);
            $tipoArchivo = basename($files['userfile']['type']);
            $tamano = basename($files['userfile']['size']);
            $messajes = false;
            if (!array_key_exists(array_search($tipoArchivo, $this->allowed), $this->allowed)) {
                echo "<p>La extensi&oacute;n " . $tipoArchivo . " o el tama&ntilde;o " . $tamano . " de los archivos no es correcta.";
            } else {
                if (!is_dir($this->directorio)) {
                    mkdir($this->directorio, 0777);
                }
                $up = move_uploaded_file($files['userfile']['tmp_name'], $this->directorio . $nombre);
                if ($up) {
                    $messajes = $nombre;
                }$files = null;
                return $messajes;
            }
        }
    }
    
    function _upLoadFiles($files) {
        $this->directorio = getcwd().$this->carpeta;
        if (!is_array($files) || $files == "" || $files == null) {
            echo "No existe archivo que subir";
        } else {
            $nombre = basename($files['userfile']['name']);
            $tipoArchivo = basename($files['userfile']['type']);
            $tamano = basename($files['userfile']['size']);
            $messajes = false;
            if (!array_key_exists(array_search($tipoArchivo, $this->allowed), $this->allowed)) {
                echo "<p>La extensi&oacute;n " . $tipoArchivo . " o el tama&ntilde;o " . $tamano . " de los archivos no es correcta.";
            } else {
                if (!is_dir($this->directorio)) {
                    mkdir($this->directorio, 777,true);
                }
               chmod($this->carpeta, 777);
                $up = move_uploaded_file($files['userfile']['tmp_name'], $this->carpeta . $nombre);
                if ($up) {
                    $messajes = $nombre;
                }$files = null;
                return $messajes;
            }
        }
    }

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function getDirectorio($directorio) {
        $dir = opendir($directorio);
        $arrDir = array();
        while ($elemento = readdir($dir)) {
            array_push($arrDir, $elemento);
        }
        closedir($dir);
        return $arrDir;
    }

//-------------------------------------------------------------------------------------------------------------------------------------------------------
    function showImg($dir) {
        $processes = new processes();
        $messajes = '<img id="photo"   src=' . $dir . ' USEMAP="#map0">
                <p style="font-size: 110%; font-weight: bold; padding-left: 0.1em;">
    </p>
    <div class="frame" style="margin: 0 1em; width: 100px; height: 100px;">
      <div id="preview" style="width: 100px; height: 100px; overflow: hidden;">
        
      </div>
    </div>
      <form id="setLink" name="setLink" >
    <table style="margin-top: 1em;">
      <thead>
        <tr>
          <th colspan="2" style="font-size: 110%; font-weight: bold; text-align: left; padding-left: 0.1em;">
            Coordinates
          </th>

              <a onclick=showDiv("procesos+") style="cursor:pointer;color:blue">Mostrar todos los documentos</a>
              <div id="procesos" style="display:none">' . $processes->getMenu(" ") . '</div>
              <br>
              Requisito que deseas referenciar:<input type="text" name="requisito" id="requisito"/>
              <br>
              <a onclick=showDiv("documentos+") style="cursor:pointer;color:blue">Mostrar todos los documentos</a>
              <div id="documentos" style="display:none" >asdsdas</div>
          <th colspan="2" style="font-size: 110%; font-weight: bold; text-align: left; padding-left: 0.1em;">
            Dimensions
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 10%;"><b>X<sub>1</sub>:</b></td>
 		      <td style="width: 30%;"><input id="x1" value="133" name="x1" type="text"></td>
 		      <td style="width: 20%;"><b>Width:</b></td>
   		    <td><input value="51" id="w" name="w" type="text"></td>
        </tr>
        <tr>
          <td><b>Y<sub>1</sub>:</b></td>
          <td><input  value="41"  name="y1" id="y1" type="text"></td>
          <td><b>Height:</b></td>
          <td><input id="h" value="51"  name="h" type="text"></td>
        </tr>
        <tr>
          <td><b>X<sub>2</sub>:</b></td>
          <td><input id="x2" value="184" name="x2" type="text"></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><b>Y<sub>2</sub>:</b></td>
          <td><input id="y2" value="92"  name="y2"  type="text">
          </td>
          <td></td>
        </tr>
      </tbody>
    </table>
    Descripci&oacute;n
   <textarea name ="descripcion" id="descripcion"></textarea>
   <br>
   <td><input type="button" onclick=xajax_getFormImages(xajax.getFormValues(setLink),"' . $dir . '") value="Enviar" /></td>

    </form>';
        return $messajes;
    }

    function uploadAndShow($files) {
        $dir = $this->uploadImages($files, false);
        return $this->showImg($dir);
    }

}

?>
