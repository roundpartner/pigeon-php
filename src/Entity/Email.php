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
     * @var string
     */
    public $html;

    /**
     * @var bool
     */
    public $track;

    /**
     * @var string
     */
    public $replyTo;

    /**
     * @var bool
     */
    public $report;

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
            'html' => $this->html,
            'track' => true === $this->track,
            'reply_to' => $this->replyTo,
            'report' => true === $this->report,
        ];
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $text
     * @param string $html
     * @param bool $track
     *
     * @return Email
     */
    public static function factory($from, $to, $subject, $text, $html = '', $track = false)
    {
        $email = new Email();
        $email->from = $from;
        $email->to = $to;
        $email->subject = $subject;
        $email->text = $text;
        $email->html = $html;
        $email->track = $track;
        return $email;
    }
}
