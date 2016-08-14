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
 

<style>
ul.group-list {
    width: 96%;min-width: 1000px; margin: auto 5px;list-style: disc outside none;
}
ul.group-list li {
    white-space: nowrap;float: left;
    width: 150px; height: 25px;
    padding: 3px 5px;list-style-type: none;
    list-style-position: outside;border: 0px;margin: 0px;
}
</style>
<div class="wrapper">
	<div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					<nav class="navbar navbar-default">	
						<div class="navbar-form">
			               	<label><a href="javascript:void(0)" class="btn btn-block btn-primary" data-url="<?php echo U('System/ctl_detail');?>" id="add_ctl">添加控制模块</a></label>			        
			        		<a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn pull-right btn-default" data-original-title=""><i class="fa fa-reply"></i></a>
				            <a href="javascript:;" class="btn pull-right btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/259/developer/phper.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 在线帮助</a>
			        	</div>
			        </nav>
					</div>
		            <div class="box-body">
			           <div class="row">
			            	<div class="col-sm-12">
				            <table id="list-table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<?php if(is_array($tree)): foreach($tree as $key=>$v): if(is_array($v["menu"])): foreach($v["menu"] as $key=>$vv): ?><tr>
									<td class="" style="padding-right:50px;">
										<?php echo ($v["title"]); ?> &gt; <?php echo ($vv["title"]); ?>
										<span class="pull-right">
											<a href="javascript:void(0)" class="btn btn-default model_edit" data-url="<?php echo U('System/ctl_detail',array('mod_id'=>$vv[mod_id]));?>">管理模型</a>
											<a href="javascript:void(0)" class="btn btn-info menu_edit" data-url="<?php echo U('System/create_menu',array('mod_id'=>$vv[mod_id],'action'=>'edit'));?>">编辑导航</a>
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<ul class="group-list">
										<?php if(empty($vv["menu"])): ?><li style="color:#FF3300;">未添加模型</li>
										<?php else: ?>
											<?php if(is_array($vv["menu"])): foreach($vv["menu"] as $key=>$vo): ?><li><?php echo ($vo["title"]); ?>[<?php if($vo["visible"] == 0): ?><b class="bg-red">显示</b><?php else: ?>隐藏<?php endif; ?>]</li><?php endforeach; endif; endif; ?>
										</ul>
									</td>
								</tr><?php endforeach; endif; endforeach; endif; ?>
				            </table>
			               </div>
			          </div>
		          </div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
$('.menu_edit').click(function(){
    var url = $(this).attr('data-url');
    layer.open({
        type: 2,
        title: '编辑导航',
        shadeClose: true,
        shade: 0.8,
        area: ['400px', '300px'],
        content: url, //iframe的url
    });
});

$('.model_edit').click(function(){
    var url = $(this).attr('data-url');
    layer.open({
        type: 2,
        title: '管理模型',
        shadeClose: true,
        shade: 0.8,
        area: ['80%', '70%'],
        content: url, //iframe的url
    });
});

$('#add_ctl').click(function(){
    var url = $(this).attr('data-url');
    layer.open({
        type: 2,
        title: '添加控制模块',
        shadeClose: true,
        shade: 0.8,
        area: ['80%', '70%'],
        content: url, //iframe的url
    });
});


//回调函数
function call_back(msg){
	if(msg>0){
		layer.alert('操作成功');
		layer.closeAll('iframe');
		window.location.reload();
	}else{
		layer.alert('操作失败');
		layer.closeAll('iframe');
	}
}
</script>

</body>
</html>