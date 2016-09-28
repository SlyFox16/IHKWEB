<?php

class DeleteController extends Frontend {

	public $defaultAction = 'delete';

	public function actionDelete($id = null) {
		if (!$id) {
			$messagesData = Yii::app()->request->getParam('Message');
			$counter = 0;
			if ($messagesData) {
				foreach ($messagesData as $messageData) {
					if (isset($messageData['selected'])) {
						$message = Message::model()->findByPk($messageData['id']);
						if ($message->deleteByUser(Yii::app()->user->getId())) {
							$counter++;
						}
					}
				}
			}
			if ($counter) {
				Yii::app()->user->setFlash('project_success', Yii::t("base", '{count} group of messages has been deleted|{count} groups of messages has been deleted', array($counter, '{count}' => $counter)));
			}
			$this->redirect(Yii::app()->request->getUrlReferrer());
		} else {
			$message = Message::model()->findByPk($id);

			if (!$message) {
				throw new CHttpException(404, Yii::t("base", 'Message not found'));
			}

			$folder = $message->receiver_id == Yii::app()->user->getId() ? 'inbox/' : 'sent/';

			if ($message->deleteByUser(Yii::app()->user->getId())) {
				Yii::app()->user->setFlash('project_success', Yii::t("base", 'Message has been deleted'));
			}
			$this->redirect($this->createUrl($folder));
		}
	}
}
