<?php namespace Metin2CMS\Core\Mailers;

use \Illuminate\Mail\Mailer as MailerProvider;

abstract class Mailer {

    /**
     * @var \Illuminate\Mail\Mailer
     */
    protected $mailer;

    /**
     * @var string
     */
    protected $view;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var array
     */
    protected $data;

    /**
     * @param MailerProvider $mailer
     */
    public function __construct(MailerProvider $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send a mail
     */
    public function send()
    {
        return (bool) $this->mailer->send($this->view, $this->data, function ($message)
        {
            $message->to($this->email, $this->to)->subject($this->subject);
        });
    }
}