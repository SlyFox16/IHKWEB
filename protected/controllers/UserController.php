<?php

class UserController extends Frontend
{
    private $cerId;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('recover'),
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
                'actions'=>array('index', 'updatePassword'),
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
                Yii::app()->user->setFlash('project_success', Yii::t("base","Поздравляем! Вы успешно создали проект!!"));
                $this->redirect('/user/cabinet');
            }
        }

        //Yii::app()->clientScript->registerScript('popoverActivate',"$('.datepicker').datepicker();");
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
                        Yii::app()->user->setFlash('project_success', 'Вы успешно сменили пароль!');
                        $this->redirect('/user');
                    }
                }
            }
        }
        else
            throw new CHttpException(404, Yii::t('base', 'Страницы не существует'));
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

            $ret = array();
            $count = (int) $_GET['attr'];

            if(!is_int($count)) throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

            $id = UserCertificate::model()->findByAttributes(array('id' => $count, 'user_id' => Yii::app()->user->id));
            $ret = $id ? true : false;
            echo json_encode($ret);
            Yii::app()->end();
        }
    }
}