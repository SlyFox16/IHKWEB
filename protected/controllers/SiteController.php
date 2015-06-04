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
        $this->render('index');
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

    public function actionRegister()
    {
        $register_form = new User();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
            echo CActiveForm::validate($register_form);
            Yii::app()->end();
        }

        if (isset($_POST["User"])) {
            $register_form->attributes = $_POST["User"];

            $register_form->is_active = 1;
            if($register_form->save()) {
                $login = Yii::createComponent('application.models.LoginForm');
                $login->username = $register_form->username;
                $login->password = $_POST["User"]['password'];
                if($login->autoLogin()) {
                    Yii::app()->user->setFlash('user_register', Yii::t("base","Congratulations! You have registered successfully!"));
                    $this->redirect(Yii::app()->homeUrl);
                }

            }
        }

        $this->render('register', array('register_form' => $register_form));
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

    public function actionSearch()
    {
        if (isset($_GET['q'])) {
            $q = htmlspecialchars($_GET['q']);
            $q = addslashes($q);
            $q = mb_strtolower($q,'UTF-8');

            $crt = new CDbCriteria;
            $crt->condition = "(LOWER(description_ru) REGEXP '[[:<:]]{$q}' or LOWER(description_ro) REGEXP '[[:<:]]{$q}' or LOWER(title_ru) REGEXP '[[:<:]]{$q}' or LOWER(title_ro) REGEXP '[[:<:]]{$q}')";
            $crt->addInCondition("is_active", arr_language());
            $crt->order = 'id DESC';

            $dataSearch = new CActiveDataProvider(new Article, array(
                'criteria'=>$crt,
                'pagination' => array('Pagesize' => Yii::app()->params['defaultPageSize'])
            ));

            $this->render('search',array('dataSearch' => $dataSearch, 'searchPhrase' => $q));
        } else
            throw new CHttpException(404,Yii::t("base","Запрашиваемая страница не существует!"));
    }
}