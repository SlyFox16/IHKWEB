<!--===============================-->
<!--== Cabinet ====================-->
<!--===============================-->

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Expert register')
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="medium-4 large-3 columns">
            <h2><?php echo Yii::t("base", "Join our program, [b]register[/b] and become a certified expert.", array('[b]' => '<b>', '[/b]' => '</b>')); ?></h2>
        </div>
        <div class="medium-8 large-5 columns separator right-50">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'register-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    'inputContainer' => 'fieldset',
                ),
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <label>
                            <span><?php echo $register_form->getAttributeLabel('name'); ?></span>
                            <?php echo $form->textField($register_form, 'name'); ?>
                        </label>
                        <?php echo $form->error($register_form, 'name'); ?>

                        <label>
                            <span><?php echo $register_form->getAttributeLabel('surname'); ?></span>
                            <?php echo $form->textField($register_form, 'surname'); ?>
                        </label>
                        <?php echo $form->error($register_form, 'surname'); ?>

                        <label>
                            <span><?php echo $register_form->getAttributeLabel('title'); ?></span>
                            <?php echo $form->textField($register_form, 'title'); ?>
                        </label>
                        <?php echo $form->error($register_form, 'title'); ?>

                        <label>
                            <span><?php echo $register_form->getAttributeLabel('email'); ?></span>
                            <?php echo $form->textField($register_form, 'email'); ?>
                        </label>
                        <?php echo $form->error($register_form, 'email'); ?>

                        <label>
                            <span><?php echo Yii::t("base", "User association"); ?></span>
                            <?php $this->widget(
                                'booster.widgets.TbSelect2',
                                [
                                    'model'=>$register_form,
                                    'attribute'=>'userAssociation',
                                    'asDropDownList' => true,
                                    'data' => AssociationMembership::model()->assocList,
                                    'options' => [
                                        'placeholder' => Yii::t("base", 'Select association'),
                                        'width' => '100%',
                                        'allowClear' => true,
                                    ],
                                    'htmlOptions' => [
                                        'id' => 'user-association',
                                        'class' => 'form-control'
                                    ],
                                ]
                            );?>
                        </label>
                        <?php echo $form->error($register_form, 'userAssociation'); ?>

                        <label>
                            <span><?php echo $register_form->getAttributeLabel('speciality'); ?></span>
                            <?php $this->widget(
                                'booster.widgets.TbSelect2',
                                [
                                    'model'=>$register_form,
                                    'attribute'=>"speciality",
                                    'data' => $register_form->specialityList,
                                    'asDropDownList' => true,
                                    'options' => [
                                        'placeholder' => Yii::t("base", 'Select speciality'),
                                        'width' => '100%',
                                        'allowClear' => true,
                                    ],
                                    'htmlOptions' => [
                                        'multiple' => true,
                                        'class' => 'form-control'
                                    ],
                                ]
                            ); ?>
                        </label>

                        <label>
                            <span><?php echo $register_form->getAttributeLabel('country_id'); ?></span>
                            <?php $this->widget(
                                'booster.widgets.TbSelect2',
                                [
                                    'model'=>$register_form,
                                    'attribute'=>'country_id',
                                    'data' => User::model()->assocList,
                                    'asDropDownList' => true,
                                    'options' => [
                                        'placeholder' => Yii::t("base", 'Select country'),
                                        'width' => '100%',
                                        'allowClear' => true,
                                    ],
                                    'htmlOptions' => [
                                        'class' => 'form-control'
                                    ],
                                ]
                            );?>
                        </label>
                        <?php echo $form->error($register_form, 'country_id'); ?>

                        <label>
                            <span><?php echo $register_form->getAttributeLabel('city_id'); ?></span>
                            <?php $this->widget(
                                'booster.widgets.TbSelect2',
                                [
                                    'model'=>$register_form,
                                    'attribute'=>'city_id',
                                    'data' => User::model()->cityList,
                                    'asDropDownList' => false,
                                    'options' => [
                                        'minimumInputLength' => 2,
                                        'placeholder' => Yii::t("base", 'Select city'),
                                        'width' => '100%',
                                        'allowClear' => true,
                                        'ajax' => [
                                            'url' => Yii::app()->controller->createUrl('/user/citySearch'),
                                            'dataType' => 'json',
                                            'data' => 'js:function(term, page) {
                                                            var country = $("#User_country_id").val();
                                                            return {q: term,  country: country};
                                                        }',
                                            'results' => 'js:function(data) { return {results: data}; }',
                                        ],
                                        'formatResult' => 'js:productFormatResult',
                                        'formatSelection' => 'js:productFormatSelection',
                                    ],
                                    'htmlOptions' => [
                                        'class' => 'form-control'
                                    ],
                                ]
                            ); ?>
                        </label>
                        <?php echo $form->error($register_form, 'city_id'); ?>

                        <label>
                            <span><?php echo $register_form->getAttributeLabel('address'); ?></span>
                            <?php echo $form->textField($register_form, 'address'); ?>
                        </label>
                        <?php echo $form->error($register_form, 'address'); ?>

                        <label>
                            <span><?php echo $register_form->getAttributeLabel('companyname'); ?></span>
                            <?php echo $form->textField($register_form, 'companyname'); ?>
                        </label>
                        <?php echo $form->error($register_form, 'companyname'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <fieldset class="fieldset">
                            <legend>Password</legend>
                            <label>
                                <span><?php echo $register_form->getAttributeLabel('password'); ?></span>
                                <?php echo $form->passwordField($register_form, 'password'); ?>
                            </label>
                            <?php echo $form->error($register_form, 'password'); ?>
                            <label>
                                <span><?php echo $register_form->getAttributeLabel('password_repeat'); ?></span>
                                <?php echo $form->passwordField($register_form, 'password_repeat'); ?>
                            </label>
                            <?php echo $form->error($register_form, 'password_repeat'); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <fieldset class="fieldset">
                            <?php echo $form->checkBox($register_form, 'confirmCheck'); ?>
                            <label for="checkbox-signup">
                                Ich stimme den <?php echo CHtml::link('AGB\'s', array('site/pages', 'id' => 2)); ?> zu
                            </label>
                            <?php echo $form->error($register_form, 'confirmCheck'); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <?php echo CHtml::linkButton(Yii::t("base", 'Register'), array('class' => 'button large')); ?>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="medium-8 medium-offset-4 large-4 large-offset-0 columns left-50">
            <h2><?php echo Yii::t("base", "Use already existing [b]social[/b] account to [b]sign up[/b]", array('[b]' => '<b>', '[/b]' => '</b>')); ?></h2>
            <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/Login')); ?>
        </div>
    </div>
</section>

<script>
    function productFormatSelection(city) {
        return city.name;
    }

    function productFormatResult(city) {
        var markup = city.name;
        return markup;
    }
</script>