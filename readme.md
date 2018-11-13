# Framework and library agnostic Email sending

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/Phauthentic/email/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/email/)
[![Code Quality](https://img.shields.io/scrutinizer/g/Phauthentic/email/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/email/)

Most email libraries are old and don't have what we consider a good interface, also we had the case that we needed to switch the underlying implementation. This library makes it both very convenient, it offers a [fluid](https://en.wikipedia.org/wiki/Fluent_interface) and strict typed interface to build emails and sending them through any mailer you want.

This library mostly implements just an email [data transfer object](https://en.wikipedia.org/wiki/Data_transfer_object) that is passed to a mailer that takes care of the actual email sending implementation. It shouldn't be possible to create an email with an invalid state with this library.

## Missing a feature?

Please open a feature type issue on Github with a detailed description and with an example of how to archive what you want in your mailer. Or even better: Create a pull request!

## How to use it

```php
use Phauthentic\Email\Email;
use Phauthentic\Email\EmailAddress;
use Phauthentic\Email\Mailer\SwiftMailer;
use Swift_Mailer;

$email = (new Email());
    ->setSender(new EmailAddress('me@test.com', 'Senders Name'))
    ->addReceiver(new EmailAddress('you@test.com'))
    ->setSubject('A test')
    ->setTextContent('My text email')
    ->setHtmlContent('<p>My HTML content</p>');

$mailer = new SwiftMailer(new Swift_Mailer());
$mailer->send($email);
$mailer->send($anotherEmail);
$mailer->send($oneMore);
```

## Copyright & License

Licensed under the [MIT license](LICENSE.txt).

Copyright (c) [Phauthentic](https://github.com/Phauthentic)
