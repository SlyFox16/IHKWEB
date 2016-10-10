<?php

class EventController extends Frontend
{
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('create'),
                'expression'=>'CAuthHelper::hasExpertRights()',
            ),
            array('allow',
                'actions'=>array('update', 'addMember', 'deleteRelation', 'delete'),
                'expression'=>'CAuthHelper::isUsersEvent(@$_GET["id"])',
            ),
            array('allow',
                'actions'=>array('view'),
                'expression'=>'CAuthHelper::eventExists(@$_GET["id"])',
            ),
            array('allow',
                'actions'=>array('eventList'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionCreate()
    {
        $model = new Event();
        $model->temp_id = Yii::app()->request->getPost('temp_id', $model->id);

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'event-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST["Event"])) {
            $model->attributes = $_POST["Event"];

            if($model->save()) {
                $this->redirect('/event/eventList');
            } else
                echo CHtml::errorSummary($model);
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Event::model()->findByPk($id);

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'event-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST["Event"])) {
            $model->attributes = $_POST["Event"];

            if($model->save()) {
                $this->redirect('/event/eventList');
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
            return true;
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionView($id)
    {
        $model = Event::model()->findByPk($id);
        $this->render('view', array('model' => $model));
    }

    public function actionEventList()
    {
        $events = Event::model()->findAll('active = 1');
        $this->render('list', array('events' => $events));
    }

    public function actionDeleteRelation() {
        $event_id = Yii::app()->request->getParam('event_id');
        $user_id = Yii::app()->request->getParam('user_id');

        $model = EventMembers::model()->findByAttributes(array('event_id' => $event_id, 'user_id' => $user_id));

        if($model)
            if($model->delete())
                Yii::app()->ajax->success();
            else
                Yii::app()->ajax->failure();
    }

    public function actionAddMember()
    {
        $event_id = Yii::app()->request->getParam('event_id');
        $user_id = Yii::app()->request->getParam('user_id');

        $memberUser = User::model()->findByPk($user_id);

        if($memberUser) {
            $check = EventMembers::model()->count(array('condition' => 'event_id = :event_id && user_id = :user_id', 'params' => array(':event_id' => $event_id, ':user_id' => $user_id)));

            if(!$check) {
                $reference = new EventMembers();
                $reference->event_id = $event_id;
                $reference->user_id = $user_id;
                if($reference->save()) {
                    $ret = $this->renderPartial('/user/li_element', array('modelReceiver' => $memberUser), true);
                    Yii::app()->ajax->raw($ret);
                }
            }
        } else
            throw new CHttpException(400, Yii::t("base", 'Invalid request. Please do not repeat this request again.'));
    }

    public function loadModel($id)
    {
        $model=Event::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}