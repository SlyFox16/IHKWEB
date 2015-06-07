<?php

class UserController extends Frontend
{
    private $userId;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('recover', 'rating'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('cabinet'),
                'expression'=>'CAuthHelper::isUsersCAbinet($_GET["id"])',
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

    public function actionCabinet($id)
    {
        $user = User::model()->findByPk($id);
        $user->scenario = 'userupdate';

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cabinet-form') {
            echo CActiveForm::validate($user);
            Yii::app()->end();
        }

        if (isset($_POST["User"])) {
            $user->attributes = $_POST["User"];
            if($user->save()) {
                Yii::app()->user->setFlash('project_success', Yii::t("base","Поздравляем! Вы успешно создали проект!!"));
            }
        }

        $this->render('cabinet', array('user' => $user));
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
            if(!$user)
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

            if ($user && !empty($index))
            {
                if($user->rating == 0)
                    $user->rating = $user->rating + $index;
                else
                    $user->rating = round(($user->rating + $index)/2, 2);
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
}