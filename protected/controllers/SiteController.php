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
                'actions'=>array('login', 'index', 'register', 'webhook', 'error', 'search', 'uLogin', 'findexperts', 'xing', 'feedback', 'suggest', 'seekerRegister'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('logout'),
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
        $randUsers = User::model()->user()->is_active()->expert_confirm()->findAll(array('order' => 'RAND()', 'limit' => 10));
        $this->render('index', array('randUsers' => $randUsers));
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
                throw new CHttpException(400,Yii::t("base","Запрашиваемая страница не существует!"));
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
                $login = Yii::createComponent('application.models.LoginForm');
                $login->email = $register_form->email;
                $login->password = $_POST["User"]['password'];
                if($login->autoLogin()) {
                    Yii::app()->user->setFlash('user_register', Yii::t("base","Congratulations! You have registered successfully!"));
                    $this->redirect(Yii::app()->homeUrl);
                }

            }
        }

        $this->render('seeker_register', array('register_form' => $register_form));
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
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->name." ".$m->surname,
                    'value' => $m->name." ".$m->surname,
                    'id' => $m->id,
                );

            echo CJSON::encode($result);
        }
    }

    public function actionFindexperts()
    {
        $model = new User();
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