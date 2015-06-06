<?php if (Yii::app()->user->isGuest): ?>
    <div id="uLogin" class="social-links" data-ulogin="display=<?php echo $display ?>;fields=<?php echo $fields ?>;lang=<?php echo $lang ?>">
        <a href="" class="fa fa-facebook" data-uloginbutton = "facebook"></a>
        <a href="" class="fa fa-linkedin" data-uloginbutton = "linkedin"></a>
        <a href="" class="fa fa-xing"></a>
    </div>
<?php endif ?>