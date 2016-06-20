<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'My account')
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="small-3 medium-3 columns">
            <div class="expert_photo">
                <img src="<?php echo YHelper::getImagePath($user->avatar, 200, 200); ?>" alt="<?php echo Yii::t("base", "Profile picture"); ?>">
            </div>
        </div>
        <div class="small-9 medium-6 columns end">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'cabinet-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'inputContainer' => 'fieldset',
                    'afterValidate'=>'js:function(form, data, hasError)
                        {
                            if(!hasError) {
                               $("#cabinet-form [type=submit]").off();
                               return true;
                            }
                        }',
                ),
                'htmlOptions'=>array("enctype"=>"multipart/form-data"),
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <label>
                            <span><?php echo $user->getAttributeLabel('username'); ?></span>
                            <?php echo $form->textField($user, 'username'); ?>
                        </label>
                        <?php echo $form->error($user, 'username'); ?>

                        <?php $this->renderPartial('application.widgets.views.user_relation', array('user' => $user)); ?>

                        <label>
                            <span>Name</span>
                            <input type="text" value="John Doe">
                        </label>

                        <label>
                            <span>Description</span>
                            <textarea name="" id="" cols="30" rows="5"></textarea>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <fieldset class="fieldset">
                            <legend>Certifications</legend>
                            <label>
                                <span>Certificate</span>
                                <input type="text">
                            </label>
                            <small class="error">Invalid entry</small>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <fieldset class="fieldset">
                            <legend>References</legend>
                            <label>
                                <span>PDF Files</span>
                                <div class="dropzone">
                                    <i>Drop your files here or click</i>
                                </div>
                            </label>
                            <ul class="attached">
                                <li>document.pdf <a href="" class="fa fa-times"></a></li>
                            </ul>

                            <label>
                                <span>Facebook</span>
                                <input type="text">
                            </label>

                            <label>
                                <span>Twitter</span>
                                <input type="text">
                            </label>

                            <label>
                                <span>Facebook</span>
                                <input type="text">
                            </label>
                        </fieldset>
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <div class="button-group">
                            <a class="button large">Save <i class="fa fa-circle-o-notch"></i></a>
                            <a class="button large">Recover Password</a>
                        </div>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</section>