<?php
class StarRating extends CWidget
{
    public $user = null;
    public $readOnly = false;
    public $dataSize = 'xs';
    public static $count = 1;
    /**
     * @var string Id of elements
     */
    public $view = 'shoppingCart';

    public function run()
    {
        if($this->user) {
            $disabled = true;
            if(!$this->readOnly)
                $disabled = (!$this->user->ratingLog && !Yii::app()->user->isGuest) && ($this->user->id != Yii::app()->user->id)? false : true;

            $this->registerScript($disabled);

            echo CHtml::tag('input', array('type' => "hidden", 'id' => 'rating'.self::$count++, 'class' => "rating", 'data-step' => "1", 'data-disabled' => $disabled, 'data-size' => $this->dataSize, 'data-show-clear' => false, 'data-show-caption' => false, 'data-user-id' => $this->user->username, 'value' => $this->user->rating), false, false);
        }
    }

    private function registerScript($disabled) {
        Yii::app()->clientScript->registerCssFile($this->controller->assetsUrl.'/css/bootstrap-rating.css');
        Yii::app()->clientScript->registerScriptFile($this->controller->assetsUrl.'/javascripts/bootstrap-rating.min.js', CClientScript::POS_END);

        if(!$disabled) {
            Yii::app()->clientScript->registerScript('starRatingAjax',"
                $('.rating').on('rating.change', function () {
                    var self = $(this);
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: {index: self.val(), username: self.data('user-id')},
                        url: '/user/rating',
                        success: function (data) {
                            if(data.result) {
                                self.rating('update', data.data);
                                self.rating('refresh', {disabled: true, showClear: false, value: data.data});
                                $('#ratingDescription').foundation('open');
                            }
                        }
                    });
                });
            ");
        }

        if(!Yii::app()->user->isGuest) {
            Yii::app()->clientScript->registerScript('showDescription',"
                $('.rating-disabled .rating-gly-star').on('click', function () {
                    $('#ratingDescription').foundation('open');
                });
            ");
        }
    }
}