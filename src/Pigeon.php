<?php

namespace RoundPartner\Pigeon;

use RoundPartner\Pigeon\Entity\Email;
use RoundPartner\Pigeon\Entity\EmailTemplate;

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
     * @throws \Exception
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
     * @throws \Exception
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
     * @throws \Exception
     */
    public function sendTrackedEmail($from, $to, $subject, $text, $html = '')
    {
        $email = Email::factory($from, $to, $subject, $text, $html, true);
        return $this->sendEmail($email);
    }

    /**
     * @param string $to
     * @param string $template
     * @param array $params
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function sendEmailTemplate($to, $template, $params)
    {
        $email = EmailTemplate::factory($to, $template, $params);
        return $this->sendEmail($email);
    }

    /**
     * @param string $template
     * @param array $params
     *
     * @return Email
     */
    public function template($template, $params) {
        $email = EmailTemplate::factory('', $template, $params);
        $response = $this->client->post('/template', [
            'json' => $email->toArray(),
        ]);
        if ($response->getStatusCode() !== 200) {
            return null;
        }
        $json = json_decode($response->getBody()->getContents());
        $email = Email::factory($json->from, $json->to, $json->subject, $json->text, $json->html);
        return $email;
    }
}
