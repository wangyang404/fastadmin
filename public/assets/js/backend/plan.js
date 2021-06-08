define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'plan/index' + location.search,
                    add_url: 'plan/add',
                    edit_url: 'plan/edit',
                    del_url: 'plan/del',
                    multi_url: 'plan/multi',
                    table: 'plan',
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
                        {field: 'PLAN_NAME', title: __('Plan_name')},
                        {field: 'USER_ID', title: __('广告主名称')},
                        {field: 'PLAN_TYPE', title: __('Plan_type')},
                        {field: 'COST_MONEY', title: __('Cost_money'), operate:'BETWEEN'},
                        {field: 'TOTAL_MONEY', title: __('Total_money'), operate:'BETWEEN'},
                        {field: 'PLAN_PRICE', title: __('Plan_price'), operate:'BETWEEN'},
                        // {field: 'ORDER_NUM', title: __('Order_num')},
                        {field: 'IS_EFFECTIVE', title: __('Is_effective'), searchList: {"0-失效":__('失效'),"1-正常":__('正常'),"2-已删除":__('已删除'),"3-锁定":__('锁定'),"4-锁定（余额不足）":__('锁定（余额不足）')}, formatter: Table.api.formatter.normal},
                        // {field: 'CREATE_TIME', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange'},
                        // {field: 'UPDATE_TIME', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'LIMIT_MONEY', title: __('Limit_money'), operate:'BETWEEN'},
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