<div class="modal fade" id="associationMembership">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo Yii::t("base", "Add certificate");?></h4>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('backend.components.ActiveForm', array(
                    'id' => 'login-form',
                    'action' => array("associationMembership/uCCreate", 'id' => $user),
                    'type'=>'horizontal',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false
                    ),
                    'htmlOptions' => array('class' => 'form-horizontal')
                )); ?>
                <div class="control-group">
                    <label class="control-label control-label required" for="User_username">
                        <?php echo $model->getAttributeLabel('certificate_id'); ?>
                        <span class="required">*</span>
                    </label>
                    <div class="controls">
                        <?php $this->widget(
                            'booster.widgets.TbSelect2',
                            [
                                'model'=>$model,
                                'attribute'=>"association_id",
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
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> <?php echo Yii::t("base", "Add");?></button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function productFormatSelection2(product) {
        return product.label;
    }

    function productFormatResult2(user) {
        var markup = user.label;
        return markup;
    }
</script>