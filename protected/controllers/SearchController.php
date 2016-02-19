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
        $model = new SearchModel();

        $searchPhrase = Yii::app()->request->getParam('SearchModel');
        $q = '';
        foreach($searchPhrase as $phrase)
            $q = $searchPhrase['searchfield'];

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'search-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['SearchModel'])) {
            $this->redirect(array('searchResult', 'q' => $q));
        } else
            throw new CHttpException(404, Yii::t("base", "The requested page does not exist!"));
    }
}