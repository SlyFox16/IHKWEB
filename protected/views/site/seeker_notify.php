<div class="modal fade fill-in" id="seeker_pop" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                <h5 class="text-left p-b-5"><span class="semi-bold"><?php echo Yii::t("base", "Notification"); ?></span></h5>
            </div>
            <div class="modal-body">
                Thank you for your registration. The confirmation letter have been sent to your email.
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal -->

<?php Yii::app()->clientScript->registerScript('popoverActivate',"$('#seeker_pop').modal('show')"); ?>