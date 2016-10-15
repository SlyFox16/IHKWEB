<div class="medium-4 large-3 columns end">
    <a href="<?php echo $this->createUrl('/event/view', array('id' => $data->id)); ?>" class="event">
        <time>
            <?php echo YHelper::formatDate('dd MMMM yyyy', $data->date, 'dd/MM/yyyy'); ?>
            <?php echo YHelper::formatDate('dd MMMM yyyy', $data->date_end, 'dd/MM/yyyy'); ?>
        </time>
        <span class="event_bottom">
            <h2><?php echo $data->title; ?></h2>
            <span><?php echo User::getCityCountry($data->country_id, 'country').', '.User::getCityCountry($data->city_id, 'city'); ?></span>
        </span>
    </a>
</div>