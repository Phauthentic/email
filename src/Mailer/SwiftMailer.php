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
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;

/**
 * Swift Mailer
 */
class SwiftMailer implements MailerInterface
{
    /**
     * Swift Mailer Instance
     *
     * @var \Swift_Mailer
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

    public function getSwiftMessage(): Swift_Message
    {
        return new Swift_Message();
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $message = $this->defaultEmail($email);

        return (bool)$this->mailer->send($message);
    }

    public function defaultEmail(EmailInterface $email)
    {
        $swiftMessage = new Swift_Message($email->getSubject());

        $swiftMessage
            ->setSubject($email->getSubject())
            ->setFrom(
                $email->getSender()->getEmail(),
                $email->getSender()->getName()
            );

        foreach ($email->getReceivers() as $receiver) {
            $swiftMessage->addTo($receiver->getEmail(), $receiver->getName());
        }

        foreach ($email->getAttachments() as $attachment) {
            $swiftMessage->attach(new Swift_Attachment($attachment->getFile()));
        }

        $swiftMessage = $this->setBody($swiftMessage, $email);
        $swiftMessage = $this->setAttachments($swiftMessage, $email);

        return $swiftMessage;
    }

    /**
     * Sets the body to the email implementation
     *
     * @param \Swift_Message $swiftMessage
     * @param \Phauthentic\Email\EmailInterface $email Email
     */
    protected function setAttachments(Swift_Message $swiftMessage, EmailInterface $email)
    {
        return $swiftMessage;
    }

    /**
     * Sets the body to the email implementation
     *
     * @param \Swift_Message $swiftMessage
     * @param \Phauthentic\Email\EmailInterface $email Email
     */
    protected function setBody(Swift_Message $swiftMessage, EmailInterface $email)
    {
        $text = $email->getTextContent();
        $html = $email->getHtmlContent();

        if ($text !== null && $html !== null) {
            $swiftMessage->setBody($html, 'text/html');
            $swiftMessage->addPart($text, 'text/plain');
        } else {
            if ($text !== null) {
                $swiftMessage->setBody($text, 'text/plain');
            }

            if ($html !== null) {
                $swiftMessage->setBody($html, 'text/html');
            }
        }

        return $swiftMessage;
    }

    public function getEmail($name, $email)
    {
        $name = $name . 'Email';
        if (method_exists($this, $name)) {
            return $this->{$name}($email);
        }
    }

}
