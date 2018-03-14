$(function(){
    $('.slide-toggle-btn').on('click',function(){
        $('.sidemenu').toggleClass('slideToggleActive')
    })
    if($('.datepicker').length > 0){
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: !0,
            language: 'zh-TW',
            todayHighlight: !0
        })
    }
    if($('.asset-table').length > 0){
        $('.asset-table').DataTable({
            "oLanguage": {
                "sLengthMenu": "每頁顯示 _MENU_ 筆資料",
                "sZeroRecords": "抱歉， 没有找到",
                "sInfo": "從 _START_ 到 _END_ /共 _TOTAL_ 筆資料",
                "sInfoEmpty": "沒有資料",
                "sInfoFiltered": "(從 _MAX_ 筆資料中搜尋)",
                "oPaginate": {
                    "sFirst": "第一頁",
                    "sPrevious": "上一頁",
                    "sNext": "下一頁",
                    "sLast": "最後一頁"
                }
            }
        })
    }
})