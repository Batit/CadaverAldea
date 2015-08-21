<?php

/*
  This class defines the database connections
 */

require_once("Connectionvars.class.php");

class MySqlModel extends Connectionvars {

    private $mysqlData;
    private $mysqlTable;
    protected $mysqlConn;
    private $rows;

//make conecction to database --------------------------------------------------------------------------

    public function connect() {
        try {
            $this->mysqlConn = new mysqli($this->server, $this->user, $this->password, $this->database);
            $this->mysqlConn->query("SET NAMES 'utf8'");
        } catch (Exception $e) {
            //echo $this->mysqlConn->error." ".$e;
        }
    }

//excecute all sentences SQL --------------------------------------------------------------------------
    public function excecute($sentence) {
	//echo $sentence;
        $success = false;
        try {
            $success = $this->mysqlConn->query($sentence);
            $success = $this->mysqlConn->errno; 
        } catch (Exception $e) {
            $success = $this->mysqlConn->error . " " . $e;
        }
        return $success;
    }
//----------------------------------------------------------------------------------------------------------------------------------------------
       public function _excecute($sentence) {
	    //echo $sentence;
        $success = false;
        try {
            $success = $this->mysqlConn->query($sentence);
            $success = $this->mysqlConn->insert_id; 
        } catch (Exception $e) {
            $success = $this->mysqlConn->error . " " . $e;
        }
        return $success;
    }
    //---------------------------------------------------------------------------------------------------------------
    public function excecuteSelect($sentence) {
	//echo $sentence;
        $result = "";
        $rows = array();
        try {
            $result = $this->mysqlConn->query($sentence);
            if (!is_null($result)) {
                while ($rows[] = $result->fetch_assoc());
            }
            return $rows;
        } catch (Exception $e) {
            echo $this->mysqlConn->error . " " . $e;
        }
    }

// this method is to get the number rows from same table--------------------------------------------------------------------------
    public function getNumberRows($query) {
        $result = $this->mysqlConn->query($query);
        $numeroFilas = $result->num_rows;
        return $numeroFilas;
    }

//change database --------------------------------------------------------------------------------------
    private function changeDataBase($dbname) {
        try {
            $this->mysqlConn->select_db($dbname);
        } catch (Exception $e) {
            echo $this->mysqlConn->error . " " . $e;
        }
    }

// disconect--------------------------------------------------------------------------

    function disconnect() {
        try {
            $this->mysqlConn->close();
        } catch (Exception $e) {
            echo $this->mysqlConn->error . " " . $e;
        }
    }

//close result and clean array-----------------------------------------------------------------------------------------------------
    function closeResult($result) {
        $result->close();
        array_pop($this->rows);
    }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function restore( $file ){
                $database = $this->database;
                $user = $this->user;
                $password = $this->password;
                //$path = "C:\AppServ\MySQL\bin\mysql.exe -u $user -p$password siah < ".$file;

                $output=shell_exec($path); // ejemplo windows
                $output=shell_exec("/usr/bin/mysqldump -u $user -p$password ".$database); // ejemplo linux
                        if( trim( $output ) != NULL ){
                          return 0;
                        }else{
                          return 1;
                        }
            }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function backUp(){
                $database = $this->database;
                $user = $this->user;
                $password = $this->password;
                //$output=shell_exec("C:\AppServ\MySQL\bin\mysqldump.exe -u root -p123 ".$database); // ejemplo windows
                $output=shell_exec("/usr/bin/mysqldump -u $user -p$password ".$database); // ejemplo linux
                        if( trim( $output ) == NULL ){
                            return 0;
                        }
                $currentTime = time();
                $date = date( 'Y-m-d', $currentTime );
                $file = "Respaldo Base de Datos SGC ".$date.".sql";
		$control = fopen( "backups/".$file , "w+" );		
		fwrite( $control,$output);
                fclose( $control );
		return $file;	
            }

}

?>
