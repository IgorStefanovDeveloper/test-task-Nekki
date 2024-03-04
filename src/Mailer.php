<?php

namespace Igorstefanovdeveloper\Nekki;

class Mailer {
    /**
     * @param string $email Receiver, or receivers of the mail. The formatting of this string must comply with RFC 2822. Some examples are: user@example.com user@example.com, anotheruser@example.com User <user@example.com> User <user@example.com>, Another User <anotheruser@example.com>
     * @param string $subject Subject of the email to be sent. Subject must satisfy RFC 2047.
     * @param string $message Message to be sent. Each line should be separated with a LF (\n). Lines should not be larger than 70 characters.
     * @return void
     */
    public function send(string $email, string $subject, string $message): void
    {
        $headers = 'From: YourWebsite <noreply@yourwebsite.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        // send
        mail($email, $subject, $message, $headers);
    }
}
