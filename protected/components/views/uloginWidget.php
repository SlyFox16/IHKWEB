<script type="xing/login">
    {
      "consumer_key": "8408e4360eaec7710b97"
    }
</script>


<?php if (Yii::app()->user->isGuest): ?>
    <div id="uLoginCustomCallback" class="social-links" data-ulogin="display=<?php echo $display ?>;fields=<?php echo $fields ?>;lang=<?php echo $lang ?>providers=<?php echo $providers ?>;hidden=<?php echo $hidden ?>;redirect_uri=<?php echo urlencode($redirect) ?>; lang=<?php echo $lang?>">
        <a class="fa fa-facebook" data-uloginbutton = "facebook"></a>
        <a class="fa fa-linkedin" data-uloginbutton = "linkedin"></a>
        <a class="fa fa-xing"></a>
    </div>
<?php endif ?>