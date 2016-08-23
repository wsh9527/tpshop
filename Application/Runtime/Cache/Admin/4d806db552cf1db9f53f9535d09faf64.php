<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>tpshop管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
 	<link href="/Public/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    	folder instead of downloading all of them to reduce the load. -->
    <link href="/Public/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/Public/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />   
    <!-- jQuery 2.1.4 -->
    <script src="/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="/Public/js/global.js"></script>
    <script src="/Public/js/myFormValidate.js"></script>    
    <script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/js/layer/layer-min.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
    <script src="/Public/js/myAjax.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['90%', '90%'],
            content: $(obj).attr('data-url'), 
        });
    }
    </script>        
  </head>
  <body style="background-color:#ecf0f5;">
 

<link href="/Public/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="/Public/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="/Public/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<div class="wrapper">
    <div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<li><a href="javascript:void();"><i class="fa fa-home"></i>&nbsp;&nbsp;后台首页</a></li>

	        <li><a href="javascript:void();">分销管理</a></li>
	        <li><a href="javascript:void();"></a></li>
	</ol>
</div>

    <section class="content">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">

                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 获佣记录</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_tongyong" data-toggle="tab">获佣用户</a></li>
                    </ul>
                    <!--表单数据-->
                    <form method="post" id="editForm">
                        <!--通用信息-->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_tongyong">

                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>获佣用户id</td>
                                    <td>
                                        <a href="/index.php/Admin/user/detail/id/573">573</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>获佣用户名</td>
                                    <td>
                                        itworker                                    </td>
                                </tr>
                                <tr>
                                    <td>获佣订单</td>
                                    <td>
                                        <a href="/index.php/Admin/order/detail/order_id/399">201607061812366062</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>获佣金额</td>
                                    <td>
                                        276.00                                    </td>
                                </tr>
                                <tr>
                                    <td>获佣用户级别</td>
                                    <td>
                                        1                                    </td>
                                </tr>
                                <tr>
                                    <td>分成记录生成时间</td>
                                    <td>
                                        2016-07-06 18:12                                    </td>
                                </tr>
                                <tr>
                                    <td>状态</td>
                                    <td>
                                        未付款
                                    </td>
                                </tr>
                                <tr>
                                    <td>确定分成或者取消时间</td>
                                    <td>
                                        2016-07-06 18:12                                    </td>
                                </tr>
                                <tr>
                                    <td>备注</td>
                                    <td>
                                        <textarea rows="4" cols="60" id="remark" name="remark"></textarea>
                                        <span id="err_remark" style="color:#F00; display:none;"></span>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="pull-right">
                        <input type="hidden" name="id" value="117">
                        <input type="hidden" name="user_id" value="573">
                        <input type="hidden" id="status" name="status" value="0">
                                                    <button class="btn btn-primary" data-toggle="tooltip" type='submit'>修改备注</button>
                    </div>
                 <input type="hidden" name="__hash__" value="40aca22cfab0207e2667ad5a08e84cc0_41484770b98a2fa3b1a3c36a7f95c258" /></form><!--表单数据-->
                </div>
            </div>
        </div>    <!-- /.content -->
    </section>
</div>
<script>
// 确定分成
function confirm_rebate()
{
    if(!confirm('金额将直接转入用户余额,确定要分成吗?'))
        return false;

    if($.trim($('#remark').val()).length == 0)
    {
        alert('请填写分成备注');
        return false;
    }

    $('#status').val('3');
    $('#editForm').submit();
}
// 取消分成
function cancel_rebate()
{
    if(!confirm('确定要取消分成吗?'))
        return false;

    if($.trim($('#remark').val()).length == 0)
    {
        alert('请填写取消备注');
        return false;
    }

    $('#status').val('4');
    $('#editForm').submit();
}
</script>
</body>
</html>