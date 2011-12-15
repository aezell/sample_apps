<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * AddIn Social authentication signature library
 *
 * This file provides methods to create signatures to use the AddIn Social api.
 *
 * @package AddInSocial
 * @author Sam Wilson <sam@arkli.com>
 */


/**
 * Provides signature generation methods for use with the AddIn Social api
 *
 * @package AddInSocial
 * @author Sam Wilson <sam@arkli.com>
 */
class ArkliAuth
{
    /**
     * Checks the given signature against the one calculated for the given
     * values.  Ensuring that the nonce is unique should be done outside of this
     * function.
     * @param string $given The signature to verify
     * @param string $key A unique identifier for the secret
     * @param string $secret A shared secret between the signer and the verifer
     * @param string $user The name of the user to authenticate
     * @param string $email The email address of the user to authenticate
     * @return boolean True if the signature is valid, false otherwise
     */
    public static function is_valid($given, $key, $secret, $user, $email,
                                        $timestamp, $nonce)
    {
        $given = (string) $given;

        // Calculate the proper signature
        $expected = self::create_signature($key, $secret, $user, $email,
                                            $timestamp, $nonce);
        $expected = $expected['arkli_signature'];

        if (strlen($given) != strlen($expected))
        {
            return false;
        }

        // Check the signature.  Do not return early to prevent timing attacks
        $invalid = 0;
        for ($i = 0; $i < strlen($given); $i++)
        {
            $invalid = $invalid | ($expected[$i] ^ $given[$i]);
        }

        return ($invalid == 0);
    }

    /**
     * Creates a list of query parameters to append to a url to authenticate
     * a user.
     * @param string $key A unique identifier for the secret
     * @param string $secret A shared secret between the signer and the verifer
     * @param string $user The name of the user to authenticate
     * @param string $email The email address of the user to authenticate
     * @return string A query string with the signature and the data
     */
    public static function create_signature_url($key, $secret, $user, $email='')
    {
        $parts = self::create_signature($key, $secret, $user, $email);
        $parts['arkli_signature'] = rawurlencode($parts['arkli_signature']);

        $base = array();
        foreach ($parts as $k=>$v)
        {
            $base[] = $k . '=' . $v;
        }
        $base = implode('&', $base);

        return $base;
    }

    /**
     * Signs the given data with the given key and secret.
     * @param string $key A unique identifier for the secret
     * @param string $secret A shared secret between the signer and the verifer
     * @param string $user The name of the user to authenticate
     * @param string $email The email address of the user to authenticate
     * @param string $timestamp A unix timestamp which, if present, will be used
     *                          instead of the current time.
     * @param string $nonce A one time use value to make each signature unique.
     *                      If not present, will generate one.
     * @return array All of the data in its encoded form as well as the
     *                  signature
     */
    public static function create_signature($key, $secret, $user, $email='',
                                            $timestamp=null, $nonce=null)
    {
        // Requires PHP version >= 5.3.0 or else '~' is encoded incorrectly

        // Clean up the input
        $key    = (string) $key;
        $secret = (string) $secret;
        $user   = (string) $user;
        $email  = (string) $email;

        // Get the current timestamp and generate an nonce
        if (!$timestamp)
        {
            $timestamp = time();
        }

        if (!$nonce)
        {
            $nonce = self::create_nonce();
        }

        // Bulid the base string
        $parts = array(
            'arkli_email' => $email,
            'arkli_key' => $key,
            'arkli_nonce' => $nonce,
            'arkli_timestamp' => $timestamp,
            'arkli_user' => $user,
        );
        $base = array();
        foreach ($parts as $k=>$v)
        {
            $base[] = rawurlencode($k) . '=' . rawurlencode($v);
        }
        $base = implode('&', $base);

        // Calculate the signature
        $signature = base64_encode(hash_hmac('sha1', $base, $secret, true));

        // Do not rawurlencode the signature here
        $parts['arkli_signature'] = $signature;
        return $parts;
    }

    /**
     * Really simple function to generate alphanumeric nonces
     */
    protected static function create_nonce()
    {
        $mt = microtime();
        $rand = mt_rand();

        return preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(sha1($mt . $rand, true)));
    }
}
