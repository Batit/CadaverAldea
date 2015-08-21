<?php

/*
  this class erase all provides characters and to avoid sql imjection
 */

class FilterSqlSentences {

    private static $sentence;

//--------------------------------------------------------------------------
    public static function getCharFilter($word) {
        self::$sentence = ((($word)));
        return self::$sentence;
    }

}

?>
