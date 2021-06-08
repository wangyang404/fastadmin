define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'stat_ad_day/index' + location.search,
                    add_url: 'stat_ad_day/add',
                    edit_url: 'stat_ad_day/edit',
                    del_url: 'stat_ad_day/del',
                    multi_url: 'stat_ad_day/multi',
                    table: 'stat_ad_day',
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
                        {field: 'STAT_DATE', title: __('Stat_date')},
                        // {field: 'USER_ID', title: __('User_id')},
                        // {field: 'USERNAME', title: __('Username')},
                        // {field: 'AD_ID', title: __('Ad_id')},
                        // {field: 'AD_NAME', title: __('Ad_name')},
                        // {field: 'PLAN_ID', title: __('Plan_id')},
                        // {field: 'PLAN_NAME', title: __('Plan_name')},
                        {field: 'PV_NUM', title: __('Pv_num')},
                        {field: 'UV_NUM', title: __('Uv_num')},
                        {field: 'IP_NUM', title: __('Ip_num')},
                        {field: 'CLICK_NUM', title: __('Click_num')},
                        {field: 'CLICK_UV_NUM', title: __('Click_uv_num')},
                        {field: 'CLICK_IP_NUM', title: __('Click_ip_num')},
                        {field: 'AD_USER_SPEND', title: __('Ad_user_spend'), operate:'BETWEEN'},
                        {field: 'SITE_USER_PROFIT', title: __('Site_user_profit'), operate:'BETWEEN'},
                        {field: 'ADMIN_USER_PROFIT', title: __('Admin_user_profit'), operate:'BETWEEN'},
                        {field: 'CUSTOMER_USER_PROFIT', title: __('Customer_user_profit'), operate:'BETWEEN'},
                        {field: 'BUSINESS_USER_PROFIT', title: __('Business_user_profit'), operate:'BETWEEN'},
                        // {field: 'CREATE_TIME', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange'},
                        // {field: 'UPDATE_TIME', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange'},
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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