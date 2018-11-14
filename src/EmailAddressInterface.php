<?php
declare(strict_types=1);
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
namespace Phauthentic\Email;

/**
 * Email Address Interface
 *
 * This object describes an email address for a receiver or sender. It should
 * make sure only a valid email address is created and used.
 */
interface EmailAddressInterface
{
    /**
     * Sets the email
     *
     * @param string $email Email address
     * @return \App\Infrastructure\Email\EmailAddressInterface;
     */
    public function setEmail(string $email): EmailAddressInterface;

    /**
     * @param string $name Receiver name
     * @return \App\Infrastructure\Email\EmailAddressInterface;
     */
    public function setName(string $name): EmailAddressInterface;

    /**
     * Gets the email address
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns a string representation of this object
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Returns the address as array were the key is the email address and the
     * value the name
     *
     * @return array
     */
    public function toArray(): array;
}
