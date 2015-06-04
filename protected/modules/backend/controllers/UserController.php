<?php

class UserController extends BackendController
{
    public $sidebar_tab = "users";
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new User;
        $model->unsetAttributes();
        if(isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }



    /**
     * Manages all models.
     */
    public function actionAdminMembers()
    {
        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('adminMembers',array(
            'model'=>$model,
        ));
    }

    public function actionAdminStaff()
    {
        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('adminStaff',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionUpdatePassword($id){

        $model = User::model()->findByPk($id);
        $model->scenario = 'updatepassword';
        $model->password = '';

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate()) {

                // Generating Password
                $salt = $model->generateSalt();
                $password = $model->hashPassword($model->password, $salt);

                if($model->save()){
                    $model->password = $password;
                    $model->salt = $salt;
                    $model->update();
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render("update_password",array("model"=>$model));
    }

    public function actionChangeBallance()
    {
        $model = new User('changeBallance');

        if (isset($_POST['ajax']) && $_POST['ajax'] == 'change-balance-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if (isset($_POST['User'])) {
            $alreadyUser = User::model()->findByPk($_POST['User']['id']);
            if ($alreadyUser) {
                $oldBalance = $alreadyUser->balance;
                $alreadyUser->attributes = $_POST['User'];
                if ($alreadyUser->update()) {

                    $log = new BalanceLog();
                    $log->who_changed = Yii::app()->user->id;
                    $log->whom_changed = $alreadyUser->id;
                    $log->old_balance = $oldBalance;
                    $log->new_balance = $alreadyUser->balance;
                    $log->comment = $alreadyUser->comment;
                    $log->save();

                    $this->redirect(Yii::app()->request->urlReferrer);
                }
            } else
                throw new CHttpException(404, Yii::t('base', 'Нет такого пользователя'));
        } else
            throw new CHttpException(404, Yii::t('base', 'Страницы не существует'));
    }
}