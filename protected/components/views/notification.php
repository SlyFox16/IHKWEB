<?php foreach(Yii::app()->user->getFlashes() as $key => $message) { ?>
    <?php if(strpos($key, 'project_success') !== false) { ?>
        <script>
            $.notify({
            // options
            message: "<?php echo $message; ?>"
            },{
            // settings
            type: 'success',
            template: '<div data-notify="container" class="notification notification-{0}" role="alert">' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
        </script>
    <?php } ?>

    <?php if(strpos($key, 'project_error') !== false) { ?>
        <script>
            $.notify({
                // options
                message: "<?php echo $message; ?>"
            },{
                // settings
                type: 'danger',
                template: '<div data-notify="container" class="notification notification-{0}" role="alert">' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
        </script>
    <?php } ?>
<?php } ?>