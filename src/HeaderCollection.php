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
use InvalidArgumentException;

/**
 * Header Collection
 */
class HeaderCollection implements HeaderCollectionInterface
{
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * Creates headers based on an array ofkey value pairs
     *
     * @param array $headers Headers
     * @return $this
     */
    public static function fromArray(array $headers): self
    {
        $self = new self();
        foreach ($headers as $header) {
            $self->add(Header::create($name, $value));
        }

        return $self;
    }

    /**
     * Adds an email address to the collection
     *
     * @param \Phauthentic\Email\EmailAddress $emailAddress
     * @return void
     */
    public function add(HeaderInterface $header): void
    {
        $this->headers[] = $header;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->headers);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->headers);
    }
}
