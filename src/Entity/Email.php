<?php

namespace RoundPartner\Pigeon\Entity;

class Email
{
    /**
     * @var string
     */
    public $from;

    /**
     * @var string
     */
    public $to;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $text;

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'from' => $this->from,
            'to' => $this->to,
            'subject' => $this->subject,
            'text' => $this->text,
        ];
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $text
     *
     * @return Email
     */
    public static function factory($from, $to, $subject, $text)
    {
        $email = new Email();
        $email->from = $from;
        $email->to = $to;
        $email->subject = $subject;
        $email->text = $text;
        return $email;
    }
}