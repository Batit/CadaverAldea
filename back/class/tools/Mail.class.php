<?php

/*
Se ha agregado  lo métodos 
_setBody y _setDestination

se han modificado las cabeceras y el contenido de el mensaje 
para que el servidor decida si mandar texo plano (text/plain)
o texto enriquecido (text/html) dependiendo de lo que admita el 
servidor de correo. Aún con esto no se garantiza que el correo vaya 
a spam en bandejas como HOTMAIL. 

*/

require_once ('class/settings/catalogs.class.php');
require_once("site_media/main/template.php");

class Umail {

    private $datas;
    private $headers;
    private $uniqueid;
    private $notifications = array('N1' => 'El e-mail no tiene destinatario',
        'N2' => 'El e-mail no tien asunto',
        'N3' => 'El e-mail no tiene cuerpo',
        'N4' => 'Error al enviar el e-mail',
        'N5' => 'e-mail enviado',
    );

//--------------------------------------------------------------------------------------------------------------------
    public function __construct($mail, $name = false) {
        $this->uniqueid = uniqid('np');
        $this->headers .=  utf8_decode('From: Sistema de gestión de la calidad <support@hightechcoders.com>' . "\r\n");
        $this->headers .= "Reply-To: support@hightechcoders.com \r\n";
        $this->headers .= "MIME-Version: 1.0 \r\n";   
        $this->headers .= "Content-type: text/html; charset=utf-8 \r\n"; 
        $this->headers .= "Cc: kds-077@hotmail.com\r\n"; 
        $this->headers .= "X-Priority: 1 \r\n";   
        $this->headers .= "X-MSMail-Priority: High \r\n";   
        $this->headers .= "X-Mailer: PHP/".phpversion()." \n";  
    }

//--------------------------------------------------------------------------------------------------------------------
    public function setMails(array $datas) {
        $this->datas = $datas;
        foreach ($this->$datas as $key => $value) {
            if ($key != "destination" && $key != "subjet" && $key != "body") {
                $this->headers .= $key . ":" . $value . "\r\n";
                unset($this->$datas[$key]);
            }
        }
    }

//--------------------------------------------------------------------------------------------------------------------
    public function sendMail() {
        if (empty($this->datas['destination'])) {
            return $this->notifications['N1'];
        } else if (empty($this->datas['subject'])) {
            return $this->notifications['N2'];
        } else if (empty($this->datas['body'])) {
            return $this->notifications['N3'];
        } else {
            try {
                $vari = mail($this->datas['destination'], $this->datas['subject'], $this->datas['body'], $this->headers);
                return $this->notifications['N5'];
            } catch (Exception $e) {
                return $this->notifications['N4'] . " " . $e;
            }
        }
    }

//--------------------------------------------------------------------------------------------------------------------
    public function setDestination($destination) {
        $this->datas['destination'] = $destination;
    }
/* de un array de objetos de tipo registros como devuelve la bd con la siguiente estructura 
array(0 => objeto(campo=>valor,campo,valor),
     1 => objeto(campo=>valor,campo,valor)) la función obtiene el atributo email de cada uno de los objetos del array y los coloca 
dentro de destination */
    public function _setDestination($arrUser){
        for ($x = 0; $x < count($arrUser); $x++) {
                if ($x == count($arrUser) - 1) {
                    $mailers .= $arrUser[$x]['email'];
                } else {
                    $mailers .= $arrUser[$x]['email'] . ",";
                }
        }
     $this->datas['destination'] = $mailers;            
    return $mailers;            
    }
//--------------------------------------------------------------------------------------------------------------------
    public function setSubject($subject) {
        $this->datas['subject'] = $subject;
    }

//--------------------------------------------------------------------------------------------------------------------
    public function setBody($body) {
        $message .= "\r\n\r\n--" . $this->uniqueid. "\r\n";
        $message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
        $message .= $body;
 
        $message .= "\r\n\r\n--" . $this->uniqueid. "\r\n";
        $message .= "Content-type: text/html;charset=utf-8\r\n\r\n";
        $message .= $body;
 
        $message .= "\r\n\r\n--" . $this->uniqueid. "--";
        //$this->datas['body'] = $message;
        $this->datas['body'] = $body;
    }
    /*
        Esta función tiene como finalidad reemplazar datos en una plantilla, 
        la cual es leida como una cadena de string; por ejemplo se puede definir 
        la estructura de un correo en algún archivo .txt (se recomienda usar cualquier otra extensión 
        como tmp o tmpl o mtmpl y que estas esten alojadas dentro de la sección de vistas ) y sustituir únicamente las variables necesarias para poder mostrar, como ejemplo
        los datos particulares de una propuesta de cambio.
        Con ello se evita colocar el texto sobre las clases del sistema y se da pauta para que 
        estas plantillas en algún momento puedan ser editadas y personalizadas por herramientas desarrolladas
        con este fin, logrando con ello que el usuario adapte estos correos de notificación a sus necesidades  
    */    
    public function _setBody($template,$replaceMat){
        $objTemp = new template("mail", $template, $replaceMat);
        $message .= "\r\n\r\n--" . $this->uniqueid. "\r\n";
        $message .= "Content-Type: text/html; charset=utf-8\r\n";
        $message .= $objTemp->getTemplate();
        $this->datas['body'] = $message;   
    }    

}