<?php

namespace RoundPartner\Pigeon;

use RoundPartner\Pigeon\Entity\Email;

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

    /**
     * @param string $to
     * @param string $template
     * @param array $params
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function sendEmailTemplate($to, $template, $params);

    /**
     * @param string $template
     * @param array $params
     *
     * @return Email
     */
    public function template($template, $params);
}
