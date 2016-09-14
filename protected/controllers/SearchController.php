<?php
class SearchController extends Frontend
{
    public function actionSearchResult($q)
    {
        $q = htmlspecialchars($q);
        $q = addslashes($q);
        $q = mb_strtolower($q, 'UTF-8');

        if(strlen($q) >= 5) {
            $users = User::model()->findAll(User::model()->searchCriteria($q));
            $dataSearch=new CArrayDataProvider($users, array(
                'pagination'=>array(
                    'Pagesize' => Yii::app()->params['defaultPageSize'],
                ),
            ));

            $this->render('search',array('dataSearch' => $dataSearch, 'searchPhrase' => $q));
        } else
            throw new CHttpException(404, Yii::t("base", "Your query is too short!"));
    }

    public function actionSearch()
    {
        $q = Yii::app()->request->getQuery('searchfield');

        if ($q) {
            $q = htmlspecialchars($q);
            $q = addslashes($q);
            $q = mb_strtolower($q, 'UTF-8');

            if (strlen($q) >= 5) {
                $user = User::model()->findAll(User::model()->searchCriteria($q));

                if (count($user) == 1)
                    $this->redirect(array('user/info', 'id' => $user[0]->id));
                elseif (count($user) > 1) {
                    $dataSearch=new CArrayDataProvider($user, array(
                        'pagination'=>array(
                            'Pagesize' => Yii::app()->params['defaultPageSize'],
                        ),
                    ));

                    $this->render('search',array('dataSearch' => $dataSearch, 'searchPhrase' => $q));
                } else
                    throw new CHttpException(404, Yii::t("base", "No expert was found!"));
            } else
                throw new CHttpException(404, Yii::t("base", "Your query is too short!"));
        } else
            throw new CHttpException(404, Yii::t("base", "Your query is too short!"));
    }
}