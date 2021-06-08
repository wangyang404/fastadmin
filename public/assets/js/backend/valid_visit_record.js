define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'valid_visit_record/index',
                    add_url: 'valid_visit_record/add',
                    edit_url: 'valid_visit_record/edit',
                    del_url: 'valid_visit_record/del',
                    multi_url: 'valid_visit_record/multi',
                    table: 'valid_visit_record',
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
                        {field: 'SITE_USER_ID', title: __('Site_user_id')},
                        {field: 'AD_ID', title: __('Ad_id')},
                        {field: 'PLAN_ID', title: __('Plan_id')},
                        {field: 'SPEND_TYPE', title: __('Spend_type')},
                        {field: 'PRICE', title: __('Price'), operate:'BETWEEN'},
                        {field: 'AD_PRICE', title: __('Ad_price'), operate:'BETWEEN'},
                        {field: 'IP_ADDRESS', title: __('Ip_address')},
                        {field: 'REFERER_URL', title: __('Referer_url'), formatter: Table.api.formatter.url},
                        {field: 'BROWSER_NAME', title: __('Browser_name')},
                        {field: 'BROWSER_VERSION', title: __('Browser_version')},
                        {field: 'OS', title: __('Os')},
                        {field: 'SCREEN', title: __('Screen')},
                        {field: 'CLICK_POINT', title: __('Click_point')},
                        {field: 'IS_VALID', title: __('Is_valid')},
                        {field: 'INVALID_MSG', title: __('Invalid_msg')},
                        {field: 'IS_HIDDEN', title: __('Is_hidden')},
                        {field: 'CREATE_TIME', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'VISIT_TYPE', title: __('Visit_type')},
                        {field: 'VISIT_DATE', title: __('Visit_date')},
                        {field: 'VIEW_TIME', title: __('View_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'DEVICE_TYPE', title: __('Device_type')},
                        {field: 'IP_SECTION', title: __('Ip_section')},
                        {field: 'CLICK_TIME', title: __('Click_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'REFERRER', title: __('Referrer')},
                        {field: 'CPU_PLATFORM', title: __('Cpu_platform')},
                        {field: 'CPU_CORE', title: __('Cpu_core')},
                        {field: 'GPU_SUPPLIER', title: __('Gpu_supplier')},
                        {field: 'GPU_RENDERER', title: __('Gpu_renderer')},
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