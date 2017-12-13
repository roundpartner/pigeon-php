<?php

namespace RoundPartner\Pigeon;

class Pigeon extends RestClient implements PigeonInterface
{
    public function __construct($baseUri)
    {
        parent::__construct([
            'base_uri' => $baseUri,
        ]);
    }

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
    public function sendBasicEmail($from, $to, $subject, $text)
    {
        $data = [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'text' => $text,
        ];
        $response = $this->client->post('/email', [
            'json' => $data
        ]);
        if ($response->getStatusCode() !== 204) {
            return false;
        }
        return true;
    }
}
