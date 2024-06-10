<?php


namespace App\Utils;

use Normalizer;

abstract class Formater {

    public static function kebab($str) {
        return self::removeAccents(strtolower(str_replace(' ', '-', $str)));
    }

    public static function removeAccents($str) {
        $normalized = Normalizer::normalize($str, Normalizer::FORM_KD);
        $cleaned = preg_replace('/\p{Mn}/u', '', $normalized);
        return $cleaned;
    }

}