<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="TPSHOP v1.1" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="applicable-device" content="mobile">
<title><?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<meta name="Keywords" content="TPshop触屏版  TPshop 手机版" />
<meta name="Description" content="TPshop触屏版   TPshop商城 "/>
<link rel="stylesheet" href="/Template/mobile/new/Static/css/public.css">
<link rel="stylesheet" href="/Template/mobile/new/Static/css/user.css">
<script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.js"></script>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/mobile_common.js"></script>
<script type="text/javascript" src="/Template/mobile/new/Static/js/modernizr.js"></script>
<script type="text/javascript" src="/Template/mobile/new/Static/js/layer.js" ></script>
</head>

<body>
<header>
<div class="tab_nav">
   <div class="header">
     <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
     <div class="h-mid">我的订单</div>
     <div class="h-right">
       <aside class="top_bar">
         <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a href="javascript:;"></a> </div>
       </aside>
     </div>
   </div>
 </div>
</header>
<script type="text/javascript" src="/Template/mobile/new/Static/js/mobile.js" ></script>
<div class="goods_nav hid" id="menu">
      <div class="Triangle">
        <h2></h2>
      </div>
      <ul>
        <li><a href="<?php echo U('Index/index');?>"><span class="menu1"></span><i>首页</i></a></li>
        <li><a href="<?php echo U('Goods/categoryList');?>"><span class="menu2"></span><i>分类</i></a></li>
        <li><a href="<?php echo U('Cart/cart');?>"><span class="menu3"></span><i>购物车</i></a></li>
        <li style=" border:0;"><a href="<?php echo U('User/index');?>"><span class="menu4"></span><i>我的</i></a></li>
   </ul>
 </div> 

<div id="tbh5v0">
<!--------筛选 form 表单 开始-------------->
<form action="<?php echo U('Mobile/order_list/ajax_order_list');?>" name="filter_form" id="filter_form">  
      <div class="Evaluation2">
            <ul>
              <li><a href="<?php echo U('/Mobile/User/order_list');?>" class="tab_head <?php if($_GET[type] == ''): ?>on<?php endif; ?>"  >全部</a></li>
              <li><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITPAY'));?>"      class="tab_head <?php if($_GET[type] == 'WAITPAY'): ?>on<?php endif; ?>">待付款</a></li>
              <li><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITSEND'));?>"     class="tab_head <?php if($_GET[type] == 'WAITSEND'): ?>on<?php endif; ?>">待发货</a></li>
              <li><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITRECEIVE'));?>"  class="tab_head <?php if($_GET[type] == 'WAITRECEIVE'): ?>on<?php endif; ?>">待收货</a></li>
              <li><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITCCOMMENT'));?>" class="tab_head <?php if($_GET[type] == 'WAITCCOMMENT'): ?>on<?php endif; ?>">已完成</a></li>
            </ul>
      </div>     
      
	<div class="order ajax_return">
	   <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="order_list">
          <h2>
              <a href="javascript:void(0);">
                  <img src="/Template/mobile/new/Static/images/dianpu.png"><span>店铺名称:网站自营</span><strong>
                  <img src="/Template/mobile/new/Static/images/icojiantou1.png"></strong>
              </a>
          </h2>
         	<a href="<?php echo U('/Mobile/User/order_detail',array('id'=>$list['order_id']));?>">
	          <?php if(is_array($list["goods_list"])): $i = 0; $__LIST__ = $list["goods_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?><dl style="position: relative">  
		          <dt><img src="<?php echo (goods_thum_images($good["goods_id"],200,200)); ?>"></dt>
		          <dd class="name"><strong><?php echo ($good["goods_name"]); ?></strong>
		          <span style="position: absolute;"><?php echo ($good["spec_key_name"]); ?> </span></dd>
		          <dd class="pice">￥<?php echo ($good['member_goods_price']); ?>元<em>x<?php echo ($good['goods_num']); ?></em></dd>
				  <dd class="pice">                  
                  	<em>                    	  
                          <?php if(($list[return_btn] == 1) and ($good[is_send] == 1)): ?><a href="<?php echo U('Mobile/User/return_goods',array('order_id'=>$list[order_id],'order_sn'=>$list[order_sn],'goods_id'=>$good[goods_id],'spec_key'=>$good['spec_key']));?>" style="color:#999;">申请售后</a><?php endif; ?>
                    </em>
                  </dd>                  
                  
		          </dl><?php endforeach; endif; else: echo "" ;endif; ?>
          	</a>
          <div class="pic">共<?php echo (count($list["goods_list"])); ?>件商品<span>实付：</span><strong>￥<?php echo ($list['order_amount']); ?>元</strong></div>
          <div class="anniu" style="width:95%">
                <?php if($list["cancel_btn"] == 1): ?><span onClick="cancel_order(<?php echo ($list["order_id"]); ?>)">取消订单</span><?php endif; ?>
                <?php if($list["pay_btn"] == 1): ?><a href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$list['order_id']));?>">立即付款</a><?php endif; ?>
                <?php if($list["receive_btn"] == 1): ?><a href="<?php echo U('Mobile/User/order_confirm',array('id'=>$list['order_id']));?>">收货确认</a><?php endif; ?>    
                <?php if($list["comment_btn"] == 1): ?><a href="<?php echo U('/Mobile/User/comment');?>">评价</a><?php endif; ?>
                <?php if($list["shipping_btn"] == 1): ?><a href="<?php echo U('User/express',array('order_id'=>$list['order_id']));?>">查看物流</a><?php endif; ?>
          </div>
       </div><?php endforeach; endif; else: echo "" ;endif; ?>  
    </div>
  <!--查询条件-->
  <input type="hidden" name="type" value="<?php echo $_GET['type'];?>" />
</form>   
<?php if(!empty($lists)): ?><div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both">
  		<a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a>
  </div><?php endif; ?>    
</div>


<script language="javascript">
var  page = 1;
 
 /*** ajax 提交表单 查询订单列表结果*/  
 function ajax_sourch_submit()
 {	 	
 		page += 1; 	 
		$.ajax({
			type : "GET",
			url:"/index.php?m=Mobile&c=User&a=order_list&type=<?php echo ($_GET['type']); ?>&is_ajax=1&p="+page,//+tab,			
//			url:"<?php echo U('Mobile/User/order_list',array('type'=>$_GET['type']),'');?>/is_ajax/1/p/"+page,//+tab,			
			//data : $('#filter_form').serialize(),
			success: function(data)
			{
				if(data == '')
					$('#getmore').hide();
				else  
				{
					$(".ajax_return").append(data);			
					$(".m_loading").hide();
				}
			}
		}); 
 }
 
//取消订单
function cancel_order(id){
	if(!confirm("确定取消订单?"))
		return false;
	location.href = "/index.php?m=Mobile&c=User&a=cancel_order&id="+id;
}

</script>
</body>
</html>