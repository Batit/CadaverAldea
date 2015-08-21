<?php

class Errors
{
private static $error="";
private static $ArrayErrors = array('Error 1'=>'Error to try connect to server',
                                    'Error 2'=>'Error of server',
                                    'Error 3'=>'Error to execute the sencence',
                                    'Error 4'=>'Error to disconect',
                                    'Error 5'=>'Error to select database',
                                    'Error 6'=>'Error in the operation',
                                    'Error 7'=>'is empty',
			         );

public static function getError($error)
    {
        self::$error=self::$ArrayErrors[$error];
        return self::$error;
    }


}
?>