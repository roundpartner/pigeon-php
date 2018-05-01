<?php

namespace RoundPartner\Pigeon\Entity;

class EmailTemplate
{

    /**
     * @var string
     */
    public $to;

    /**
     * @var string
     */
    public $template;

    /**
     * @var array
     */
    public $params;

    /**
     * @var string
     */
    public $replyTo;

    /**
     * @var string
     */
    public $subject;

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
            'to' => $this->to,
            'template' => $this->template,
            'params' => $this->params,
            'reply_to' => $this->replyTo,
            'subject' => $this->subject,
            'report' => true === $this->report,
        ];
    }

    /**
     * @param string $to
     * @param string $template
     * @param array $params
     * @param string $replyTo
     *
     * @return EmailTemplate
     */
    public static function factory($to, $template, $params, $replyTo = '')
    {
        $email = new EmailTemplate();
        $email->to = $to;
        $email->template = $template;
        $email->params = $params;
        $email->replyTo = $replyTo;
        return $email;
    }
}
