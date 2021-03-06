<?php
/**
 * Created by Idol IT.
 * Date: 9/29/12
 * Time: 5:57 PM
 */

class BackendController extends Controller
{
    public $layout = "/layouts/main";
    public $sidebar_tab;

    public function init()
    {
        if (!empty($this->sidebar_tab))
            Yii::app()->session["sidebar_tab"] = $this->sidebar_tab;
        parent::init();
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('upload', 'gallery','logout','login','error', 'additem', 'removeadd'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'createrow',
                    'send',
                    'addrecipients',
                    'rendercustomizer',
                    'applyproduct',
                    'detachproduct',
                    'deleterow',
                    'customize',
                    'index',
                    'tree',
                    'view',
                    'create',
                    'update',
                    'delete',
                    'admin',
                    'map',
                    'imagedel',
                    'newcustomer',
                    'addproduct',
                    'addstatus',
                    'updatepassword',
                    'search',
                    'viewall',
                    'excel',
                    'ajaxview',
                    'links',
                    'check',
                    'upload',
                    'titleUpdate',
                    'authorUpdate',
                    'adminStaff',
                    'adminMembers',
                    'createAdmin',
                    'ajaxTags',
                    'confirmLevel',
                    'UCDate',
                    'UCCreate',
                    'UCDelete',
                    'UCUpdate',
                    'completedProject',
                    'staffUpdate',
                    'createUser',
                    'DeleteRelation',
                    'mailAll',
                    'addMember',
                    'localeSearch',
                    'seekerMembers',
                ),
                'expression'=>'isset(Yii::app()->user->id) && User::model()->findByPk(Yii::app()->user->id)->is_staff',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
}