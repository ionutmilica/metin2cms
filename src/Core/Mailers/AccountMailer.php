<?php namespace Metin2CMS\Core\Mailers;

class AccountMailer extends Mailer {

    public function confirmation(array $data)
    {
        $this->view = 'emails.account.confirm';
        $this->subject = 'Account confirmation';
        $this->to = $data['email'];
        $this->email = $data['email'];
        $this->data = $data;

        return $this;
    }

    /**
     * Prepare an email sending for storage password
     *
     * @param array $data
     * @return $this
     */
    public function safebox(array $data)
    {
        $this->view = 'emails.account.safebox';
        $this->subject = 'Safebox password';
        $this->to = $data['email'];
        $this->email = $data['email'];
        $this->data = $data;

        return $this;
    }
}