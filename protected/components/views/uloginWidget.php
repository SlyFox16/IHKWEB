<?php if (Yii::app()->user->isGuest): ?>
    <div id="uLoginCustomCallback" class="social-links" data-ulogin="display=<?php echo $display ?>;fields=<?php echo $fields ?>;lang=<?php echo $lang ?>providers=<?php echo $providers ?>;hidden=<?php echo $hidden ?>;redirect_uri=<?php echo urlencode($redirect) ?>; lang=<?php echo $lang?>">
        <div class="fa fa-facebook" data-uloginbutton = "facebook"></div>
        <div class="fa fa-linkedin" data-uloginbutton = "linkedin"></div>
        <!--<div onclick="location.href='<?php /*echo Yii::app()->createUrl('site/xing'); */?>'" class="fa fa-xing"></div>-->
        <div class="fa fa-xing"></div>
    </div>
<?php endif ?>