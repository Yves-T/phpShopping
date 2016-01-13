<?php


class SecurePassword
{
    // blow fish algorithm
    // 2y is the bcrypt algorithm selector, see http://php.net/crypt
    private static $algorithm = "$2y";

    // cost parameter
    private static $cost = "$12";

    /**
     * Create random salt
     * @return string
     */
    public static function randomSalt()
    {
        // salt for bcrypt needs to be 22 base64 characters (but just [./0-9A-Za-z]), see http://php.net/crypt
        return substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
    }

    /**
     * Create hash for the given password and salt
     * @param $password
     * @param $salt
     * @return string
     */
    public static function createHash($password, $salt)
    {
        return crypt($password, self::$algorithm . self::$cost . '$' . $salt);
    }

    /**
     * Validate the given password against the given hash and salt. Returns true
     * if validation was a success. False otherwise.
     * @param $salt
     * @param $hash
     * @param $password
     * @return bool
     */
    public static function validatePassword($salt, $hash, $password)
    {
        return $hash == self::createHash($password, $salt);
    }
}