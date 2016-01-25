<?php
class Email extends CApplicationComponent
{
    public function sendEmail($subject, $body, $to) {
        $to = explode(',', $to);

        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->From = Yii::app()->name;
        $mailer->AddReplyTo(Yii::app()->params['no-replyEmail']);

        foreach($to as $toEmail)
            $mailer->AddAddress($toEmail);

        $mailer->FromName = Yii::app()->name;
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $subject;
        $mailer->IsHTML(true);  // set email format to HTML
        $mailer->Body = $body;

        if($mailer->Send()) {
            return true;
        } else {
            return false;
        }
    }
}