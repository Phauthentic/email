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

use Cake\Mailer\Email as CakeEamil;
use Phauthentic\Email\EmailInterface;

/**
 * Abstract Cake mailer
 */
class CakePhpMailer implements MailerInterface
{
    /**
     * Cake Email Instance
     *
     * @var \Cake\Mailer\Email
     */
    protected $cakeEmail;

    /**
     * Constructor
     *
     * @param \Cake\Mailer\Email $cakeEmail Cake Email
     */
    public function __construct(CakeEmail $cakeEmail)
    {
        $this->cakeEmail = $cakeEmail;
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $cakeEmail = clone $this->cakeEmail;

        $cakeEmail->setSubject($email->getSubject());
        $cakeEmail->setSender($email->getEmail(), $email->getName());

        foreach ($email->getReceivers() as $recevier) {
            $cakeEmail->addTo($recevier->getEmail(), $recevier->getName());
        }

        $html = $email->getHtmlContent();
        $text = $email->getTextContent();

        if (!empty($html) && !empty($text)) {

        }

        $cakeEmail->send();

        return true;
    }
}
