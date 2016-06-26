<?php

class SiteController extends Frontend
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
            'webhook' => 'application.components.Webhook',
		);
	}

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('login', 'index', 'register', 'webhook', 'error', 'search', 'uLogin', 'xing', 'feedback', 'suggest', 'associationSuggest', 'seekerRegister', 'seekerConfirmation', 'certificateView'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('logout', 'findexperts'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionChange()
    {
        if (isset($_GET['lang'])) {
            Yii::app()->session['language'] = $_GET['lang'];
        }

        if (isset(Yii::app()->session['language']))
        {
            $cookie = new CHttpCookie('language', $_GET['lang']);
            $cookie->expire = time() + (60*60*24*365); // (1 year)
            Yii::app()->request->cookies['language'] = $cookie;

            Yii::app()->language = Yii::app()->session['language'];
            Yii::app()->user->setState('language', $_GET['lang']);
        }

        $this->redirect($this->urltrans(Yii::app()->request->urlReferrer));
    }


    /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $randUsers = User::model()->expert_confirm()->findAll(array('order' => 'RAND()', 'limit' => 10));
        $this->render('index', array('randUsers' => $randUsers));
	}

    public function actionCertificateView($id)
    {
        $certificate = Certificates::model()->findByPk($id);
        $this->render('certificate_view', array('certificate' => $certificate));
    }

    public function actionXing()
    {
        Yii::app()->user->setFlash('xing', true);
        $this->redirect(Yii::app()->homeUrl);
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error = Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    public function actionLogin()
    {
        if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->homeUrl);

        $model = Yii::createComponent('application.models.LoginForm');

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->homeUrl);
        }

        $this->render('login', array('model' => $model));
    }

    /** Socials Login Action **/
    public function actionULogin()
    {
        if (isset($_POST['token'])) {
            $ulogin = new UloginModel();
            $ulogin->token = $_POST['token'];
            $ulogin->getAuthData();
            if ($ulogin->validate() && $ulogin->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            } else
                throw new CHttpException(400,Yii::t("base","The requested page does not exist!"));
        } else
            $this->redirect(Yii::app()->homeUrl, true);
    }

    public function actionRegister()
    {
        if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->homeUrl);
        $register_form = new User();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
            echo CActiveForm::validate($register_form);
            Yii::app()->end();
        }

        if (isset($_POST["User"])) {
            $register_form->attributes = $_POST["User"];
            $register_form->username = $register_form->name.$register_form->surname.rand(1, 999);

            $register_form->is_active = 1;
            if($register_form->save()) {
                $subject = YHelper::yiisetting('register_email', 'Ihk.com register', true);
                $body = YHelper::yiisetting('register_email');

                Yii::app()->email->sendEmail($subject, $body, $register_form->email);
                $login = Yii::createComponent('application.models.LoginForm');
                $login->email = $register_form->email;
                $login->password = $_POST["User"]['password'];
                if($login->autoLogin()) {
                    Yii::app()->user->setFlash('user_register', Yii::t("base","Congratulations! You have registered successfully!"));
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
        }

        $this->render('register', array('register_form' => $register_form));
    }

    public function actionSeekerRegister()
    {
        if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->homeUrl);
        $register_form = new User('seeker');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'seeker-form') {
            echo CActiveForm::validate($register_form);
            Yii::app()->end();
        }

        if (isset($_POST["User"])) {
            $register_form->attributes = $_POST["User"];
            $register_form->username = $register_form->name.$register_form->surname.rand(1, 999);
            $register_form->is_seeker = 1;
            $register_form->seeker_pass = $register_form->GenerateStr();

            if($register_form->save()) {
                $a = CHtml::link('Seeker Confirmation', $this->createAbsoluteUrl("site/seekerConfirmation", array('id' => $register_form->seeker_pass)));

                $body = "You've just logged in as seeker. Please confirm your registration by following this link ".$a;
                $subject = "Seeker Login Confirmation ".Yii::app()->name;

                if($register_form->sendEmail($subject, $body, $register_form->email)) {
                    Yii::app()->user->setFlash('seeker', true);
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
        }

        $this->render('seeker_register', array('register_form' => $register_form));
    }

    public function actionSeekerConfirmation($id)
    {
        $user = User::model()->find('seeker_pass = :id', array(':id' => $id));
        if(!$user) throw new CHttpException(404,Yii::t("base","Ups! Wrong link!"));

        if($user->is_active) {
            Yii::app()->user->setFlash('project_success', Yii::t("base","You are already confirmed!"));
            $this->redirect(array('site/login'));
            Yii::app()->end;
        }

        $user->is_active = 1;
        if($user->update()) {
            Yii::app()->user->setFlash('project_success', Yii::t("base","Congratulations! You have registered successfully!"));
            $this->redirect(array('site/login'));
        } else
            throw new CHttpException(500,Yii::t("base","Ups! Something went wrong!"));
    }

    /**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionSwitch()
    {
        if(Yii::app()->request->isPostRequest)
        {
            if($_POST['dashboard']) {
                $var = filter_var($_POST['dashboard'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

                $user = User::model()->findByPk(Yii::app()->user->id);
                if($user) {
                    $user->menu_pin = $var;
                    $user->update();
                }
            }
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionSuggest(){
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = User::model()->suggestTag($_GET['term']);
            $result = array();
            foreach ($models as $m) {
                if(isset($m->cities0->city_name_ASCII))
                    $result[] = array(
                        'label' => $m->name." ".$m->surname." (".$m->cities0->city_name_ASCII.")",
                        'value' => $m->name." ".$m->surname." (".$m->cities0->city_name_ASCII.")",
                        'id' => $m->id,
                    );
                else
                    $result[] = array(
                        'label' => $m->name." ".$m->surname,
                        'value' => $m->name." ".$m->surname,
                        'id' => $m->id,
                    );
            }

            echo CJSON::encode($result);
        }
    }

    public function actionAssociationSuggest(){
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $crt = new CDbCriteria;
            $crt->condition = "name LIKE :req";
            $crt->params[":req"] = '%'.strtr($_GET['term'], array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';

            $models = AssociationMembership::model()->findAll($crt);
            $result = array();
            foreach ($models as $m) {
                $result[] = array(
                    'label' => $m->name,
                    'id' => $m->id,
                );
            }

            echo CJSON::encode($result);
        }
    }

    public function actionFindexperts()
    {
        $model = new User();

        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('findexperts', array('model' => $model));
    }

    public function actionFeedback()
    {
        $model = new Feedback();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'feedback-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST["Feedback"])) {
            $model->attributes = $_POST["Feedback"];

            if($model->save()) {
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        $this->render('feedback', array('model' => $model));
    }
}