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
        $swiftMail = new Swift_Message($email->getSubject());
        $swiftMail
          ->setFrom(
              $email->getSender()->getEmail(),
              $email->getSender()->getName()
          )
          ->setTo((string)$email->getReceivers()[0]->getEmail(), $email->getReceivers()[0]->getName());

        foreach ($email->getAttachments() as $attachment) {
            $swiftMail->attach(new Swift_Attachment($attachment->getFile()));
        }

        return $this->setBody($swiftMail, $email);
   }

   /**
    * Sets the body to the email implementation
    */
    protected function setBody(Swift_Message $swiftMail, EmailInterface $email)
    {
        $text = $email->getTextContent();
        $html = $email->getHtmlContent();

        if (!empty($text) && !empty($html)) {
            $swiftMail->setBody($html, 'text/html');
            $swiftMail->addPart($text, 'text/plain');
        } else {
            if (!empty($text)) {
                $swiftMail->setBody($text, 'text/plain');
            }

            if (!empty($html)) {
                $swiftMail->setBody($html, 'text/html');
            }
        }

        return $swiftMail;
    }

   public function getEmail($name, $email)
   {
        $name = $name . 'Email';
        if (method_exists($this, $name)) {
            return $this->{$name}($email);
        }
   }

}
