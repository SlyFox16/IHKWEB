<?php
/**
 * Created by Idol IT.
 * Date: 10/1/12
 * Time: 5:59 PM
 */
?>

<div class="span12" id="user-list">
    <h3 class="heading">Пользователей
        <small>последние 24 часа</small>
    </h3>
    <div class="row-fluid">
        <div class="input-prepend">
            <span class="add-on ad-on-icon"><i class="icon-user"></i></span>
            <input type="text" class="user-list-search search" placeholder="Поиск пользователей"/>
        </div>
        <ul class="nav nav-pills line_sep">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Сортировать по <b class="caret"></b></a>
                <ul class="dropdown-menu sort-by">
                    <li><a href="javascript:void(0)" class="sort" data-sort="sl_name">по имени</a></li>
                    <li><a href="javascript:void(0)" class="sort" data-sort="sl_status">по статусу</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Показывать <b class="caret"></b></a>
                <ul class="dropdown-menu filter">
                    <li class="active"><a href="javascript:void(0)" id="filter-none">Все</a></li>
                    <li><a href="javascript:void(0)" id="filter-online">Онлайн</a></li>
                    <li><a href="javascript:void(0)" id="filter-offline">Оффлайн</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <ul class="list user_list">

        <?php foreach ($users as $user) { ?>
        <li>
            <?php if ($user->isUserOnline) { ?>
            <span class="label label-success pull-right sl_status">онлайн</span>
            <?php }else{ ?>
            <span class="label label-important pull-right sl_status">оффлайн</span>
            <?php } ?>
            <a href="<?php echo Yii::app()->createUrl("backend/user/view",array('id'=>$user->id)); ?>" class="sl_name"><?php echo $user->name; ?></a><br/>
            <small class="s_color sl_email"><?php echo $user->email; ?></small>
        </li>
        <?php } ?>
    </ul>
    <div class="pagination">
        <ul class="paging bottomPaging"></ul>
    </div>
</div>