<?php
/*
 *
 *
 */
require_once ('cypher.class.php');
require_once ('class/usuarios/User.class.php');
require_once ('class/settings/MySqlModel.class.php');
class Sessiones
{
private $host="localhost";
private $url="SistemaGestionCalidad/";
private $page="documentos/home.php";
private $session;
private $userName;
private $serverKey;
private $clientKey;
private $conn;
private $idSession;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function __construct($idSession)
    {
    $this->idSession = $idSession;	
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------
function beginSession($name,$session)
   {
   ini_set("session.use_cookies", 1);
   ini_set("session.use_only_cookies", 1);
   /*//session_name("sesionD");
   session_start();	*/
   $this->host=$_SERVER["HTTP_HOST"];
   $this->url=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
   $this->conn = new MySqlModel();
   $_SESSION['start']=false; 
   //$this->setNameSession($name);
   $this->session = $session;
   $this->userName = $name;
   }
//--------------------------------------------------------------------------------------------------------------------------------------------------
private function setNameSession($name)
    {
    session_name($name);
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
function isSessionStart($session)
    {
    $isSession=false;
    if(isset($_SESSION[$session]))
        {
        $isSession=true;
        }
    else
        {
        $_SESSION = array();
        //A continuación eliminamos la cookie del navegador
        if (ini_get("session.use_cookies"))
            {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
            );
         }
        }
    return $isSession;
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function sessionStart()
    {
    //session_start();
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function sessionDestroy()
    {	
     $params = session_get_cookie_params();
     setcookie(session_name(), '', time() - 42000,
     $params["path"], $params["domain"],
     $params["secure"], $params["httponly"]
     );	
     session_regenerate_id(true);	
     session_destroy();
     //header("Location: http://".$this->host."/".$this->url."/".$this->page);
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function cypherSession()
    {

    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function decypherSession()
    {

    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function autenticateSession($userName,$sessionName)
    {
//	print_r($_SESSION);
     if((isset($_SESSION['start']) && $_SESSION['start']!=""))
        {
	$key=$_SESSION[$userName].$_COOKIE[$sessionName];	
        $cypher= new Cypher();
        $cypherObj = $cypher->cypherOpen("", "");
        $descifrado=$cypher->descypher($cypherObj,$key,$_SESSION['vector'],$_SESSION['start']);
	if($descifrado == $this->getIdSession())
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }

    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function login($user,$pass,$cypher,$vector)
    {
    //session_regenerate_id(true);	
    $authorized = false;        
	$userObj = new User("root",$user);
        $data=$userObj->isUser($pass);
	if( $data != false && $data !="" )
            {
                $_SESSION['start'] = $cypher;
		$_SESSION['vector'] = $vector;
		$_SESSION['nameUser'] = $user;
		$_SESSION['idUser'] = $data;
		$authorized = true;
            }
	
	return $authorized;
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function setUrl($url)
    {
    $this->url   = $url;
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function setPage($page)
    {
    $this->page  = $page;
     }
//---------------------------------------------------------------------------------------------------------------------------------------------------------
function setHost($host)
    {
    $this->host  =$host;
    }
//genera llaves compratidas aleatoriamente---------------------------------------------------------------------------------------------------------------------------------------------------------
function sessionShareKeyStart($cypher)
    {
    //session_regenerate_id(true);
    $cypher->generateSharingKey();
    setcookie($this->session, $cypher->getClienteKey(),time()+80065,  dirname($_SERVER["PHP_SELF"]));
    $_SESSION[$this->userName]=$cypher->getServerKey();
       }
function getIdSession()
    {
    return $this->idSession;
    }
}
?>
