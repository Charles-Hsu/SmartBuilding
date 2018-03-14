$(function(){
    $('.slide-toggle-btn').on('click',function(){
        $('.sidemenu').toggleClass('slideToggleActive')
        if($('.sidemenu').hasClass('slideToggleActive')){
            $(this).removeClass('fas fa-outdent')
            $(this).addClass('fas fa-indent')
        }else{
            $(this).removeClass('fas fa-indent')
            $(this).addClass('fas fa-outdent')
        }
    })

    if($('.datepicker').length > 0){
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: !0,
            language: 'zh-TW',
            todayHighlight: !0
        })
    }

    var getUrl=location.pathname.split('/')[2].split('.')[0];
    $('.sidemenu-nav li').each(function(i,v){
        if($(v).find('.sidemenu-link').attr('data-type') == getUrl){
            $(this).find('.sidemenu-link').addClass('active')
        }
    })
})