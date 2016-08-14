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
 

<!--图标样式-->
<link rel="stylesheet" type="text/css" href="/Public/bootstrap/css/bootstrap.min.css" />
<!--主要样式-->
<link rel="stylesheet" type="text/css" href="/Public/bootstrap/css/style.css" />
<script type="text/javascript" src="/Public/js/jquery-1.8.2.min.js"></script>
<style type="text/css">
    [class^="icon-"], [class*=" icon-"] {
        display: inline-block;
        width: 14px;
        height: 14px;
        margin-top: 1px;
        line-height: 14px;
        vertical-align: text-top;
        background-image: url("/Public/bootstrap//img/glyphicons-halflings.png");
        background-position: 14px 14px;
        background-repeat: no-repeat;
    }
    .icon-folder-open {
        width: 16px;
        background-position: -408px -120px;
    }
    .icon-minus-sign {
        background-position: -24px -96px;
    }
    .icon-plus-sign {
        background-position: 0 -96px;
    }
    .icon-leaf {
        background-position: -48px -120px;
    }
    .tree li:last-child::before {
        height: 25px;
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
                            <div class="collapse navbar-collapse">
                                <form method="post" role="search" class="navbar-form form-inline" id="search-form" action="#">
                                    <div class="form-group">
                                        <input type="text" placeholder="上级id" name="user_id" id="user_id"  class="form-control">
                                    </div>
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> 筛选</button>
                                    <input type="hidden" name="__hash__" value="a01e6d1e396fb3ce0a93cb19f162cfd3_3916459228c25bf1bc328ea4818f9d79" />
                                </form>
                            </div>
                        </nav>
                    </div>
                    <div class="box-body">
                        <div class="tree well">
                            <ul>
                                <!--循环start-->
                                <?php if(is_array($tree_list)): foreach($tree_list as $k=>$vo): ?><li>
									<span class="tree_span" data-id="<?php echo ($vo["user_id"]); ?>">
                                    	<i class="icon-folder-open"></i>
                                        <?php echo ($vo["tree_id"]); ?>:
                                        <?php echo ($vo["user_name"]); ?>
                                    </span>
                                </li><?php endforeach; endif; ?>
                                <!--循环end-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>

    //  ajax 请求树下面的节点
    $('.tree').on('click','.tree_span',function(){

        tmp_span = $(this);
        tmp_span.siblings('ul').toggle();
        if(tmp_span.hasClass('requrst'))
            return false;

        $.ajax({
            type : "post",
            url:"/index.php/Admin/Distribut/ajax_tree",//+tab,
            data : {'user_id':tmp_span.data('id')},
            success: function(data){
                tmp_span.after(data);
                tmp_span.addClass('requrst'); // 表示ajax 请求过了 不再请求第二次
            }
        });

    });
    /*ajax返回数据格式
    <ul>
         <li>
             <span class="tree_span" data-id="473">
                 <i class="icon-folder-open"></i>473:andy
             </span>
         </li>
     </ul>
     */
</script>
</body>
</html>