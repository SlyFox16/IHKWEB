<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function init()
    {
        if (!Yii::app()->user->isGuest) {
            $user = User::model()->findByPk(Yii::app()->user->id);

            if (@Yii::app()->request->cookies['accept']->value && !$user->accept) {
                $user->accept = 1;
                $user->saveAttributes(array('accept'));
            }

            /**
             * Disconnect user if is not active
             */
            if (!$user->is_active) {
                Yii::app()->user->logout();
            } else {
                $user->last_login = date("Y-m-d H:i:s");
                $user->saveAttributes(array('last_login'));
            }
        }
    }
}