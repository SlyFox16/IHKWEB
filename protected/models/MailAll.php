<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class MailAll extends CFormModel
{
    public $subject;
    public $body;
    public $sender_email;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('subject, sender_email', 'length', 'max'=>255),
            array('subject, body, sender_email', 'required'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'subject' => Yii::t("base", 'Subject'),
            'sender_email' => Yii::t("base", 'Sender Email'),
            'body' => Yii::t("base", 'Message'),
        );
    }
}
