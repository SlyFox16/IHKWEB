<?php
    if( !empty($banner)) {
        if ($banner->banner_type_id == 1) {
            echo CHtml::openTag('li', array('class' => 'post'));
                if($banner->link) : ?>
                    <a href="<?php echo $banner->link; ?>"><img src="<?php echo '/'.$banner->file; ?>"/></a>
                <?php else : ?>
                    <img src="<?php echo '/'.$banner->file; ?>"/>
                <?php endif;
            echo CHtml::closeTag('li');
        } elseif($banner->banner_type_id == 2) {
            $img = CHtml::image($banner->file, $banner->title, array('width' => 510));
            echo CHtml::openTag('li', array('class' => 'post'));
                if($banner->link)
                    echo CHtml::link($img, $banner->link);
                else
                    echo $img;
            echo CHtml::closeTag('li');
        } elseif($banner->banner_type_id == 3) { echo CHtml::openTag('li', array('class' => 'post')); ?>
            <object
                classid="clsid:D697CDE7E-AE6D-11cf-96B8-458453540000"
                codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0"
                id="animation name">

                <param name="movie" value="<?php echo Yii::app()->request->baseUrl .'/'. $banner->file; ?>">
                <param name="quality" value="high">
                <param name="bgcolor" value="#FFFFFF">

                <embed
                    name="animationname"
                    src="<?php echo Yii::app()->request->baseUrl .'/'. $banner->file; ?>"
                    width="331"
                    quality="high"
                    bgcolor="#FFFFFF"
                    type="application/x-shockwave-flash"
                    pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
                </embed>
            </object>
        <? echo CHtml::closeTag('li');
        } elseif($banner->banner_type_id == 4) {
            echo $banner->custom_banner;
        }
    }

