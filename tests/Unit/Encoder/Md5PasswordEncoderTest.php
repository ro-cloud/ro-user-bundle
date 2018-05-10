<?php
/**
 * User: ttu
 * Date: 09.05.18
 * Time: 12:41
 */

namespace RoCloud\UserBundle\Tests\Unit\Encoder;

use PHPUnit\Framework\TestCase;
use RoCloud\UserBundle\Encoder\Md5PasswordEncoder;

class Md5PasswordEncoderTest extends TestCase
{
    /**
     * @test
     */
    public function itEncodesPasswordToMd5()
    {
        $password = '123456';

        $sut = new Md5PasswordEncoder();
        $encodedPassword = $sut->encodePassword($password, '');

        $this->assertSame(hash('md5', $password), $encodedPassword);
    }

    /**
     * @test
     */
    public function itValidatesTheHashedPassword()
    {
        $password = '123456';
        $salt = '';

        $sut = new Md5PasswordEncoder();
        $encodedPassword = hash('md5', $password);

        $this->assertTrue($sut->isPasswordValid($encodedPassword, $password, $salt));
    }
}
