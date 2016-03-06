<?php

class cMCrypterAES
{
    public static $cipher = MCRYPT_RIJNDAEL_256;

    public static $mode = MCRYPT_MODE_CBC;

    public static $block = 32;

    public static function encrypt($value)
    {
        $iv = mcrypt_create_iv(static::iv_size(), static::randomizer());

        $value = static::pad($value);

        $value = mcrypt_encrypt(static::$cipher, static::key(), $value, static::$mode, $iv);

        return cUtils::base64_encode_safe($iv . $value);
    }

    public static function decrypt($value)
    {
        $value = cUtils::base64_decode_safe($value);

        // To decrypt the value, we first need to extract the input vector and
        // the encrypted value. The input vector size varies across different
        // encryption ciphers and modes, so we'll get the correct size.
        $iv = substr($value, 0, static::iv_size());

        $value = substr($value, static::iv_size());

        // Once we have the input vector and the value, we can give them both
        // to Mcrypt for decryption. The value is sometimes padded with \0,
        // so we will trim all of the padding characters.
        $key = static::key();

        $value = mcrypt_decrypt(static::$cipher, $key, $value, static::$mode, $iv);

        return static::unpad($value);
    }

    public static function randomizer()
    {
        // There are various sources from which we can get random numbers
        // but some are more random than others. We'll choose the most
        // random source we can for this server environment.
        if (defined('MCRYPT_DEV_URANDOM')) {
            return MCRYPT_DEV_URANDOM;
        } elseif (defined('MCRYPT_DEV_RANDOM')) {
            return MCRYPT_DEV_RANDOM;
        }
        // When using the default random number generator, we'll seed
        // the generator on each call to ensure the results are as
        // random as we can possibly get them.
        else {
            mt_srand();

            return MCRYPT_RAND;
        }
    }

    protected static function iv_size()
    {
        return mcrypt_get_iv_size(static::$cipher, static::$mode);
    }

    protected static function pad($value)
    {
        $pad = static::$block - (Str::length($value) % static::$block);

        return $value .= str_repeat(chr($pad), $pad);
    }

    protected static function unpad($value)
    {
        $pad = ord($value[($length = Str::length($value)) - 1]);

        if ($pad and $pad < static::$block) {
            // If the correct padding is present on the string, we will remove
            // it and return the value. Otherwise, we'll throw an exception
            // as the padding appears to have been changed.
            if (preg_match('/' . chr($pad) . '{' . $pad . '}$/', $value)) {
                return substr($value, 0, $length - $pad);
            }

            // If the padding characters do not match the expected padding
            // for the value we'll bomb out with an exception since the
            // encrypted value seems to have been changed.
            else {
                throw new \Exception("Decryption error. Padding is invalid.");
            }
        }

        return $value;
    }

    protected static function key()
    {
        return Config::get('application.key');
    }
}