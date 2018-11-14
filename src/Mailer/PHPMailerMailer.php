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
use PHPMailer\PHPMailer\PHPMailer;

/**
 * PHP Mailer
 */
class PHPMailerMailer implements MailerInterface
{
    /**
     * @var \PHPMailer\PHPMailer\PHPMailer
     */
    protected $mailer;

    /**
     * Constructor
     *
     * @param \PHPMailer $mailer PHPMailer instance
     */
    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $mailer = clone $this->mailer;

        $sender = $email->getSender();
        $mailer->setFrom($sender->getEmail(), $sender->getName());

        foreach ($email->getReceivers() as $receiver) {
            $mailer->addAddress($receiver->getEmail(), $receiver->getName());
        }

        foreach ($email->getBcc() as $receiver) {
            $mailer->addCC($receiver->getEmail(), $receiver->getName());
        }

        foreach ($email->getCc() as $receiver) {
            $mailer->addBCC($receiver->getEmail(), $receiver->getName());
        }

        $mailer->Subject = $email->getSubject();
        $mailer->Body = $email->getHtmlContent();
        $mailer->AltBody = $email->getTextContent();

        return $mailer->send();
    }
}
