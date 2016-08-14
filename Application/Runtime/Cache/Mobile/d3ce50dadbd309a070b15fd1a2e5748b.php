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
    <div class="h-mid">信息修改</div>
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
<div class="Personal">
  <div id="tbh5v0">
    <div class="innercontent1" >
      <form method="post" action="" id="edit_profile"  onSubmit="return checkinfo()">
        <div class="name"><span>昵　 称</span>
          <input type="text" name="nickname" id="nickname" value="<?php echo ($user["nickname"]); ?>" placeholder="*昵称" class="c-f-text">
        </div>
      
        <div class="name1"> <span>性　 别</span>
          <ul>
            <li  <?php if($user['sex']==0) {echo 'class="on"';} ?>   >
              <label for="sex0">
               <input type="radio" name="sex" value="0" tabindex="2"  class="radio" id="sex0" <?php if($user['sex']==0) {echo 'checked="checked"';} ?>>
               	 保密</label>
            </li>
            <li  <?php if($user['sex']==1) {echo 'class="on"';} ?> >
              <label for="sex1">
                <input type="radio" name="sex" value="1" tabindex="3" class="radio" id="sex1" <?php if($user['sex']==1) {echo 'checked="checked"';} ?> >
                	男</label>
            </li>
            <li  <?php if($user['sex']==2) {echo 'class="on"';} ?> >
              <label for="sex2">
                <input type="radio" name="sex" value="2" tabindex="4" class="radio" id="sex2" <?php if($user['sex']==2) {echo 'checked="checked"';} ?>>
                	女</label>
            </li>
          </ul>
        </div>        
         
        <div class="name">
          <label for="email_ep"> <span>邮箱</span>
            <input name="email" value="<?php echo ($user["email"]); ?>" id="email_ep" placeholder="*电子邮件地址" type="text" />
          </label>
        </div>
        <div class="name">
          <label for="email_ep"> <span>手机</span>
            <input name="mobile" value="<?php echo ($user["mobile"]); ?>" id="mobile_ep" placeholder="*手机号码" type="text" />
          </label>
        </div>        
        <div class="field submit-btn">
          <input type="submit" value="确认修改" class="btn_big1" />
        </div>
      </form>
    </div>

    <div class="innercontent11" >
      <form name="formPassword" action="<?php echo U('User/password');?>" method="post" onSubmit="return editPassword()">
        <h4 class="title">密码修改</h4>
        <div class="field_pwd">
          <label for="password">
            <input type="password" name="old_password" id="password" class="c-f-text" placeholder="原密码" value=""/>
          </label>
        </div>
        <div class="field_pwd">
          <label for="new_password">
            <input type="password" name="new_password" id="new_password" class="c-f-text" placeholder="新密码"/>
          </label>
        </div>
        <div class="field_pwd">
          <label for="comfirm_password"> 
            <input type="password" name="confirm_password" id="comfirm_password" class="c-f-text" placeholder="确认密码"/>
          </label>
        </div>
        <div class="field submit-btn">
          <input type="submit" value="确认修改" class="btn_big1" />
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    $('.name1 ul li').click(function(){
		$(this).find("input").attr("checked","checked");
	$('.name1 ul li').removeClass("on");
		$(this).addClass("on");
	})
</script>								
</div>

<script language="javascript">
$(function(){ 
	$('input[type=text],input[type=password]').bind({ 
		focus:function(){ 
		 $(".global-nav").css("display",'none'); 
		}, 
		blur:function(){ 
		 $(".global-nav").css("display",'flex'); 
		} 
	}); 
}) 

var email_empty = "请输入您的电子邮件地址！";
var email_error = "您输入的电子邮件地址格式不正确！";
var old_password_empty = "请输入您的原密码！";
var new_password_empty = "请输入6位以上新密码！";
var confirm_password_empty = "请输入6位以上确认密码！";
var both_password_error = "您现两次输入的密码不一致！";
/* 会员修改密码 */
function editPassword() {
	var frm = document.forms['formPassword'];
	var old_password = frm.elements['old_password'].value;
	var new_password = frm.elements['new_password'].value;
	var confirm_password = frm.elements['comfirm_password'].value;

	var msg = '';
	var reg = null;

	if (old_password.length == 0) {
		msg += old_password_empty + '\n';
	}

	if (new_password.length < 6) {
		msg += new_password_empty + '\n';
	}

	if (confirm_password.length < 6) {
		msg += confirm_password_empty + '\n';
	}

	if (new_password.length > 0 && confirm_password.length > 0) {
		if (new_password != confirm_password) {
			msg += both_password_error + '\n';
		}
	}

	if (msg.length > 0) {
		alert(msg);
		return false;
	} else {
		return true;
	}
}

function checkinfo(){
	var nickname = $('#nickname').val();
	var email = $('#email_ep').val();
	var mobile = $('#mobile_ep').val();	
	if(nickname==''){
		alert("昵称不能为空");
		return false;
	}
	
	if(!checkEmail(email)){
		alert("邮箱格式不正确");
		return false;
	}
	
	if(!checkMobile(mobile)){
		alert("手机格式不正确");
		return false;
	}	
	return true;
}
</script>
</body>
</html>