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
 * A very simple mailer using phps mail() function
 *
 * Be aware that this mailer in it's current form will send ONLY plain text mail!
 */
class PhpMailMailer implements MailerInterface
{
    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $receiver = [];
        foreach ($email->getReceivers() as $receiver) {
            $receivers[] = (string)$receiver;
        }

        return $this->mail(implode(' ,', $receivers), $email->getSubject(), (string)$email->getTextContent());
    }

    /**
     * Wrapper around mail()
     *
     * @link http://php.net/manual/en/function.mail.php
     * @param string $to Receiver
     * @param string $subject Subject
     * @param string $message
     * @param string $headers
     * @param string $paramters
     * @return bool
     */
    public function mail(string $to, string $subject, string $message, $headers = '', string $parameters = ''): bool
    {
        return mail($to, $subject, $message, $headers, $parameters);
    }
}
