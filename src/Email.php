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

use RuntimeException;

/**
 * Email
 *
 * This is a framework agnostic object that describes a single email
 */
class Email implements EmailInterface
{
    protected $messageId = null;
    protected $sender = null;
    protected $replyTo = null;
    protected $receivers = [];
    protected $bcc = [];
    protected $cc = [];
    protected $subject = '';
    protected $htmlContent = null;
    protected $textContent = null;
    protected $contentType = '';
    protected $attachments = [];
    protected $priority = Priority::NORMAL;
    protected $attributes = [];
    protected $headers = [];

    /**
     * Create a new email object
     *
     * @return $this
     */
    public static function create(
        EmailAddressInterface $sender,
        EmailAddressCollectionInterface $receiver,
        ?EmailAddressCollectionInterface $cc,
        ?EmailAddressCollectionInterface $bcc,
        string $subject,
        string $htmlContent,
        string $textContent,
        int $priority = 3
    ) {
        $email = new self();
        $email->setSender($sender);
        $email->setSubject($subject);
        $email->bcc = $bcc;
        $email->cc = $cc;
        $email->priority = $priority;
        $email->receivers = $receiver;
        $email->htmlContent = $htmlContent;
        $email->textContent = $textContent;
        $email->priority = $priority;

        return $email;
    }

    /**
     * @inheritDoc
     */
    public function setSender(EmailAddressInterface $email): EmailInterface
    {
        $this->sender = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSubject(string $subject): EmailInterface
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setReceivers(EmailAddressCollectionInterface $receivers): EmailInterface
    {
        foreach ($receivers as $receiver) {
            $this->addReceiver($receiver);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCc(EmailAddressCollectionInterface $cc): EmailInterface
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setBcc(EmailAddressCollectionInterface $bcc): EmailInterface
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentType(string $type): EmailInterface
    {
        $this->contentType = $type;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setHtmlContent(?string $html): EmailInterface
    {
        $this->htmlContent = $html;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTextContent(?string $text): EmailInterface
    {
        $this->textContent = $text;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPriority(int $priority): EmailInterface
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMessageId(string $messageId): EmailInterface
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * Set custom attributes for vendor specific things if needed
     *
     * @return \Phauthentic\Email\EmailInterface
     */
    public function setAttribute(string $name, $value): EmailInterface
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Set custom attributes
     *
     * @return \Phauthentic\Email\EmailInterface
     */
    public function setHeaders(array $headers): EmailInterface
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSender(): EmailAddressInterface
    {
        if (empty($this->sender)) {
            throw new RuntimeException('No sender was defined for this email');
        }

        return $this->sender;
    }

    /**
     * @inheritDoc
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @inheritDoc
     */
    public function getReceivers(): EmailAddressCollectionInterface
    {
        if (count($this->receivers) === 0) {
            throw new RuntimeException('You must set at least one receiver for the email');
        }

        return $this->receivers;
    }

    /**
     * @inheritDoc
     */
    public function getCc(): EmailAddressCollectionInterface
    {
        return $this->cc;
    }

    /**
     * @inheritDoc
     */
    public function getBcc(): EmailAddressCollectionInterface
    {
        return $this->bcc;
    }

    /**
     * @inheritDoc
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @inheritDoc
     */
    public function getHtmlContent(): ?string
    {
        return $this->htmlContent;
    }

    /**
     * @inheritDoc
     */
    public function getTextContent(): ?string
    {
        return $this->textContent;
    }

    /**
     * @inheritDoc
     */
    public function addAttachment(AttachmentInterface $attachment): EmailInterface
    {
        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @inheritDoc
     */
    public function setReplyTo(EmailAddressInterface $email): EmailInterface
    {
        $this->replyTo = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addReceiver(EmailAddressInterface $email): EmailInterface
    {
        $this->receivers[] = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addCc(EmailAddressInterface $email): EmailInterface
    {
        $this->cc[] = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addBcc(EmailAddressInterface $email): EmailInterface
    {
        $this->bcc[] = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getReplyTo(): ?EmailAddressInterface
    {
        return $this->replyTo;
    }

    /**
     * @inheritDoc
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @inheritDoc
     */
    public function getMessageId()
    {
        if (empty($this->messageId)) {
            $this->messageId = time() . '.' . mt_srand((double)microtime() * 10000) . '@' . $_SERVER['HTTP_HOST'];
        }

        return $this->messageId;
    }

    /**
     * Gets a custom attribute
     *
     * @param string $name Attribute name
     * @return mixed
     */
    public function getAttribute(string $name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * Gets a custom attribute
     *
     * @param string $name Attribute name
     * @return mixed
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Returns an array representation of the email object
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'messageId' => $this->messageId,
            'sender' => $this->sender,
            'replyTo' => $this->replyTo,
            'receivers' => $this->receivers,
            'bcc' => $this->bcc,
            'cc' => $this->cc,
            'subject' => $this->subject,
            'htmlContent' => $this->htmlContent,
            'textContent' => $this->textContent,
            'contentType' => $this->contentType,
            'attachments' => $this->attachments,
            'priority' => $this->priority,
            'attributes' => $this->attributes ,
            'headers' => $this->headers
        ];
    }
}
