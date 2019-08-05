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

use ArrayIterator;

/**
 * Email Address
 */
class EmailAddressCollection implements EmailAddressCollectionInterface
{
    /**
     * @var array
     */
    protected $emailAddresses = [];

    /**
     * @inheritDoc
     */
    public static function fromArray(array $array): EmailAddressCollectionInterface
    {
        $collection = new self();

        foreach ($array as $emailAddress) {
            if (is_array($emailAddress)) {
                $emailAddress = EmailAddress::fromArray($emailAddress);
            }

            if (is_string($emailAddress)) {
                $emailAddress = EmailAddress::fromString($emailAddress);
            }

            $collection->add($emailAddress);
        }

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function add(EmailAddress $emailAddress): void
    {
        $this->emailAddresses[] = $emailAddress;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->emailAddresses);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->emailAddresses);
    }
}
