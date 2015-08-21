<?php
/*
 *
 *
 */
//require_once ('Cypher.class.php');
session_start();
class Captcha
{
private $text;
//construct---------------------------------------------------------------------------------------------------------------------
function  __construct()
    {
        
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------    
function generateText($length)
    {
    $this->text=md5(microtime() * mktime());
    return substr($this->text,0,$length);
    }
function getImage()
	{
	$text =  $this->generateText(10);
	$_SESSION['textCap']=md5($text);
        $captcha = imagecreatefromgif("captcha.gif");
	$colText = imagecolorallocate($captcha, rand(0,300),rand(0,100),rand(0,50));
	for($x=0;$x<=77;$x=$x+5)
		{
			imageline($captcha,rand(0,100000),rand(0,100),rand(10,1000),rand(0,100),$colText);
		}
        //imagestring($captcha,10, 50, 15,$text, $colText);
        return imagegif($captcha);
		}
}
$capt= new Captcha();
//header("Content-type: image/gif");
$capt->getImage();

