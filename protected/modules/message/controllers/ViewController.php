<?php

class ViewController extends Frontend {

	public $defaultAction = 'view';

	public function actionView() {
		$messageId = (int)Yii::app()->request->getParam('id');
		$viewedMessage = Message::model()->findAll('chat_id = :id', array(':id' => $messageId));

		if (!$viewedMessage[0]) {
			 throw new CHttpException(404, MessageModule::t('Message not found'));
		}

		$userId = Yii::app()->user->getId();

		if ($viewedMessage[0]->sender_id != $userId && $viewedMessage[0]->receiver_id != $userId) {
		    throw new CHttpException(403, MessageModule::t('You can not view this chat'));
		}
		if (($viewedMessage[0]->sender_id == $userId && $viewedMessage[0]->deleted_by == Message::DELETED_BY_SENDER)
		    || $viewedMessage[0]->receiver_id == $userId && $viewedMessage[0]->deleted_by == Message::DELETED_BY_RECEIVER) {
		    throw new CHttpException(404, MessageModule::t('Chat was not found'));
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
				Yii::app()->user->setFlash('project_success', MessageModule::t('Message has been sent'));
					$this->redirect($this->createUrl('inbox/'));
			} else {
                echo CHtml::errorSummary($message); die();
            }
		}

		if ($isIncomeMessage) {
			$viewedMessage[0]->markAsRead();
		}

		$this->render(Yii::app()->getModule('message')->viewPath . '/view', array('viewedMessage' => $viewedMessage, 'message' => $message));
	}
}
