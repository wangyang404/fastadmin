define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'setting/index' + location.search,
                    add_url: 'setting/add',
                    edit_url: 'setting/edit',
                    del_url: 'setting/del',
                    multi_url: 'setting/multi',
                    table: 'setting',
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
                        {field: 'ID', title: __('Id')},
                        {field: 'SETTING_NAME', title: __('Setting_name')},
                        {field: 'SETTING_CODE', title: __('Setting_code')},
                        {field: 'SETTING_VALUE', title: __('Setting_value')},
                        {field: 'PARENT_CODE', title: __('Parent_code')},
                        {field: 'REMARK', title: __('Remark')},
                        {field: 'ORDER_NUM', title: __('Order_num')},
                        {field: 'CREATE_TIME', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'UPDATE_TIME', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'IS_LEAF', title: __('Is_leaf')},
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