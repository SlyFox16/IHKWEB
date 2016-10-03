<?php

class ComposeController extends Frontend
{

	public $defaultAction = 'compose';

	public function actionCompose($param = null) {
        $this->_curNav = 'compose';
		$message = new Message();
		if (Yii::app()->request->getPost('Message')) {
			$receiverName = Yii::app()->request->getPost('Message[receiver]');
		    $message->attributes = Yii::app()->request->getPost('Message');
			$message->sender_id = Yii::app()->user->getId();
            $message->chat_id = md5(microtime() . rand(0, 9999));
			if ($message->save()) {
                Yii::app()->email->gotMessage($message);

				Yii::app()->user->setFlash('project_success', Yii::t("base", 'Message has been sent'));
			    $this->redirect($this->createUrl('inbox/'));
			} else if ($message->hasErrors('receiver_id')) {
				$message->receiver_id = null;
				$receiverName = '';
			}
		} else {
			if ($param) {
                $receiver = User::model()->find('username = :username', array(':username' => $param));
				if ($receiver) {
					$receiverName = call_user_func(array($receiver, Yii::app()->getModule('message')->getNameMethod));
					$message->receiver_id = $receiver->id;
				}
			}
		}
		$this->render(Yii::app()->getModule('message')->viewPath . '/compose', array('model' => $message, 'receiverName' => isset($receiverName) ? $receiverName : null));
	}
}
