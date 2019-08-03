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
namespace Phauthentic\Email\Mailer;

use RuntimeException;

/**
 * Mailer Registry
 */
class MailerRegistry
{
    /**
     * @var array
     */
    protected static $mailers = [];

    /**
     * Checks if a config is present
     *
     * @param string $name Name
     * @return bool
     */
    public static function has(string $name): bool
    {
        return isset(static::$mailers[$name]);
    }

    /**
     * Removes a mailer from the registry
     *
     * @return void
     */
    public static function remove(string $name): void
    {
        unset(static::$mailers[$name]);
    }

    /**
     * Clears all mailers from the registry
     *
     * @return void
     */
    public static function flush(): void
    {
        static::$mailers = [];
    }

    /**
     * @param string $name Name
     * @param \Phauthentic\Email\Mailer\MailerInterface $mailer Mailer
     * @return void
     */
    public static function add(string $name, MailerInterface $mailer): void
    {
        static::$mailers[$name] = $mailer;
    }

    /**
     * @return \Phauthentic\Email\Mailer\MailerInterface
     */
    public static function get(string $name): MailerInterface
    {
        if (!isset(static::$mailers[$name])) {
            throw new RuntimeException(sprintf('Mailer `%s` not configured', $name));
        }

        return static::$mailers[$name];
    }

    /**
     * Returns a map of config name to class name
     *
     * @return array
     */
    public static function getMap(): array
    {
        $map = [];
        foreach (static::$mailers as $name => $object) {
            $map[$name] = $object;
        }

        return $map;
    }
}
