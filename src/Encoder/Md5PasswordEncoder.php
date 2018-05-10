<?php

namespace RoCloud\UserBundle\Encoder;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * This isn't really an encoder and should ONLY be used for the accounts of rathena. For accounts in symfony,
 * you should consider using the bcrypt encryption.
 *
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
class Md5PasswordEncoder implements PasswordEncoderInterface
{
    /**
     * "Encodes" the raw password.
     *
     * @param string $raw The password to encode
     * @param string $salt The salt
     *
     * @return string The encoded password
     */
    public function encodePassword($raw, $salt)
    {
        $rawPassword = implode('', [$raw, $salt]);

        return hash('md5', $rawPassword);
    }

    /**
     * Checks a raw password against an encoded password.
     *
     * @param string $encoded An encoded password
     * @param string $raw A raw password
     * @param string $salt The salt
     *
     * @return bool true if the password is valid, false otherwise
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $encoded === $this->encodePassword($raw, $salt);
    }
}
