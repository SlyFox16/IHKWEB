<?php
/**
 * Created by Idol IT.
 * Date: 9/29/12
 * Time: 5:44 PM
 */

class DefaultController extends BackendController
{

    public $sidebar_tab = "dashboard";

    public function actionIndex()
    {
        $this->render("dashboard");
    }

    public function actionError()
    {
        $this->layout = "/layouts/layout_error";

        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->layout = "/layouts/layout_login";
        $model = new BackendLoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['BackendLoginForm'])) {
            $model->attributes = $_POST['BackendLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->isStaffAndNotSuspended() && $model->login()) {
                $this->redirect("/backend");
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->getModule('backend')->user->loginUrl);
    }

    public function actionMailAll(){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '64M');

        $model = new MailAll();

        // if it is ajax validation request
        if (isset($_POST['MailAll'])) {
            $model->attributes = $_POST['MailAll'];
            if ($model->validate()) {
                $users = User::model()->findAll('expert_confirm = 1');
                if($users) {
                    $countUsers = count($users);
                    $usersEmail = array();
                    foreach($users as $user)
                        $usersEmail[] = $user->email;

                    if ($this->sendEmail($model->subject, $model->body, $usersEmail, $model->senderEmail)) {
                        Yii::app()->user->setFlash('success', "All mails were successfully sent.");
                        $this->refresh();
                    } else
                        Yii::app()->user->setFlash('success', "Oops, something went wrong.");
                }
            }
        }

        $this->render('mailAll', array('model' => $model));
    }
}