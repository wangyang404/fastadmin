<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"D:\phpstudy_pro\WWW\FastAdmin\public/../application/admin\view\plan\edit.html";i:1620716563;s:72:"D:\phpstudy_pro\WWW\FastAdmin\application\admin\view\layout\default.html";i:1555662057;s:69:"D:\phpstudy_pro\WWW\FastAdmin\application\admin\view\common\meta.html";i:1555662057;s:71:"D:\phpstudy_pro\WWW\FastAdmin\application\admin\view\common\script.html";i:1555662057;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Plan_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-PLAN_NAME" class="form-control" name="row[PLAN_NAME]" type="text" value="<?php echo $row['PLAN_NAME']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('User_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-USER_ID" data-rule="required" data-source="USER/index" class="form-control selectpage" name="row[USER_ID]" type="text" value="<?php echo $row['USER_ID']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Plan_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-PLAN_TYPE" class="form-control" name="row[PLAN_TYPE]" type="text" value="<?php echo $row['PLAN_TYPE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Cost_money'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-COST_MONEY" class="form-control" step="0.00000001" name="row[COST_MONEY]" type="number" value="<?php echo $row['COST_MONEY']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Total_money'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-TOTAL_MONEY" class="form-control" step="0.00000001" name="row[TOTAL_MONEY]" type="number" value="<?php echo $row['TOTAL_MONEY']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Plan_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-PLAN_PRICE" class="form-control" step="0.00000001" name="row[PLAN_PRICE]" type="number" value="<?php echo $row['PLAN_PRICE']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Custom_user_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-CUSTOM_USER_PRICE" class="form-control " rows="5" name="row[CUSTOM_USER_PRICE]" cols="50"><?php echo $row['CUSTOM_USER_PRICE']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_num'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-ORDER_NUM" class="form-control" name="row[ORDER_NUM]" type="number" value="<?php echo $row['ORDER_NUM']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Is_effective'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-IS_EFFECTIVE" class="form-control selectpicker" name="row[IS_EFFECTIVE]">
                <?php if(is_array($isEffectiveList) || $isEffectiveList instanceof \think\Collection || $isEffectiveList instanceof \think\Paginator): if( count($isEffectiveList)==0 ) : echo "" ;else: foreach($isEffectiveList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['IS_EFFECTIVE'])?$row['IS_EFFECTIVE']:explode(',',$row['IS_EFFECTIVE']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Create_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-CREATE_TIME" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[CREATE_TIME]" type="text" value="<?php echo $row['CREATE_TIME']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Update_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-UPDATE_TIME" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[UPDATE_TIME]" type="text" value="<?php echo $row['UPDATE_TIME']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Limit_money'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-LIMIT_MONEY" class="form-control" step="0.00000001" name="row[LIMIT_MONEY]" type="number" value="<?php echo $row['LIMIT_MONEY']; ?>">
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