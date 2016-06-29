<div class="socials">
    <?php foreach ($services as $name => $service) {
        echo '<li class="auth-service ' . $service->id . '">';
            echo CHtml::link('', array($action, 'service' => $name), array(
                'class' => 'auth-link fa fa-'.$service->id.' '.$service->id,
            ));
        echo '</li>';
    } ?>
</div>