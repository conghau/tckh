<?php

class cMCrypter extends cMCrypterAES {

    protected static $use_key = 'application.key';

    public static function get_session_key() {
        return strlen(Session::getId()) > 32 ? substr(Session::getId(),0,32) : str_pad(Session::getId(),32,'0');
    }
    /**
     * Encrypt a string using Mcrypt.
     *
     * The string will be encrypted using the AES-256 scheme and will be base64_safe encoded.
     *
     * @param string  $value
     * @param string  $use_key
     * @return string
     */
    public static function encrypt($value, $use_key = 'application.key')
    {
        static::$use_key = $use_key;
        return parent::encrypt($value);
    }

    /**
     * Decrypt a string using Mcrypt.
     *
     * @param string $value
     * @param string $use_key
     * @return string
     */
    public static function decrypt($value, $use_key = 'application.key')
    {
        static::$use_key = $use_key;
        return parent::decrypt($value);
    }

    /**
     * Get the encryption key
     *
     * @return string
     */
    protected static function key()
    {
        return static::$use_key;
    }
}
