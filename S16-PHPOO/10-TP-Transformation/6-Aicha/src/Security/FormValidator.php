<?php namespace Security;

class FormValidator {

    public static function isEmpty(string $value)
    {
        return empty($value);
    }

    public static function isEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function pseudoTooShort(string $pseudo)
    {
        return iconv_strlen($pseudo) < 3;
    }

    public static function pseudoTooLong(string $pseudo)
    {
        return iconv_strlen($pseudo) > 20;
    }

    public static function pswdTooShort(string $pswd)
    {
        return iconv_strlen($pswd) < 6;
    }

    public static function pswdEqual(string $pswd1, string $pswd2)
    {
        return $pswd1 == $pswd2;
    }

}

?>