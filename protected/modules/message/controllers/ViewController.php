<?php

class ViewController extends Frontend {

	public $defaultAction = 'view';

	public function actionView() {
        $this->_curNav = 'inbox';
		$messageId = Yii::app()->request->getParam('id');

        $crt = new CDbCriteria();
        $crt->condition = 'chat_id = :id';
        $crt->params[':id'] = $messageId;
        $crt->order = 'created_at ASC';
		$viewedMessage = Message::model()->findAll($crt);

		if (!$viewedMessage[0]) {
			 throw new CHttpException(404, Yii::t("base", 'Message not found'));
		}

		$userId = Yii::app()->user->getId();

		if ($viewedMessage[0]->sender_id != $userId && $viewedMessage[0]->receiver_id != $userId) {
		    throw new CHttpException(403, Yii::t("base", 'You can not view this chat'));
		}
		if (($viewedMessage[0]->sender_id == $userId && $viewedMessage[0]->deleted_by == Message::DELETED_BY_SENDER)
		    || $viewedMessage[0]->receiver_id == $userId && $viewedMessage[0]->deleted_by == Message::DELETED_BY_RECEIVER) {
		    throw new CHttpException(404, Yii::t("base", 'Chat was not found'));
		}

		$message = new Message('reply');

		$isIncomeMessage = $viewedMessage[0]->receiver_id == $userId;
		if ($isIncomeMessage)
			$message->receiver_id = $viewedMessage[0]->sender_id;
		else
			$message->receiver_id = $viewedMessage[0]->receiver_id;

		if (Yii::app()->request->getPost('Message')) {
			$message->attributes = Yii::app()->request->getPost('Message');
			$message->sender_id = $userId;
            $message->chat_id = $viewedMessage[0]->chat_id;
			if ($message->save()) {
                Yii::app()->email->gotMessage($message);

				Yii::app()->user->setFlash('project_success', Yii::t("base", 'Message has been sent'));
				$this->redirect(Yii::app()->request->urlReferrer);
			}
		}

		$viewedMessage[0]->markAsRead();

		$this->render(Yii::app()->getModule('message')->viewPath . '/view', array('viewedMessage' => $viewedMessage, 'message' => $message));
	}
}
