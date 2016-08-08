<?php
Yii::import('backend.components.multiapload.*');

class UserController extends Frontend
{
    private $cerId;

    public function actions()
    {
        return array(
            'upload' => 'UploadAction',
            'imagedel'=>'ImagedelAction',
        );
    }

    public function createModel()
    {
        return new User();
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('recover', 'updateMailPassword', 'citySearch'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('cabinet', 'additem', 'deleteitem', 'upload', 'imagedel', 'download', 'userRow', 'userAssoc', 'deleteRelation', 'deleteAssoc'),
                'expression'=>'CAuthHelper::isUsersCAbinet()',
            ),
            array('allow',
                'actions'=>array('rating'),
                'expression'=>'CAuthHelper::hasRightToVote()',
            ),
            array('allow',
                'actions'=>array('completedProject', 'deleteComplete'),
                'expression'=>'CAuthHelper::isUseresProject($_GET["id"])',
            ),
            array('allow',
                'actions'=>array('info'),
                'expression'=>'CAuthHelper::isIssetExpert($_GET["id"])',
            ),
            array('allow',
                'actions'=>array('index', 'updatePassword', 'report', 'ratingDescr'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionDownload($fileName){
        $file = MultipleImages::model()->findByAttributes(array('hash_path' => $fileName));
        if(!$file)
            throw new CHttpException(404, 'This file does not exist.');

        $filepath = $file->path;
        $fpath = explode("/", $filepath);
        $fileName = end($fpath);

        if (file_exists($filepath))
            return Yii::app()->getRequest()->sendFile($fileName, @file_get_contents($filepath));
        else
            throw new CHttpException(404, 'This file does not exist.');
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
        $this->render('info', array('user' => $user));
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

    public function actionCompletedProject($id = null)
    {
        if(Yii::app()->request->isPostRequest) {
            $model = isset($id) ? CompletedProjects::model()->findByPk($id) : new CompletedProjects();

            if (isset($_POST['ajax'])) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if (isset($_POST["CompletedProjects"])) {
                $model->attributes = $_POST["CompletedProjects"];

                if ($model->save()) {
                    $this->redirect(Yii::app()->request->urlReferrer);
                }
            }
        }
        throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionUpdateMailPassword()
    {
        $a = @Yii::app()->session['pass'][Yii::app()->session['passver']];
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
                if($model->update()) {
                    unset(Yii::app()->session['passver']);
                    Yii::app()->user->setFlash('project_success', Yii::t("base", "Your password has been changed successfully!"));
                }

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

            if ($user && !empty($index)) {
                $log = new RatingLog();
                $log->who_vote = Yii::app()->user->id;
                $log->who_received = $user->id;
                $log->num = $index;
                if($log->save())
                    Yii::app()->ajax->success($user->rating);
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

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            $pass = $model->GenerateStr();
            $a = CHtml::link('Password recovery',$this->createAbsoluteUrl("user/recover/$pass"));

            $body = "You can change your password by following this link ".$a;
            $subject = "Password Recovery Form ".Yii::app()->name;
            $email = $model->email;

            if($model->sendEmail($subject, $body, $email)) {
                Yii::app()->session['pass'] = array($pass => $model->email);
                Yii::app()->session['passver'] =  $pass;
                Yii::app()->user->setFlash('project_success', Yii::t("base", "On your mailbox has been sent a letter with a link to the password change page."));
            } else {
                Yii::app()->user->setFlash('project_success', Yii::t("base", "Could not send email."));
            }
        } elseif (!empty($pass)) {
            if (!isset(Yii::app()->session['passver']))
                Yii::app()->session['passver'] = '';

            if ($pass == Yii::app()->session['passver']) {
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

    public function actionDeleteRelation() {
        $id = (int)$_POST["id"];
        $model = UserReference::model()->findByAttributes(array('user_initiator' => Yii::app()->user->id, 'user_receiver' => $id));

        if($model)
            if($model->delete())
                Yii::app()->ajax->success();
        else
            Yii::app()->ajax->failure();
    }

    public function actionDeleteComplete() {
        $id = (int)$_POST["id"];
        $model = CompletedProjects::model()->findByPk($id);

        if($model)
            if($model->delete())
                Yii::app()->ajax->success();
            else
                Yii::app()->ajax->failure();
    }

    public function actionDeleteAssoc() {
        $id = (int)$_POST["id"];
        $model = UserAssociation::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'association_id' => $id));

        if($model)
            if($model->delete())
                Yii::app()->ajax->success();
            else
                Yii::app()->ajax->failure();
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

    public function actionRatingDescr($id)
    {
        $model = RatingLog::model()->find('who_vote = :who_vote AND who_received = :who_received', array(':who_vote' => Yii::app()->user->id, ':who_received' => $id));
        $model->scenario = "retingDesc";

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'rating-description') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST["RatingLog"])) {
            $model->attributes = $_POST["RatingLog"];

            if($model->save()) {
                Yii::app()->user->setFlash('project_success', Yii::t("base", "Thank you for rating."));
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        } else
            throw new CHttpException(404, Yii::t('base', 'Page does not exist'));
    }

    public function actionCitySearch()
    {
        if (!Yii::app()->getRequest()->getQuery('q')) {
            throw new CHttpException(404);
        }

        $country = Yii::app()->getRequest()->getQuery('country') ? : false;

        $criteria = new CDbCriteria;
        $criteria->condition = 'city_name_ASCII LIKE :q';

        if($country) {
            $criteria->addCondition("country = :country");
            $criteria->params[':country'] = $country;
        }

        $criteria->limit = 100;
        $criteria->params[':q'] = '%'.Yii::app()->getRequest()->getQuery('q').'%';

        $model = Cities::model()->findAll($criteria);

        $data = [];
        foreach ($model as $city) {
            $data[] = [
                'id' => $city->geonameid,
                'name' => $city->city_name_ASCII,
            ];
        }

        Yii::app()->ajax->raw($data);
    }

    public function actionUserRow($user_receiver)
    {
        $modelReceiver = User::model()->findByPk($user_receiver);

        if($modelReceiver) {
            $check = UserReference::model()->count(array('condition' => 'user_initiator = :user_initiator && user_receiver = :user_receiver', 'params' => array(':user_initiator' => Yii::app()->user->id, ':user_receiver' => $modelReceiver->id)));

            if(!$check) {
                $reference = new UserReference();
                $reference->user_initiator = Yii::app()->user->id;
                $reference->user_receiver = $modelReceiver->id;
                if($reference->save()) {
                    $ret = $this->renderPartial('li_element', array('modelReceiver' => $modelReceiver), true);
                    Yii::app()->ajax->raw($ret);
                }
            }
        } else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionUserAssoc($user_assoc)
    {
        $modelReceiver = AssociationMembership::model()->findByPk($user_assoc);

        if($modelReceiver) {
            $check = UserAssociation::model()->count(array('condition' => 'user_id = :user_id && association_id = :association_id', 'params' => array(':user_id' => Yii::app()->user->id, ':association_id' => $modelReceiver->id)));

            if(!$check) {
                $reference = new UserAssociation();
                $reference->user_id = Yii::app()->user->id;
                $reference->association_id = $modelReceiver->id;
                if($reference->save()) {
                    $ret = $this->renderPartial('li_assoc', array('modelReceiver' => $modelReceiver), true);
                    Yii::app()->ajax->raw($ret);
                }
            }
        } else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
}