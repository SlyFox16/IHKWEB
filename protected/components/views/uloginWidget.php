<?php if (Yii::app()->user->isGuest): ?>
    <div id="uLoginCustomCallback" class="social-links" data-ulogin="display=<?php echo $display ?>;fields=<?php echo $fields ?>;lang=<?php echo $lang ?>providers=<?php echo $providers ?>;hidden=<?php echo $hidden ?>;redirect_uri=<?php echo urlencode($redirect) ?>; lang=<?php echo $lang?>">
        <a class="fa fa-facebook" data-uloginbutton = "facebook"></a>
        <a class="fa fa-linkedin" data-uloginbutton = "linkedin"></a>
        <!--<div onclick="location.href='<?php /*echo Yii::app()->createUrl('site/xing'); */?>'" class="fa fa-xing"></div>-->
        <!--<div class="fa fa-xing"></div>-->
    </div>
<?php endif ?>