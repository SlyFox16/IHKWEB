<?php

class NotifyCommand extends CConsoleCommand {
    public function run($args) {
        $tasks = Task::model()->findAll('emailsend = 0');

        if($tasks) {
            $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
            $mailer->From = Yii::app()->name;
            $mailer->AddReplyTo(Yii::app()->params['no-replyEmail']);
            $mailer->AddAddress(Yii::app()->params['adminEmail']);
            $mailer->FromName = Yii::app()->name;
            $mailer->CharSet = 'UTF-8';
            $mailer->Subject = 'Новые задания';
            $mailer->IsHTML(true);  // set email format to HTML
            $mailer->Body = CConsoleCommand::renderFile(Yii::getPathOfAlias('application.views.site.emailNotification.renderEmail'). '.php', array('tasks' => $tasks), true);

            if($mailer->Send()) {
                echo 'Email sent'."\r\n";
                return true;
            }
        }
    }
}