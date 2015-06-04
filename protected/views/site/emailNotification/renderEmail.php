<?php /*echo trim_text('Webarch UI Framework', 20); */?>
<div class="padding-30 m-t-50">
    <h2>Новые таски за 12 часов</h2>
    <table class="table table-condensed">
        <tbody>
            <?php foreach($tasks as $task) { ?>
                <tr>
                    <td class=" col-md-9">
                        <span class="m-l-10 font-montserrat fs-18 all-caps"><?php echo $task->project->title; ?></span>
                        <span class="m-l-10 task"><?php echo $task->title; ?></span>
                    </td>
                    <td class=" col-md-3 text-right">
                        <span><?php echo CHtml::link('Посмотреть', Yii::app()->params['domen'].'/backend/project/view/id/'.$task->project->id); ?></span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="small">Invoice are issued on the date of despatch. Payment terms: Pre-orders: within 10 days of invoice date with 4% discount, from the 11th to the 30th day net. Re-orders: non-reduced stock items are payable net after 20 days. </p>
    <p class="small">By pressing Pay Now You will Agree to the Payment <a href="#">Terms &amp; Conditions</a>
    </p>
</div>

<style>
    :before,:after{box-sizing:border-box}.m-t-50{margin-top:50px;color:#626262;-moz-font-feature-settings:kern;font-family:"Segoe UI",Arial,sans-serif;font-size:14px;font-weight:400;letter-spacing:.01em}.padding-30{padding:30px!important}h2{font-size:28px;line-height:40px}h1,h2,h3,h4,h5,h6{font-family:"Segoe UI","Helvetica Neue",Helvetica,Arial,sans-serif;font-weight:300;margin:10px 0}p{display:block;font-size:13px;font-style:normal;font-weight:400;letter-spacing:.01em;line-height:20px;margin:0 0 10px;white-space:normal}.all-caps{text-transform:uppercase}.font-montserrat{font-family:'Montserrat'!important}.table.table-condensed{table-layout:fixed}.table{margin-top:5px;margin-bottom:20px;max-width:100%;width:100%}table{background-color:transparent;border-collapse:collapse;border-spacing:0}.table.table-condensed thead tr th,.table.table-condensed tbody tr td,.table.table-condensed tbody tr td *{overflow:hidden;text-overflow:ellipsis;vertical-align:middle;white-space:nowrap}.table.table-condensed tbody tr td{padding-bottom:12px;padding-top:12px}.table tbody tr td{background:none repeat scroll 0 0 #fff;border-bottom:1px solid rgba(230,230,230,0.7);border-top:0 none;font-size:14px;padding:20px}table td[class*="col-"],table th[class*="col-"]{display:table-cell;float:none;position:static}.col-md-9{width:75%}small,.small{font-size:12px;line-height:17px}.hint-text{opacity:.7}.m-l-10{margin-left:10px}.table.table-condensed thead tr th,.table.table-condensed tbody tr td,.table.table-condensed tbody tr td *{overflow:hidden;text-overflow:ellipsis;vertical-align:middle;white-space:nowrap}.font-montserrat{font-family:'Montserrat'!important}.task{font-size:14px;color:#626262}
</style>