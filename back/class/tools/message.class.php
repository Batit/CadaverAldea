<?php
class Message
{
const SAVE   = '1';
const UPDATE = '2';
const DELETE = '3';
const PUBLICATE = '7';

private static $message="";
private static $ArrayMessages = array(
                                    '1'=>'Guardado exitosamente',
                                    '2'=>'Actualizado exitosamente',
                                    '3'=>'borrado exitosamente',
                                    '4'=>'Error to disconect',
                                    '5'=>'Error to select database',
                                    '6'=>'Error in the operation',
                                    '7'=>'La propuesta ha sido enviada correctamente',
			         );
//-------------------------------------------------------------------------------------------------------------------
public static function getMessage($type)
    {
    self::$message=self::$ArrayMessages[$type];
    return self::$message;
    }

    
}

?>
