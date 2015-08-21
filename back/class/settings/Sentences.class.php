<?php

/*
  this class make the basic sentences for to execute and be use in
  father class
 */
require_once("FilterSqlSentences.class.php");

class Sentences {

    private static $filter;
    private static $sentence;
    public static $form = array();
//--------------------------------------------------------------------------
    public static function getInsertSentence($form, $table) {
        $fields = "";
        $values = "";
        $count = 0;
        $subSentence = "";
        self::$sentence = "";
        foreach ($form as $nameField => $valueField) {
            if ($valueField == "Enabled" || $valueField == "ENABLED") {
                $valueField = "1";
            } else if ($valueField == "Disabled" || $valueField == "DISABLED") {
                $valueField = "0";
            }
            if ($count == (count($form) - 1)) {
                $fields.="`" . FilterSqlSentences::getCharFilter($nameField) . "`";
                if ($nameField == "password" or $nameField == "signature") {
                    $values.="'" . md5(FilterSqlSentences::getCharFilter($valueField)) . "'";
                } else {
                    $values.="'" . (FilterSqlSentences::getCharFilter($valueField)) . "'";
                }
            } else {
                $fields.="`" . FilterSqlSentences::getCharFilter($nameField) . "`,";
                if ($nameField == "password" or $nameField == "signature") {
                    $values.="'" . md5(FilterSqlSentences::getCharFilter($valueField)) . "',";
                } else {
                    $values.="'" . (FilterSqlSentences::getCharFilter($valueField)) . "',";
                }
            }
            $count++;
        }
        self::$sentence = "INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $values . ")";
        return self::$sentence;
    }

//--------------------------------------------------------------------------
    public static function getInsertSentenceWfilter($form, $table) {
        $fields = "";
        $values = "";
        $count = 0;
        $subSentence = "";
        self::$sentence = "";
        foreach ($form as $nameField => $valueField) {
            if ($valueField == "Enabled") {
                $valueField = "1";
            } else if ($valueField == "Disabled") {
                $valueField = "0";
            }
            if ($count == (count($form) - 1)) {
                $fields.="`" . FilterSqlSentences::getCharFilter($nameField) . "`";
                $values.="'" . $valueField . "'";
            } else {
                $fields.="`" . FilterSqlSentences::getCharFilter($nameField) . "` ,";
                $values.="'" . $valueField . "',";
            }
            $count++;
        }
        self::$sentence = "INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $values . ")";
        //self::$sentence=print_r($form,true);
        return self::$sentence;
    }

//--------------------------------------------------------------------------
    public static function _getInsertSentence($table) {
        $fields = "";
        $values = "";
        $count = 0;
        $subSentence = "";
        self::$sentence = "";
        foreach (self::$form as $nameField => $valueField) {
            if ($valueField == "Enabled") {
                $valueField = "1";
            } else if ($valueField == "Disabled") {
                $valueField = "0";
            }
            if ($count == (count(self::$form) - 1)) {
                $fields.="`" . FilterSqlSentences::getCharFilter($nameField) . "`";
                $values.="'" . FilterSqlSentences::getCharFilter($valueField) . "'";
            } else {
                $fields.="`" . FilterSqlSentences::getCharFilter($nameField) . "` ,";
                $values.="'" . FilterSqlSentences::getCharFilter($valueField) . "',";
            }
            $count++;
        }
        self::$sentence = "INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $values . ")";
        //self::$sentence=print_r($form,true);
        return self::$sentence;
    }

//---------------------------------------------------------------------------------------------------------------------------------------------------
    public static function getUpdateSentence($form, $table, $filter) {
        $query = "";
        $count = 0;
        self::$sentence = "";
        foreach ($form as $nameField => $valueField) {
            if ($valueField == "Enabled" || $valueField == "ENABLED") {
                $valueField = "1";
            } else if ($valueField == "Disabled" || $valueField == "DISABLED") {
                $valueField = "0";
            }
            if ($count == (count($form) - 1)) {
                if ($nameField == "password" or $nameField == "signature") {
                    $query.="`" . FilterSqlSentences::getCharFilter($nameField) . "` = '" . md5(FilterSqlSentences::getCharFilter($valueField)) . "'";
                } else {
                    $query.="`" . FilterSqlSentences::getCharFilter($nameField) . "` = '" . FilterSqlSentences::getCharFilter($valueField) . "'";
                }
            } else {
                if ($nameField == "password" or $nameField == "signature") {
                    $query.="`" . FilterSqlSentences::getCharFilter($nameField) . "` = '" . md5(FilterSqlSentences::getCharFilter($valueField)) . "',";
                } else {
                    $query.="`" . FilterSqlSentences::getCharFilter($nameField) . "` = '" . FilterSqlSentences::getCharFilter($valueField) . "',";
                }
            }
            $count++;
        }
        if (is_array($filter)) {
            $filter = self::getFilterAnd($filter);
        }
        self::$sentence = "UPDATE " . $table . " SET " . $query . $filter;
        return self::$sentence;
    }

//---------------------------------------------------------------------------------------------------------------------------------------------------
    public static function getUpdateWSentence($form, $table, $filter) {
        $query = "";
        $count = 0;
        self::$sentence = "";
        foreach ($form as $nameField => $valueField) {
            if ($count == (count($form) - 1)) {
                $query.="`" . FilterSqlSentences::getCharFilter($nameField) . "` = '" . FilterSqlSentences::getCharFilter($valueField) . "'";
            } else {
                $query.="`" . FilterSqlSentences::getCharFilter($nameField) . "` = '" . FilterSqlSentences::getCharFilter($valueField) . "',";
            }
            $count++;
        }
        self::$sentence = "UPDATE " . $table . " SET " . $query . $filter;
        return self::$sentence;
    }

//---------------------------------------------------------------------------------------------------------------------------------------------------
    public static function _getDeleteSentence($table, $filter) {
        self::$sentence = "DELETE FROM " . $table . " " . self::getFilterAnd($filter);
        return self::$sentence;
    }

    public static function getDeleteSentence($table) {
        self::$sentence = "DELETE  FROM " . $table;
        return self::$sentence;
    }

//--------------------------------------------------------------------------
    public static function getFilterAnd($filter) {
        self::$sentence = "";
        self::$filter = " WHERE ";
        $nameField = "";
        $valueField = "";
        $count = 0;
        foreach ($filter as $nameField => $valueField) {
            if ($count == (count($filter) - 1)) {
                self::$filter.=$nameField . "=";
                self::$filter.="'" . $valueField . "'";
            } else {
                self::$filter.=$nameField . "=";
                self::$filter.="'" . $valueField . "' AND ";
            }
            $count++;
        }

        return self::$filter;
    }

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function getFilterOr($filter) {
        self::$sentence = "";
        self::$filter = " WHERE ";
        $nameField = "";
        $valueField = "";
        $count = 0;
        foreach ($filter as $nameField => $valueField) {
            if ($count == (count($filter) - 1)) {
                self::$filter.=$nameField . "=";
                self::$filter.="'" . $valueField . "'";
            } else {
                self::$filter.=$nameField . "=";
                self::$filter.="'" . $valueField . "' OR ";
            }
            $count++;
        }

        return self::$filter;
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function getSentenceGral() {
        return self::$sentence;
    }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function getSentenceSelect($tabla, $values) {
        self::$sentence = "SELECT " . $values . "FROM " . $tabla;
        return self::$sentence;
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function _getSentenceSelect($tabla, $values, $filter) {
        self::$sentence = "";
        self::$sentence = "SELECT " . $values . " FROM " . $tabla . " " . self::getFilterAnd($filter);
        return self::$sentence;
    }

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public static function _getSentenceSelectOr($tabla, $values, $filter) {
        self::$sentence = "";
        self::$sentence = "SELECT " . $values . " FROM " . $tabla . " " . self::getFilterOr($filter);
        return self::$sentence;
    }

}

?>
