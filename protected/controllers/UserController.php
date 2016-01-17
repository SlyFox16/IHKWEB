<?php

class UserController extends Frontend
{
    private $cerId;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('recover', 'updateMailPassword'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('cabinet', 'additem', 'deleteitem'),
                'expression'=>'CAuthHelper::isUsersCAbinet()',
            ),
            array('allow',
                'actions'=>array('rating'),
                'expression'=>'CAuthHelper::hasRightToVote()',
            ),
            array('allow',
                'actions'=>array('info'),
                'expression'=>'CAuthHelper::isIssetExpert($_GET["id"])',
            ),
            array('allow',
                'actions'=>array('index', 'updatePassword', 'report'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionCabinet()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if($user->certificates)
            $certificates = $user->certificates;
        else
            $certificates[] = new UserCertificate();

        $user->scenario = 'userupdate';

        //=================================================================

        if (isset($_POST['ajax']) && $_POST['ajax'] == 'cabinet-form') {
            $cert = array();
            if (isset($_POST['UserCertificate'])) {
                foreach ($_POST['UserCertificate'] as $key => $value) {
                    $cert[$key] = new UserCertificate('check');
                }
            }
            $f1 = json_decode(CActiveForm::validate($user), 1);
            $f2 = json_decode(CActiveForm::validateTabular($cert), 1);
            echo json_encode(array_merge($f1, $f2));
            Yii::app()->end();
        }

        //=================================================================

        if (isset($_POST["User"])) {
            $user->attributes = $_POST["User"];
            if($user->save()) {
                Yii::app()->user->setFlash('project_success', Yii::t("base","Your profile was updated."));
                $this->redirect($this->createUrl('/user/cabinet'));
            }
        }

        $this->render('cabinet', array('user' => $user, 'certificates' => $certificates));
    }

    public function actionInfo($id)
    {
        $user = User::model()->findByPk($id);
        $log = RatingLog::model()->findByAttributes(array('who_vote' => Yii::app()->user->id, 'who_received' => $user->id));

        $this->render('info', array('user' => $user, 'log' => $log));
    }

    public function actionUpdatePassword()
    {
        $model=User::model()->findByPk(Yii::app()->user->id);

        $model->scenario = 'updatepassword';
        $model->password = '';

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'changepass-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate()) {

                // Generating Password
                $salt = $model->generateSalt();
                $password = $model->hashPassword($model->password, $salt);

                if($model->save()){
                    $model->password = $password;
                    $model->salt = $salt;
                    if($model->update()) {
                        Yii::app()->user->setFlash('project_success', 'You have successfully changed your password!');
                        $this->redirect('/user/cabinet');
                    }
                }
            }
        }
        else
            throw new CHttpException(404, Yii::t('base', 'Page does not exist'));
    }

    public function actionUpdateMailPassword()
    {
        $a = Yii::app()->session['pass'][Yii::app()->session['passver']];
        if(isset($a))
        {
            $model=User::model()->findByAttributes(array('email' => $a));

            $model->scenario = 'updatepassword';
            $model->password = '';

            if (isset($_POST['ajax']) && $_POST['ajax'] === 'changepass-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if (isset($_POST['User'])) {
                $model->attributes = $_POST['User'];
                // Generating Password
                $salt = $model->generateSalt();
                $password = $model->hashPassword($model->password, $salt);

                $model->password = $password;
                $model->salt = $salt;
                if($model->update())
                    Yii::app()->user->setFlash('project_success', Yii::t("base", "Your password has been changed successfully!"));

                $this->redirect(Yii::app()->homeUrl);
            }

            $this->render("updatepass",array("model"=>$model));
        } else
            throw new CHttpException(404, Yii::t('base', 'Page does not exist'));
    }

    public function actionRating()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $username = Yii::app()->request->getPost('username');
            $index = (int) Yii::app()->request->getPost('index');

            $user = User::model()->findByAttributes(array('username' => $username));

            if ($user && !empty($index))
            {
                if($user->rating == 0)
                    $user->rating = $user->rating + $index;
                else
                    $user->rating = round(($user->rating + $index)/2, 1);
                if($user->update()) {

                    $log = new RatingLog();
                    $log->who_vote = Yii::app()->user->id;
                    $log->who_received = $user->id;
                    $log->num = $index;
                    $log->save();

                    echo $user->rating;
                }
            } else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            Yii::app()->end();
        }
    }

    public function actionAdditem()
    {
        if (Yii::app()->request->isAjaxRequest) {

            $ret = array();
            $count = (int) $_GET['count'];

            if(!is_int($count)) throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

            Yii::app()->clientScript->scriptMap = array(
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.ba-bbq.js' => false,
            );

            $certificate = new UserCertificate();

            $ret['responce'] = $this->renderPartial('add', array('count' => $count, 'certificate' => $certificate), true, false);
            echo json_encode($ret);
            Yii::app()->end();
        }
    }

    public function actionDeleteitem()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $count = (int) $_GET['attr'];

            if(!is_int($count)) throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

            $deleteModel = UserCertificate::model()->findByAttributes(array('id' => $count, 'user_id' => Yii::app()->user->id));
            if($deleteModel->delete())
                $ret = true;
            else
                $ret = false;

            echo json_encode($ret);
            Yii::app()->end();
        }
    }

    public function actionRecover($pass = null)
    {
        $model = new User('changepassword');

        if (isset($_POST['ajax']) && ($_POST['ajax'] === 'recover-form')) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];

            $pass = $model->GenerateStr();
            $a = CHtml::link('Password recovery',$this->createAbsoluteUrl("user/recover/$pass"));

            $body = "You can change your password by following this link ".$a;
            $subject = "Password Recovery Form ".Yii::app()->name;
            $email = $model->email;

            if($model->sendEmail($subject, $body, $email)) {
                Yii::app()->session['pass'] = array($pass => $model->email);
                Yii::app()->session['passver'] =  $pass;
                Yii::log($pass, "error");
                Yii::app()->user->setFlash('project_success', Yii::t("base", "On your mailbox has been sent a letter with a link to the password change page."));
            } else {
                Yii::app()->user->setFlash('project_success', Yii::t("base", "Could not send email."));
            }
        } elseif(!empty($pass)) {
            if (!isset(Yii::app()->session['passver']))
                Yii::app()->session['passver'] = '';

            if ($_GET['pass'] == Yii::app()->session['passver']) {
                Yii::app()->user->setFlash('mail_recover', true);
                $this->redirect(Yii::app()->homeUrl);
            }
            else
                Yii::app()->user->setFlash('project_error', Yii::t("base", "This link has been expired or incorrect."));
        }
        else
            throw new CHttpException(404, Yii::t('base', 'Page does not exist'));

        $this->redirect($this->createUrl('/site/login'));
    }

    public function actionReport()
    {
        $model = new Report();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'report-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST["Report"])) {
            $model->attributes = $_POST["Report"];

            if($model->save()) {
                Yii::app()->user->setFlash('project_success', Yii::t("base", "Your opinion will be taken into consideration."));
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        } else
            throw new CHttpException(404, Yii::t('base', 'Page does not exist'));
    }
}