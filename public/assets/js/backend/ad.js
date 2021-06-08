define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'ad/index' + location.search,
                    add_url: 'ad/add',
                    edit_url: 'ad/edit',
                    del_url: 'ad/del',
                    multi_url: 'ad/multi',
                    table: 'ad',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'ID',
                sortName: 'ID',
                columns: [
                    [
                        {checkbox: true},
                        // {field: 'ID', title: __('Id')},
                        {field: 'AD_NAME', title: __('Ad_name')},
                        {field: 'PLAN_ID', title: __('Plan_id')},
                        {field: 'SPEND_TYPE', title: __('Spend_type')},
                        {field: 'STYLE_ID', title: __('Style_id')},
                        {field: 'IMAGE_URL', title: __('Image_url'), formatter: Table.api.formatter.url},
                        {field: 'CLICK_URL', title: __('Click_url'), formatter: Table.api.formatter.url},
                        {field: 'AD_USER_PRICE', title: __('Ad_user_price'), operate:'BETWEEN'},
                        {field: 'SITE_USER_PRICE', title: __('Site_user_price'), operate:'BETWEEN'},
                        {field: 'VISIBLE_TYPE', title: __('Visible_type')},
                        {field: 'VISIBLE_SCOPE', title: __('Visible_scope')},
                        {field: 'POINT_RATIO', title: __('Point_ratio'), operate:'BETWEEN'},
                        {field: 'AD_SIZE', title: __('Ad_size')},
                        {field: 'VALID_TIME', title: __('Valid_time')},
                        {field: 'PUSH_NUM_LIMIT', title: __('Push_num_limit')},
                        {field: 'CHANGE_NUM', title: __('Change_num')},
                        {field: 'CHANGE_TIME', title: __('Change_time')},
                        {field: 'HIDDEN_JS_IDS', title: __('Hidden_js_ids')},
                        {field: 'WEIGHT', title: __('Weight')},
                        {field: 'CREAT_TIME', title: __('Creat_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'UPDATE_TIME', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'IS_EFFECTIVE', title: __('Is_effective')},
                        {field: 'ORDER_NUM', title: __('Order_num')},
                        {field: 'USER_ID', title: __('User_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});