<?php if (!defined('THINK_PATH')) exit(); if(is_array($goods_list)): foreach($goods_list as $k=>$vo): ?><li>
    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$vo[goods_id]));?>" class="item">
        <div class="pic_box">
            <div class="active_box">
                <span style=" background-position:0px -36px">新品</span>
            </div>
            <img src="<?php echo (goods_thum_images($vo["goods_id"],400,400)); ?>">
        </div>
        <div class="title_box"><?php echo ($vo["goods_name"]); ?></div>
        <div class="price_box">
            <span class="new_price"><i>￥<?php echo ($vo["shop_price"]); ?>元</i></span>
        </div>
        <div class="comment_box">已售0</div>
    </a>
    <div class="ui-number b"> 
        <a class="decrease" onClick="goods_cut(<?php echo ($vo["goods_id"]); ?>);">-</a>
        <input class="num" id="number_<?php echo ($vo["goods_id"]); ?>" type="text" onBlur="changePrice();" value="1" onFocus="if(value=='1') {value=''}" size="4" maxlength="5">
        <a class="increase" onClick="goods_add(<?php echo ($vo["goods_id"]); ?>);">+</a> 
    </div>
    <span class="bug_car" onClick="AjaxAddCart(<?php echo ($vo[goods_id]); ?>,1,0);"><i class="icon-shop_cart"></i></span>
  </li><?php endforeach; endif; ?>