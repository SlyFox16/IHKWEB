<?php

class UserController extends Frontend
{
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('recover'),
                'users'=>array('*'),
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
}