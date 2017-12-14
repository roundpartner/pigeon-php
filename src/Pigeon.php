<?php

namespace RoundPartner\Pigeon;

use RoundPartner\Pigeon\Entity\Email;

class Pigeon extends RestClient implements PigeonInterface
{
    public function __construct($baseUri)
    {
        parent::__construct([
            'base_uri' => $baseUri,
        ]);
    }

    /**
     * @param Entity\Email $email
     *
     * @return bool
     *
     * @throws Exception
     */
    public function sendEmail($email)
    {
        $response = $this->client->post('/email', [
            'json' => $email->toArray(),
        ]);
        if ($response->getStatusCode() !== 204) {
            return false;
        }
        return true;
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $text
     * @param string $html
     *
     * @return bool
     *
     * @throws Exception
     */
    public function sendBasicEmail($from, $to, $subject, $text, $html = '')
    {
        $email = Email::factory($from, $to, $subject, $text, $html, false);
        return $this->sendEmail($email);
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $text
     * @param string $html
     *
     * @return bool
     *
     * @throws Exception
     */
    public function sendTrackedEmail($from, $to, $subject, $text, $html = '')
    {
        $email = Email::factory($from, $to, $subject, $text, $html, true);
        return $this->sendEmail($email);
    }
}
