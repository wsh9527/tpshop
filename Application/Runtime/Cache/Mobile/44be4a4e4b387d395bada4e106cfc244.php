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
    <div class="h-mid">退换货</div>
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
	<div class="main_thh">
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><table width="95%" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td>返修/退换货编号</td>
				<td><?php echo ($item["id"]); ?></td>
			</tr>
			<tr>
				<td>订单编号</td>
				<td><a target="_blank" href="<?php echo U('User/order_detail',array('id'=>$item['order_id']));?>"><?php echo ($item["order_sn"]); ?></a></td>
			</tr>
			<tr>
				<td>商品名称</td>
				<td><a href="<?php echo U('Goods/goodsInfo',array('id'=>$item[goods_id]));?>" target="_blank"><?php echo ($goodsList[$item[goods_id]]); ?></a></td>
			</tr>
			<tr>
				<td>申请时间</td>
				<td><?php echo (date("Y-m-d",$item["addtime"])); ?></td>
			</tr>
			<tr>
				<td>状态</td>
				<td>
                    <?php if($item['status'] == 0): ?>待客服处理<?php endif; ?>
                    <?php if($item['status'] == 1): ?>客服处理中<?php endif; ?>
                    <?php if($item['status'] == 2): ?>已完成<?php endif; ?>                
                </td>
			</tr>
			<tr>
				<td class="check_but_thh" colspan="2">
					<div>
						<a href="<?php echo U('User/return_goods_info',array('id'=>$item[id]));?>">查看</a>
					</div>
				</td>
			</tr>
		</table><?php endforeach; endif; else: echo "" ;endif; ?> 	 
    <?php if(empty($list)): ?><div id="list_0_0" class="font12">您没有任何售后数据哦！</div><?php endif; ?>    
	</div>
<?php if(!empty($list)): ?><div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both">
  		<a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a>
  </div><?php endif; ?>         
<script>
var  page = 1;
 /*** ajax 提交表单 查询订单列表结果*/  
 function ajax_sourch_submit()
 {	 	 	 
        page += 1;
		$.ajax({
			type : "GET",
			url:"/index.php?m=Mobile&c=User&a=return_goods_list&is_ajax=1&p="+page,//+tab,									
//			url:"<?php echo U('Mobile/User/return_goods_list',null,'');?>/is_ajax/1/p/"+page,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
			success: function(data)
			{
				if($.trim(data) == '')
					$('#getmore').hide();
				else
				    $(".main_thh").append(data);
			}
		}); 
 } 
</script>
    
</body>
</html>