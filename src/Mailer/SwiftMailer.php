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
namespace Phauthentic\Email\Mailer;

use Phauthentic\Email\EmailInterface;

/**
 * Swift Mailer
 */
class SwiftMailer implements MailerInterface
{
    /**
     * Swift Mailer Instance
     */
    protected $mailer;

    /**
     * Constructor
     *
     * @param \Swift_Mailer $mailer Swift Mailer Instance
     */
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getSwiftMessage()
    {
        return new Swift_Message();
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $message = $this->toSwiftEmail($email);

        $this->mailer->send($message);
    }

    public function toSwiftEmail(EmailInterface $email)
    {
        return (new Swift_Message($email->getSubject()))
          ->setFrom($email->getSender()->toArray())
          ->setTo($email->getReceivers())
          ->setBody($email->getHtmlContent());
    }
}
