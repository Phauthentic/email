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
namespace Phauthentic\Email;

/**
 * Email Interface
 *
 * This is a data transfer object that describes an email
 *
 * The object can be passed to any method / class that can use it to construct
 * an email the way it likes and send the email. This ensures that the email
 * implementation is agnostic to the framework.
 */
interface EmailInterface
{
    // Setters
    public function setSender(EmailAddressInterface $email) : EmailInterface;
    public function setReplyTo(EmailAddressInterface $email) : EmailInterface;
    public function setSubject(string $subject) : EmailInterface;
    public function addReceiver(EmailAddressInterface $email): EmailInterface;
    public function setReceivers(array $receivers) : EmailInterface;
    public function addCc(EmailAddressInterface $email): EmailInterface;
    public function setCc(array $cc) : EmailInterface;
    public function addBcc(EmailAddressInterface $email): EmailInterface;
    public function setBcc(array $bcc) : EmailInterface;
    public function setContentType(string $type) : EmailInterface;
    public function setHtmlContent(string $html) : EmailInterface;
    public function setTextContent(string $text) : EmailInterface;
    public function addAttachment(AttachmentInterface $attachment): EmailInterface;
    public function setPriority(int $priority): EmailInterface;

    // Getters
    public function getSender() : EmailAddressInterface;
    public function getReplyTo(): ?EmailAddressInterface;
    public function getSubject() : string;
    public function getReceivers() : array;
    public function getCc() : array;
    public function getBcc() : array;
    public function getContentType() : string;
    public function getHtmlContent() : string;
    public function getTextContent() : string;
    public function getAttachments(): array;
    public function getPriority(): int;
}
