<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"D:\phpstudy_pro\WWW\FastAdmin\public/../application/admin\view\ad\edit.html";i:1620890582;s:72:"D:\phpstudy_pro\WWW\FastAdmin\application\admin\view\layout\default.html";i:1555662057;s:69:"D:\phpstudy_pro\WWW\FastAdmin\application\admin\view\common\meta.html";i:1555662057;s:71:"D:\phpstudy_pro\WWW\FastAdmin\application\admin\view\common\script.html";i:1555662057;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/FastAdmin/public/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/FastAdmin/public/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/FastAdmin/public/assets/js/html5shiv.js"></script>
  <script src="/FastAdmin/public/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Ad_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-AD_NAME" class="form-control" name="row[AD_NAME]" type="text" value="<?php echo $row['AD_NAME']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Plan_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-PLAN_ID" data-rule="required" data-source="PLAN/index" class="form-control selectpage" name="row[PLAN_ID]" type="text" value="<?php echo $row['PLAN_ID']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Spend_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-SPEND_TYPE" class="form-control" name="row[SPEND_TYPE]" type="text" value="<?php echo $row['SPEND_TYPE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Style_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-STYLE_ID" data-rule="required" data-source="STYLE/index" class="form-control selectpage" name="row[STYLE_ID]" type="text" value="<?php echo $row['STYLE_ID']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Image_url'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-IMAGE_URL" class="form-control" name="row[IMAGE_URL]" type="text" value="<?php echo $row['IMAGE_URL']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Click_url'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-CLICK_URL" class="form-control" name="row[CLICK_URL]" type="text" value="<?php echo $row['CLICK_URL']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Ad_user_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-AD_USER_PRICE" class="form-control" step="0.00000001" name="row[AD_USER_PRICE]" type="number" value="<?php echo $row['AD_USER_PRICE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Site_user_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-SITE_USER_PRICE" class="form-control" step="0.00000001" name="row[SITE_USER_PRICE]" type="number" value="<?php echo $row['SITE_USER_PRICE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Visible_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-VISIBLE_TYPE" class="form-control" name="row[VISIBLE_TYPE]" type="text" value="<?php echo $row['VISIBLE_TYPE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Visible_scope'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-VISIBLE_SCOPE" class="form-control" name="row[VISIBLE_SCOPE]" type="text" value="<?php echo $row['VISIBLE_SCOPE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Point_ratio'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-POINT_RATIO" class="form-control" step="0.01" name="row[POINT_RATIO]" type="number" value="<?php echo $row['POINT_RATIO']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Ad_size'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-AD_SIZE" class="form-control" name="row[AD_SIZE]" type="text" value="<?php echo $row['AD_SIZE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Valid_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-VALID_TIME" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[VALID_TIME]" type="text" value="<?php echo $row['VALID_TIME']?datetime($row['VALID_TIME']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Push_num_limit'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-PUSH_NUM_LIMIT" class="form-control" name="row[PUSH_NUM_LIMIT]" type="number" value="<?php echo $row['PUSH_NUM_LIMIT']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Change_num'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-CHANGE_NUM" class="form-control" name="row[CHANGE_NUM]" type="number" value="<?php echo $row['CHANGE_NUM']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Change_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-CHANGE_TIME" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[CHANGE_TIME]" type="text" value="<?php echo $row['CHANGE_TIME']?datetime($row['CHANGE_TIME']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Hidden_js_ids'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-HIDDEN_JS_IDS" data-rule="required" data-source="HIDDEN/JS/index" data-multiple="true" class="form-control selectpage" name="row[HIDDEN_JS_IDS]" type="text" value="<?php echo $row['HIDDEN_JS_IDS']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Weight'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-WEIGHT" class="form-control" name="row[WEIGHT]" type="number" value="<?php echo $row['WEIGHT']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Creat_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-CREAT_TIME" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[CREAT_TIME]" type="text" value="<?php echo $row['CREAT_TIME']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Update_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-UPDATE_TIME" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[UPDATE_TIME]" type="text" value="<?php echo $row['UPDATE_TIME']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Is_effective'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-IS_EFFECTIVE" class="form-control" name="row[IS_EFFECTIVE]" type="text" value="<?php echo $row['IS_EFFECTIVE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_num'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-ORDER_NUM" class="form-control" name="row[ORDER_NUM]" type="number" value="<?php echo $row['ORDER_NUM']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('User_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-USER_ID" data-rule="required" data-source="USER/index" class="form-control selectpage" name="row[USER_ID]" type="text" value="<?php echo $row['USER_ID']; ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/FastAdmin/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/FastAdmin/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>