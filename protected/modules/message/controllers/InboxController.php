<?php

class InboxController extends Frontend
{
	public $defaultAction = 'inbox';

	public function actionInbox() {
		$messagesAdapter = Message::getNewAdapterForInbox(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);

		$this->render(Yii::app()->getModule('message')->viewPath . '/inbox', array(
			'messagesAdapter' => $messagesAdapter
		));
	}
}