<?php
declare(strict_types = 1);
/**
 * Copyright (c) Phauthentic (https://github.com/Phauthentic)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Phauthentic (https://github.com/Phauthentic)
 * @link          https://github.com/Phauthentic
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Phauthentic\Email\Test\TestCase;

use Phauthentic\Email\EmailAddress;
use PHPUnit\Framework\TestCase;

/**
 * Email Address Test
 */
class EmailAddressTest extends TestCase
{
    /**
     * testEmailAddress
     *
     * @return void
     */
    public function testEmailAddress(): void
    {
        $address = EmailAddress::create('test@test.com', 'Some Test Name');

        $this->assertEquals('Some Test Name', $address->getName());
        $this->assertEquals('test@test.com', $address->getEmail());
        $this->assertEquals('Some Test Name <test@test.com>', (string)$address);
        $this->assertEquals(['Some Test Name' => 'test@test.com'], $address->toArray());

        $address = EmailAddress::create('test@test.com');
        $this->assertEquals('test@test.com', (string)$address);
    }

    /**
     * testFromString
     *
     * @return void
     */
    public function testFromString(): void
    {
        $address = EmailAddress::fromString('Foo Bar <foo@bar.com>');
        $this->assertEquals('Foo Bar', $address->getName());
        $this->assertEquals('foo@bar.com', $address->getEmail());

        $address = EmailAddress::fromString('foo@bar.com');
        $this->assertEquals('foo@bar.com', $address->getName());
        $this->assertEquals('foo@bar.com', $address->getEmail());
    }

    /**
     * testInvalidEmailAddress
     *
     * @expectedException \InvalidArgumentException
     * @return void
     */
    public function testInvalidEmailAddress(): void
    {
        EmailAddress::create('invalid!');
    }
}
