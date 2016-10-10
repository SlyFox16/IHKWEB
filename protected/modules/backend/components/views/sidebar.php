<?php
/**
 * @var $c string
 */
?>

<!-- sidebar -->
<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar">
    <div class="antiScroll">
        <div class="antiscroll-inner">
            <div class="antiscroll-content">

                <div class="sidebar_inner">
                    <br><br>
                    <div id="side_accordion" class="accordion">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseUser" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-user"></i> Users
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="users") echo " in"; ?>" id="collapseUser">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/user/adminStaff");?>">Administrators</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/user/adminMembers");?>">Clients</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/ratingLog/admin");?>">User Ratings</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseEvent" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-barcode"></i> Events
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="events") echo " in"; ?>" id="collapseEvent">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/event/admin");?>">Manage Events</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseCert" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-barcode"></i> Certificates
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="cert") echo " in"; ?>" id="collapseCert">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/certificates/admin");?>">Certificates</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseFeedback" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-envelope"></i> Feedback
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="feedback") echo " in"; ?>" id="collapseFeedback">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/feedback/admin");?>">All reviews</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseReport" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-briefcase"></i> All Reports
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="report") echo " in"; ?>" id="collapseReport">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/report/admin");?>">Reports</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseMembership" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-list"></i> Association Membership
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="association_membership") echo " in"; ?>" id="collapseMembership">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/associationMembership/admin");?>">Memberships</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseCompleted" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-list"></i> Completed projects
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="completed") echo " in"; ?>" id="collapseCompleted">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/completedProjects/admin");?>">Projects</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseConfig" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-cog"></i> Configuration
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="configuration") echo " in"; ?>" id="collapseConfig">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/settings/admin"); ?>">Settings</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/pages/admin"); ?>">Static Pages</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/yiiseoUrl/admin"); ?>">SEO</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="push"></div>
                </div>

            </div>
        </div>
    </div>

</div>
