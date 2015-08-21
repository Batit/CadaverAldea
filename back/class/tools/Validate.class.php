<?php

class Validate {

    private static $elemProcNeed = array('code', 'elaborated', 'check', 'permission');

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function valEmptyForm($form) {
        $emptyForm = false;
        foreach ($form as $key => $value) {
            if ((empty($value) || $value == null || $value == "" || $value == "--Seleccionar--") && $key != "address") {
                $emptyForm = true;
                break;
            }
        }
        return $emptyForm;
    }

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function valFormProc($form) {
        foreach ($form as $key => $value) {
            if (array_key_exists($key, $elemProcNeed)) {
                return true;
            } else {
                break;
                return false;
            }
        }
    }

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function valCode($code) {
        foreach ($form as $key => $value) {
            if (array_key_exists($key, $elemProcNeed)) {
                return true;
            } else {
                break;
                return false;
            }
        }
    }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public static function valEmail($email) {

        $exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";

        if (eregi($exp, $email)) {

            if (checkdnsrr(array_pop(explode("@", $email)), "MX")) {
                return true;
            } else {
                return false;
            }
        } else {

            return false;
        }
    }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function getDateFormat($date) {
        $today = $date;
        $date = strftime('%d-%B-%Y', strtotime($today));
        $english = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $español = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $fecha = str_replace($english, $español, $date);
        $fechaS = explode('-', $fecha);
        $fechaF = "" . $fechaS[0] . " de " . $fechaS[1] . " de " . $fechaS[2] . "";
        return $fechaF;
    }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     public static function getWithOutChars($str){
	$specialChars = array(
        '&aacute;' => "á",
        '&Aacute;' => "Á",
        '&eacute;' => "é",
        '&Eacute;' => "É",
        '&iacute;' => "í",
        '&Iacute;' => "Í",
        '&oacute;' => "ó",
        '&Oacute;' => "Ó",
        '&uacute;' => "ú",
        '&Uacute;' => "Ú",
        '&Ntilde;' => "Ñ",
        '&ntilde;' => "ñ");
		foreach ( $specialChars as $key => $value) {
					$str = str_replace($key,$value,$str);	
			}
	return $str;
	}
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     public static function getInvChars($str){
	$specialChars = array(
        'á' => "&aacute;",
        'Á' => "&Aacute;",
        'é' => "&eacute;",
        'É' => "&Eacute;",
        'í' => "&iacute;",
        'Í' => "&Iacute;",
        'ó' => "&oacute;",
        'Ó' => "&Oacute;",
        'ú' => "&uacute;",
        'Ú' => "&Uacute;",
        'Ñ' => "&Ntilde;",
        'ñ' => "&ntilde;");
		foreach ( $specialChars as $key => $value) {
					$str = str_replace($key,$value,$str);	
			}
	return $str;
	}
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     public static function getCharWithOutTildes($str){
	$specialChars = array(
        'á' => "a",
        'Á' => "A",
        'é' => "e",
        'É' => "E",
        'í' => "i",
        'Í' => "I",
        'ó' => "o",
        'Ó' => "O",
        'ú' => "u",
        'Ú' => "U",
        'Ñ' => "N",
        'ñ' => "n");
		foreach ( $specialChars as $key => $value) {
					$str = str_replace($value,$key,$str);
			}
	return $str;
	}
public static function _getDateFormat($date) {
        $today = $date;
        $date = strftime('%d-%B-%Y', strtotime($today));
        $english = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $español = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'october', 'noviembre', 'diciembre');
        $fecha = str_replace($english, $español, $date);
        return $fecha;
    }

public static function getCharFilter($word)
		{
			$sentence = utf8_decode((trim(chop(addslashes(stripslashes(strip_tags(htmlentities(htmlspecialchars($word)))))))));
		return $sentence;
		}
}
