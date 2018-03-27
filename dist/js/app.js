function getTodayTime(){
    var str='';
    var now_date=new Date();
    var now_Year=now_date.getFullYear();
    var now_Month=now_date.getMonth()+1;
    var now_Day=now_date.getDate();
    var now_Hour=now_date.getHours();
    var now_Min=now_date.getMinutes();
    var now_Sec=now_date.getSeconds();
    if(now_Month < 10){
        now_Month ='0'+now_Month;
    }
    if(now_Day < 10){
        now_Day ='0'+now_Day;
    }
    if(now_Hour < 10){
        now_Hour ='0'+now_Hour;
    }
    if(now_Min < 10){
        now_Min ='0'+now_Min;
    }
    if(now_Sec < 10){
        now_Sec ='0'+now_Sec;
    }
    str=`${now_Year}-${now_Month}-${now_Day} ${now_Hour}:${now_Min}:${now_Sec}`
    return str;
}
$(function(){
    $('.slide-toggle-btn').on('click',function(){
        $('.content-main').toggleClass('toggle');
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
        var dataType=$('.datepicker').attr('data-type')
        if(dataType == 'datetime'){

            $('.datepicker').on('focus',function(){
                $(this).val(getTodayTime())
            })
        }else{
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: !0,
                language: 'zh-TW',
                todayHighlight: !0
            })
        }
    }

    var getUrl=location.pathname.split('/')[2].split('.')[0];
    $('.sidemenu-nav li').each(function(i,v){
        if(getUrl == 'index' || getUrl == '' || getUrl == 'announcement' || getUrl == 'space-management' || getUrl == 'management'){
            $('.sidemenu-nav li').eq(0).find('.sidemenu-link').addClass('active')
        }
        if($(v).find('.sidemenu-link').attr('data-type') == getUrl){
            $(this).find('.sidemenu-link').addClass('active')
        }
    })
})