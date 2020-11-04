<?php

class StringHelper
{
    /**
     * @param $string
     *
     * @return mixed
     */
    public static function number_to_en( $string )
    {
        $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];
        $arabic  = [ '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];

        $num                  = range( 0, 9 );
        $convertedPersianNums = str_replace( $persian, $num, $string );
        $englishNumbersOnly   = str_replace( $arabic, $num, $convertedPersianNums );

        return $englishNumbersOnly;
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    public static function number_to_fa( $string )
    {
        $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];

        $num                  = range( 0, 9 );
        $englishNumbersOnly = str_replace( $num, $persian, $string );

        return $englishNumbersOnly;
    }
}