<?
require_once("Sesiones.class.php");
include ("handlers/xajax/handlerfunctions.xajax.php");
$xajax->printJavascript("handlers/xajax/");

if(isset($_SESSION['textCap']) && 
   isset($_SESSION['nameUser']) && 
   isset($_SESSION['start']) && 
         $_SESSION['textCap']!="" && 
         $_SESSION['nameUser']!="" && 
         $_SESSION['start']!="")
	{
	$txtCapt = $_SESSION['textCap'];
	$sessionesObje=new Sessiones($txtCapt);
	try
	  {		
		 if($sessionesObje->autenticateSession($_SESSION['nameUser'],$txtCapt))
            		{
			$x = new Cypher();
			echo "===========>".$x->generateText(10)."<============";
               		echo "SESIONES: ".print_r($_SESSION,true)."<br></br>";
			echo "COOKIES: ".print_r($_COOKIE,true)."<br></br>";
			echo "SERVER: ".print_r($_SERVER,true)."<br></br>";
			echo "GET: ".print_r($_GET,true)."<br></br>";
			echo "session correcta"."<br></br><a href=#  onclick=xajax_destroySession() >cerrar session</>";
            		}
		else	{
			 header("Location: http://".$_SERVER["HTTP_HOST"]."".rtrim(dirname($_SERVER["PHP_SELF"]), "/\\")."/Sessionhandler.handler.php");
			}
	  }
	catch(Exception $e)
	  {
		echo "error ".$e."<br>";			
	  }
}

?>
