# Framework and library agnostic Email sending

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/Phauthentic/email/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/email/)
[![Code Quality](https://img.shields.io/scrutinizer/g/Phauthentic/email/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/email/)

Most email libraries are old and don't have what we consider a good interface, also we had the case that we needed to switch the underlying implementation. This library makes it both very convenient, it offers a [fluid](https://en.wikipedia.org/wiki/Fluent_interface) and strict typed interface to build emails and sending them through any mailer you want.

## Mailers supported out of the box

* Swift Mailer (recommended)
* PHPMailer

Other included mailers:
* mail() Mailer - a *very* simple implementation using [mail()](http://php.net/manual/de/function.mail.php)
* Log Mailer - for testing, requires a [PSR3](https://github.com/php-fig/log) compatible logger
* Null Mailer - for testing

## How to use it

Assuming you want to use this library with the Swift mailer:

```sh
composer require phauthentic/email
composer require swiftmailer/swiftmailer
```

**Be aware that the library doesn't come with a default mailer library dependency! You MUST choose one that is supported!**

A *simple* example:

```php
use Phauthentic\Email\Email;
use Phauthentic\Email\EmailAddress;
use Phauthentic\Email\Mailer\SwiftMailer;
use Swift_Mailer;
use Swift_SmtpTransport;

$email = (new Email());
    ->setSender(new EmailAddress('me@test.com', 'Senders Name'))
    ->addReceiver(new EmailAddress('you@test.com'))
    ->setSubject('A test')
    ->setTextContent('My text email')
    ->setHtmlContent('<p>My HTML content</p>');

$mailer = new SwiftMailer(new Swift_Mailer(new Swift_SmtpTransport()));
$mailer->send($email);
$mailer->send($anotherEmail);
$mailer->send($oneMore);
```

## Missing a feature?

Please open a feature type issue on Github with a detailed description and with an example of how to archive what you want in your mailer. Or even better: Create a pull request!

## Copyright & License

Licensed under the [MIT license](LICENSE.txt).

Copyright (c) [Phauthentic](https://github.com/Phauthentic)
