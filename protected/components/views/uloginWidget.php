<script type="xing/login">
    {
      "consumer_key": "8408e4360eaec7710b97"
    }
    </script>


<?php if (Yii::app()->user->isGuest): ?>
    <div id="uLoginCustomCallback" class="social-links" data-ulogin="display=<?php echo $display ?>;fields=<?php echo $fields ?>;lang=<?php echo $lang ?>providers=<?php echo $providers ?>;hidden=<?php echo $hidden ?>;redirect_uri=<?php echo urlencode($redirect) ?>; lang=<?php echo $lang?>">
        <div class="fa fa-facebook" data-uloginbutton = "facebook"></div>
        <div class="fa fa-linkedin" data-uloginbutton = "linkedin"></div>
        <div class="fa fa-xing"></div>
    </div>
<?php endif ?>