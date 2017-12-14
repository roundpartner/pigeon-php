<?php

namespace RoundPartner\Pigeon;

interface PigeonInterface
{

    /**
     * @param array $options
     *
     * @return bool
     *
     * @throws Exception
     */
    public function sendEmail($options);

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $text
     *
     * @return bool
     *
     * @throws Exception
     */
    public function sendBasicEmail($from, $to, $subject, $text);
}
