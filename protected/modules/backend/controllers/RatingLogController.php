<?php

class RatingLogController extends BackendController
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
		$model=new RatingLog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RatingLog']))
		{
			$model->attributes=$_POST['RatingLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['RatingLog']))
		{
			$model->attributes=$_POST['RatingLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionUCUpdate()
    {
        if(Yii::app()->request->isPostRequest)
        {
            $pk = Yii::app()->request->getPost('pk');
            $name = Yii::app()->request->getPost('name');
            $value = Yii::app()->request->getPost('value');

            $model = RatingLog::model()->findByPk($pk);
            $model->$name = $value;

            if($model->save(true, array($name))) {
                if ($name == 'confirmed' && $value == 1)
                    Yii::app()->email->ratingEmail($model->whoReceived, $model->num);

                echo CJSON::encode(array('id' => $model->primaryKey));
            } else {
                $errors = array_map(function($v){ return join(', ', $v); }, $model->getErrors());
                echo CJSON::encode(array('errors' => $errors));
            }
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
	public function actionAdmin($param = null)
	{
		$model=new RatingLog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RatingLog']))
			$model->attributes=$_GET['RatingLog'];

		$this->render('admin',array(
			'model'=>$model,
            'param' => $param
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=RatingLog::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='rating-log-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
