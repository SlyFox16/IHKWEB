<div class="modal fade fill-in" id="xingpass" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                <h5 class="text-left p-b-5"><span class="semi-bold"><?php echo Yii::t("base", "Xing Login"); ?></span></h5>
            </div>
            <div class="modal-body">
                <script type="xing/login">
                    {
                      "consumer_key": "8408e4360eaec7710b97"
                    }
                </script>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal -->

<?php Yii::app()->clientScript->registerScript('popoverActivate',"$('#xingpass').modal('show')"); ?>