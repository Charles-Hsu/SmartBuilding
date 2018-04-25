function getZero(number){
    if(number < 10){
        return number='0'+number
    }
}
function getTodayTime(){
    var str='';
    var now_date=new Date();
    var now_Year=now_date.getFullYear();
    var now_Month=now_date.getMonth()+1;
    var now_Day=now_date.getDate();
    var now_Hour=now_date.getHours();
    var now_Min=now_date.getMinutes();
    var now_Sec=now_date.getSeconds();

    str=`${now_Year}-${getZero(now_Month)}-${getZero(now_Day)} ${getZero(now_Hour)}:${getZero(now_Min)}:${getZero(now_Sec)}`
    return str;
}



var findIP = new Promise(r=>{var w=window,a=new (w.RTCPeerConnection||w.mozRTCPeerConnection||w.webkitRTCPeerConnection)({iceServers:[]}),b=()=>{};a.createDataChannel("");a.createOffer(c=>a.setLocalDescription(c,b,b),b);a.onicecandidate=c=>{try{c.candidate.candidate.match(/([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g).forEach(r)}catch(e){}}})
findIP.then( ip => document.getElementById('ip_address').value=ip ).catch(e => console.error(e))

function dragElement(elmnt){
    var pos1=0,pos2=0,pos3=0,pos4=0;
    if(document.getElementById(elmnt.id+'-header')){
        document.getElementById(elmnt.id+'-header').onmousedown=dragMouseDown;
    }else{
        elmnt.onmousedown=dragMouseDown;
        console.log(123)
    }


    function dragMouseDown(e){
        e=e||window.event;
        pos3=e.clientX;
        pos4=e.clientY;
        document.onmouseup=closeDragElement;
        document.onmousemove=elementDrag;
    }
    function elementDrag(e){
        e=e||window.event;
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }
    function closeDragElement(){
        document.onmouseup=null;
        document.onmousemove=null;
    }
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
            $('.datepicker').val(getTodayTime())
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
        if(getUrl == 'index' || getUrl == '' || getUrl == 'announcement' || getUrl == 'space-management' || getUrl == 'regulation' || getUrl == 'overduelist' || getUrl == 'opinionlist' || getUrl.substring(0, "evaluation".length) == 'evaluation') {
            $('.sidemenu-nav li').eq(0).find('.sidemenu-link').addClass('active')
        }
        if($(v).find('.sidemenu-link').attr('data-type') == getUrl){
            $(this).find('.sidemenu-link').addClass('active')
        }
    })
})