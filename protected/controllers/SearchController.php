<?php
class SearchController extends Frontend
{
    public function actionSearchResult($q)
    {
        $q = htmlspecialchars($q);
        $q = addslashes($q);
        $q = mb_strtolower($q, 'UTF-8');

        $queryTerms = explode(' ', $q);

        if(strlen($q) >= 5) {
            $crt = new CDbCriteria;
            $crt->with=array(
                'cities0',
            );

            foreach ($queryTerms as $k => $req) {
                $tCriteria = new CDbCriteria();

                $tCriteria->condition = "name LIKE :$k OR surname LIKE :$k OR cities0.city_name_ASCII LIKE :$k";
                $tCriteria->params[":$k"] = '%'.strtr($req, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';

                $crt->mergeWith($tCriteria);
            }
            $crt->scopes = 'search_active';
            $crt->order = 'id DESC';

            $dataSearch = new CActiveDataProvider(new User(), array(
                'criteria'=>$crt,
                'pagination' => array('Pagesize' => Yii::app()->params['defaultPageSize'])
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