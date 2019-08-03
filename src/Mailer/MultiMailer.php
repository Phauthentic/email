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

use Exception;
use Phauthentic\Email\EmailInterface;
use RuntimeException;

/**
 * Multi Mailer
 *
 * Use this to send an email to multiple mailer instances. For example you could
 * use any real mailer and the log mailer as well.
 *
 * It won't stop if a mailers failed and continue with the next on in the list.
 * This allows you also to configure multiple mailers as a fallback. send() will
 * only return false if all mailers failed.
 */
class MultiMailer implements MailerInterface
{
    /**
     * @var array
     */
    protected $mailers = [];

    /**
     * @var array
     */
    protected $errors;

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
     * Gets a list of errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $mailer \Phauthentic\Email\Mailer\MailerInterface Mailer
     * @param \Exception|null $exception Exception
     * @return void
     */
    protected function addError(MailerInterface $mailer, ?Exception $exception = null)
    {
        $this->errors[] = [
            'class' => get_class($mailer),
            'object' => $mailer,
            'message' => get_class($mailer) . '::send() returned false',
            'exception' => $exception
        ];
    }

    /**
     * @return bool
     */
    public function didAllFail(): bool
    {
        return count($this->mailers) === count($this->errors);
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        if (count($mailer) === 0) {
            throw new RuntimeException('You must add at least one mailer');
        }

        foreach ($this->mailers as $mailer) {
            try {
                if (!$mailer->send($email)) {
                    $this->addError($mailer);
                }
            } catch (Exception $exception) {
                $this->addError($mailer, $exception);
            }
        }

        return count($this->mailers) !== count($this->errors);
    }
}
