<!--===============================-->
<!--== Cabinet ====================-->
<!--===============================-->

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                $certificate->name
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="small-12 columns text-center">
            <img src="<?php echo YHelper::getImagePath($certificate->logo, 120, 120); ?>" alt="<?php echo $certificate->name; ?>">
            <h1><?php echo $certificate->name; ?></h1>
            <p><?php echo $certificate->description; ?></p>
        </div>
    </div>
</section>
