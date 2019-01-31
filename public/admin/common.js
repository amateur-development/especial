$.ajaxSetup({
   headers:{
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
layui.use(['layer', 'form'], function(){
    var layer = layui.layer
        ,form = layui.form;
});

$('.ajax-form').submit(function () {
    var _this = $(this);
    var method = _this.attr('method');
    var action = _this.attr('action');
    var data = _this.serialize();
    var successCall = _this.data('success');
    var errorCall = _this.data('error');
    ajaxAPI(method,action,data,successCall,errorCall);
    return false;
});

$(".ajax-a").click(function(){
    var a = $(this);
    var method = a.data("method") || "get";
    var action = a.attr("href");
    var successCall = a.data('success');
    var errorCall = a.data('error');
    var data = a.data();
    if(a.hasClass('btn-danger')){
        layui.use(['layer', 'form'], function() {
            var layer = layui.layer;
            layer.confirm('确定操作？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                ajaxAPI(method, action, data, successCall, errorCall);
            }, function () {
            });
        });
    }else{
        ajaxAPI(method,action,data,successCall,errorCall);
    }
    return false;
});

var ajaxAPI = function(method,action,data,successCall,errorCall){
    $.ajax({
        type:method,
        url:action,
        data:data,
        dataType:"json",
        success:function(resp){
            if(resp.status === 1){
                if(successCall){
                    eval(successCall+'(resp)');
                }else{
                    if(resp.data.hasOwnProperty('jump_url')){
                        layui.use(['layer', 'form'], function() {
                            var layer = layui.layer;
                            layer.msg(resp.msg || 'success', {icon: 1});
                        });
                        setTimeout(function(){
                            window.location.href = resp.data.jump_url;
                        },3000);
                    }else{
                        layui.use(['layer', 'form'], function() {
                            var layer = layui.layer;
                            layer.alert(resp.msg || "操作成功");
                        });
                    }
                }
            }else{
                if(errorCall){
                    eval(errorCall+'(resp)');
                }else{
                    layui.use(['layer', 'form'], function() {
                        var layer = layui.layer;
                        var index = layer.alert(resp.msg || "操作失败", {icon: 2}, function () {
                            if (resp.data.hasOwnProperty('jump_url')) {
                                setTimeout(function () {
                                    window.location.href = resp.data.jump_url;
                                }, 3000);
                            } else {
                                    layer.close(index);
                            }
                        });
                    });
                }
            }
        },
        error:function(resp){
            if(errorCall){
                eval(errorCall+'(resp)');
            }else{
                layui.use(['layer', 'form'], function() {
                    var layer = layui.layer;
                    layer.alert('操作异常,请稍后再试', {icon: 2});
                });
            }
        }
    });
};