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
 * Email Interface
 *
 * This is a data transfer object that describes an email
 *
 * The object can be passed to any method / class that can use it to construct
 * an email the way it likes and send the email. This ensures that the email
 * implementation is agnostic to the framework.
 */
interface HeaderInterface
{
    /**
     *
     */
    public function getName(): string;

    /**
     * 
     */
    public function getValue(): ?string;
}
