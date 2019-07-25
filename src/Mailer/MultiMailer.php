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

use Phauthentic\Email\EmailInterface;
use RuntimeException;

/**
 * Multi Mailer
 *
 * Use this to send an email to multiple mailer instances
 */
class MultiMailer implements MailerInterface
{
    /**
     * @var array
     */
    protected $mailers = [];

    /**
     * Constructor
     *
     * @param array $mailers Mailers
     */
    public function __construct(array $mailers)
    {
        foreach ($mailers as $mailer) {
            $this->addMailer($mailer);
        }
    }

    /**
     * Adds a mailer
     *
     * @param \Phauthentic\Email\Mailer\MailerInterface $mailer Mailer
     */
    public function addMailer(MailerInterface $mailer)
    {
        $this->mailers[] = $mailer;
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $status = true;
        foreach ($this->mailers as $mailer) {
            if (!$mailer->send($email)) {
                $status = false;
            }
        }

        return $status;
    }
}
