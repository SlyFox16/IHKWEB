<?php
class Email extends CApplicationComponent
{
    public $subject;
    public $body;

    public function restorePassEmail($user)
    {
        $this->subject = YHelper::yiisetting('change_pass_email', Yii::app()->name.' change password email', true);
        $this->body = YHelper::yiisetting('change_pass_email');
        $senderEmail = YHelper::yiisettingSenderEmail('change_pass_email', Yii::app()->name);
        $this->body = $this->changeAttr($user, $this->body);

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    public function restoreRatingEmail($user, $mark)
    {
        $this->subject = YHelper::yiisetting('rating_email', Yii::app()->name.' you\'ve been rated', true);
        $this->body = YHelper::yiisetting('rating_email');
        $senderEmail = YHelper::yiisettingSenderEmail('rating_email', Yii::app()->name);

        $this->body = preg_replace('~\[:mark\]~', $mark, $this->body);
        echo $user->id; die();
        $this->body = $this->changeAttr($user, $this->body);

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    public function restoreReportEmail($user)
    {
        $this->subject = YHelper::yiisetting('rating_email', Yii::app()->name.' you\'ve been reported', true);
        $this->body = YHelper::yiisetting('rating_email');
        $senderEmail = YHelper::yiisettingSenderEmail('rating_email', Yii::app()->name);
        $body = $this->changeAttr($user, $this->body);

        $this->sendEmail($this->subject, $body, $user->email, $senderEmail);
    }

    private function changeAttr($user, $body)
    {
        $body = preg_replace('~\[:first_name\]~', $user->name, $body);
        $body = preg_replace('~\[:last_name\]~', $user->surname, $body);
        $body = preg_replace('~\[:rating\]~', $user->rating, $body);
        $body = preg_replace('~\[:level\]~', $user->level, $body);

        return $body;
    }

    public function sendEmail($subject, $body, $to, $senderEmail = null)
    {
        $to = explode(',', $to);
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->From = $senderEmail;
        $mailer->AddReplyTo(Yii::app()->params['no-replyEmail']);

        foreach($to as $toEmail)
            $mailer->AddAddress($toEmail);

        $mailer->FromName = Yii::app()->name;
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $subject;
        $mailer->IsHTML(true);  // set email format to HTML
        $mailer->Body = $body;

        if($mailer->Send())
            return true;
        else
            return false;
    }
}