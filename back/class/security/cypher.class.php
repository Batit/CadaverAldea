<?php
/*
 * this class use the lybrary mycrip by php 
 * for to encrypt any important data 
 */
require_once('class/settings/FilterSqlSentences.class.php');
class Cypher {
    private $key;
    private $method = MCRYPT_DES;
    private $mode = MCRYPT_MODE_CBC;
    private $arrayBeginWeight;
    private $arrayBegin;
    private $maxSizeKey;
    private $cypher;
    private $keyBasic;
    private $serverKey;
    private $text;
    private $clientKey;
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function __construct() {
        
    }
//convert code to binary-------------------------------------------------------------------------------------------------------------------------------
    function toBinary($code) {
        $cypher = "";
        $cypher = base64_decode($code);
        return $cypher;
    }
//this method use the algoritm DES for to encrypt-----------------------------------------------------------------------------------------------------
    function cypherOpen($dir, $nodos) {
        $this->cypher = mcrypt_module_open($this->method, $dir, $this->mode, $nodos);
        return $this->cypher;
    }
//this method return the maximun size of vector of begin--------------------------------------------------------------------------------------------
    function getBeginArray($cypher) {
        $this->arrayBeginWeight = mcrypt_enc_get_iv_size($cypher);
        $beginArray = mcrypt_create_iv($this->arrayBeginWeight, MCRYPT_RAND);
        return base64_encode($beginArray);
    }
//get the key-------------------------------------------------------------------------------------------------------------------------------------------
    function getKey() {
        $keyCypher = "";
        $keymd5 = md5($this->key);
        $this->maxSizeKey = mcrypt_enc_get_key_size($this->cypher);
        $keyCypher = substr($keymd5, 0, $this->maxSizeKey);
        return $newKey;
    }
//------------------------------------------------------------------------------------------------------------------------------------------------
    function cypher($cypher, $key, $beginArray, $data) {
        mcrypt_generic_init($cypher, $key, base64_decode($beginArray));
        $dataCypher = mcrypt_generic($cypher, $data);
        mcrypt_generic_deinit($cypher);
        mcrypt_module_close($cypher);
        return base64_encode($dataCypher);
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------
    function desCypher($cypher, $key, $beginArray, $data) {
        mcrypt_generic_init($cypher, $key, base64_decode($beginArray));
        $newDate = mdecrypt_generic($cypher, base64_decode($data));
        mcrypt_generic_deinit($cypher);
        mcrypt_module_close($cypher);
        return rtrim($newDate, "\0");
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------
    function generateSharingKey() {
        $this->keyBasic = md5(uniqid(rand(), true));
        $maxSizeKey = mcrypt_enc_get_key_size($this->cypherOpen("", ""));
        $this->keyBasic = substr($this->keyBasic, 0, $maxSizeKey);
        $size = strlen($this->keyBasic);
        $this->serverKey = substr($this->keyBasic, 0, ($size / 2));
        $this->clientKey = substr($this->keyBasic, ($size / 2), $size);
        $this->setKey($this->serverKey . $this->clientKey);
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------
    function getClienteKey() {
        return $this->clientKey;
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------
    function getServerKey() {
        return $this->serverKey;
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------
    private function setKey($key) {
        $this->key = $key;
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------
    function getKeySharing() {
        return $this->key;
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function generateText($length) {
        $this->text = md5(microtime() * mktime());
        $this->text .= rand(0, strlen($this->text));
        return substr($this->text, rand(0, strlen($this->text)), $length);
    }
}
?>
