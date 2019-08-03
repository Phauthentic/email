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

use Countable;
use IteratorAggregate;

/**
 * Email Address Interface
 *
 * This object describes an email address for a receiver or sender. It should
 * make sure only a valid email address is created and used.
 */
interface EmailAddressCollectionInterface extends IteratorAggregate, Countable
{
    /**
     * Adds an email address to the collection
     *
     * @param \Phauthentic\Email\EmailAddress $emailAddress
     * @return void
     */
    public function add(EmailAddress $emailAddress): void;

    /**
     * Add multiple email addresses
     *
     * @param array $emailAddresses Array of Email addresses
     * @return \Phauthentic\Email\EmailAddressCollectionInterface
     */
    public static function fromArray(array $emailAddresses): EmailAddressCollectionInterface;
}
