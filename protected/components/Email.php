<?php
class Email extends CApplicationComponent
{
    public $subject;
    public $body;

    public function passEmail($user)
    {
        $this->subject = YHelper::yiisetting('change_pass_email', Yii::app()->name, true);
        $this->body = YHelper::yiisetting('change_pass_email');
        $senderEmail = YHelper::yiisettingSenderEmail('change_pass_email');

        $this->body = $this->changeAttr($user, $this->body);
        $this->subject = $this->changeAttr($user, $this->subject);

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    public function ratingEmail($user, $mark)
    {
        $this->subject = YHelper::yiisetting('rating_email', Yii::app()->name, true);
        $this->body = YHelper::yiisetting('rating_email');
        $senderEmail = YHelper::yiisettingSenderEmail('rating_email');

        $this->body = preg_replace('~\[:mark\]~', $mark, $this->body);
        $this->subject = preg_replace('~\[:mark\]~', $mark, $this->subject);

        $this->body = $this->changeAttr($user, $this->body);
        $this->subject = $this->changeAttr($user, $this->subject);

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    public function gotMessage($message)
    {
        $user = User::model()->findByPk($message->receiver_id);
        $sender = User::model()->findByPk($message->sender_id);

        $this->subject = YHelper::yiisetting('message_email', Yii::app()->name, true);
        $this->body = YHelper::yiisetting('message_email');
        $senderEmail = YHelper::yiisettingSenderEmail('message_email');

        $this->body = preg_replace('~\[:message\]~', $message->body, $this->body);
        $this->subject = preg_replace('~\[:message\]~', $message->body, $this->subject);

        if ($user) {
            $this->body = $this->changeAttr($user, $this->body);
            $this->subject = $this->changeAttr($user, $this->subject);
        }

        if ($sender) {
            $this->body = preg_replace('~\[:sender_first_name\]~', $sender->name, $this->body);
            $this->subject = preg_replace('~\[:sender_first_name\]~', $sender->name, $this->subject);

            $this->body = preg_replace('~\[:sender_last_name\]~', $sender->surname, $this->body);
            $this->subject = preg_replace('~\[:sender_last_name\]~', $sender->surname, $this->subject);
        }

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    public function reportEmail($user)
    {
        $this->subject = YHelper::yiisetting('report_email', Yii::app()->name, true);
        $this->body = YHelper::yiisetting('report_email');
        $senderEmail = YHelper::yiisettingSenderEmail('report_email');

        $this->body = $this->changeAttr($user, $this->body);
        $this->subject = $this->changeAttr($user, $this->subject);

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    public function expert_added_to_event_email($user, $event)
    {
        $this->subject = YHelper::yiisetting('expert_added_to_event_email', Yii::app()->name, true);
        $this->body = YHelper::yiisetting('expert_added_to_event_email');
        $senderEmail = YHelper::yiisettingSenderEmail('expert_added_to_event_email');

        $this->body = $this->changeAttr($user, $this->body);
        $this->subject = $this->changeAttr($user, $this->subject);

        $this->body = $this->eventParams($event, $this->body);
        $this->subject = $this->eventParams($event, $this->subject);

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    public function event_was_confirmed_email($user, $event)
    {
        $this->subject = YHelper::yiisetting('event_was_confirmed_email', Yii::app()->name, true);
        $this->body = YHelper::yiisetting('event_was_confirmed_email');
        $senderEmail = YHelper::yiisettingSenderEmail('event_was_confirmed_email');

        $this->body = $this->changeAttr($user, $this->body);
        $this->subject = $this->changeAttr($user, $this->subject);

        $this->body = $this->eventParams($event, $this->body);
        $this->subject = $this->eventParams($event, $this->subject);

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    public function four_days_event_email($user, $event)
    {
        $this->subject = YHelper::yiisetting('4_days_event_email', Yii::app()->name, true);
        $this->body = YHelper::yiisetting('4_days_event_email');
        $senderEmail = YHelper::yiisettingSenderEmail('4_days_event_email');

        $this->body = $this->changeAttr($user, $this->body);
        $this->subject = $this->changeAttr($user, $this->subject);

        $this->body = $this->eventParams($event, $this->body);
        $this->subject = $this->eventParams($event, $this->subject);

        $this->sendEmail($this->subject, $this->body, $user->email, $senderEmail);
    }

    private function changeAttr($user, $body)
    {
        $body = preg_replace('~\[:first_name\]~', $user->name, $body);
        $body = preg_replace('~\[:last_name\]~', $user->surname, $body);
        $body = preg_replace('~\[:rating\]~', $user->rating, $body);
        $body = preg_replace('~\[:level\]~', $user->level, $body);

        return $body;
    }

    private function eventParams($event, $body)
    {
        $body = preg_replace('~\[:event_title\]~', $event->title, $body);
        $body = preg_replace('~\[:event_date\]~', $event->date, $body);
        $body = preg_replace('~\[:vent_country\]~', User::getCityCountry($event->country_id, 'country'), $body);
        $body = preg_replace('~\[:event_city\]~', User::getCityCountry($event->city_id, 'city'), $body);
        $body = preg_replace('~\[:event_address\]~', $event->address, $body);

        return $body;
    }

    public function sendEmail($subject, $body, $to, $senderEmail = null)
    {
        if (!is_array($to)) $to = explode(',', $to);
        $senderEmail = $senderEmail ? : Yii::app()->params['no-replyEmail'];

        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->From = Yii::app()->params['no-replyEmail'];
        $mailer->AddReplyTo($senderEmail);

        foreach($to as $toEmail)
            $mailer->AddAddress($toEmail);

        $mailer->FromName = YHelper::yiisetting('email_title', Yii::app()->name);
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
