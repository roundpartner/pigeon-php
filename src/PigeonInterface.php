<?php

namespace RoundPartner\Pigeon;

interface PigeonInterface
{

    /**
     * @param Entity\Email $email
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function sendEmail($email);

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $text
     * @param string $html
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function sendBasicEmail($from, $to, $subject, $text, $html = '');

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $text
     * @param string $html
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function sendTrackedEmail($from, $to, $subject, $text, $html = '');
}
