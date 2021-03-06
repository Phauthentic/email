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

use InvalidArgumentException;

/**
 * Email Address
 */
class EmailAddress implements EmailAddressInterface
{
    /**
     * Receiver Name
     *
     * @var string
     */
    protected $name = '';

    /**
     * Email
     *
     * @var string
     */
    protected $email = '';

    /**
     * @inheritDoc
     */
    public function __construct(string $email, string $name = '')
    {
        $this->setEmail($email);
        $this->setName($name);
    }

    /**
     * @inheritDoc
     */
    public function setEmail(string $email, bool $validate = true): EmailAddressInterface
    {
        if ($validate === true && !$this->validateEmailAddress($email)) {
            throw new InvalidArgumentException(sprintf(
                'The given email address `%s` is invalid',
                $email
            ));
        }

        $this->email = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): EmailAddressInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        if (empty($this->name)) {
            return $this->email;
        }

        return $this->email . ' <' . $this->name . '>';
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [$this->getEmail() => $this->getName()];
    }

    /**
     * Validates the email address by regex
     *
     * @link http://emailregex.com/
     * @param string $email Email address
     * @return bool
     */
    protected function validateEmailAddress(string $email): bool
    {
        return (bool)preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email);
    }
}
