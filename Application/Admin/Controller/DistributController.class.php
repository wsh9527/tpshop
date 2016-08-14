<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: 当燃      
 * Date: 2015-09-09
 */
namespace Admin\Controller;


class DistributController extends BaseController {

    /*分销关系*/
    public function tree(){
        $condition = array('parent_id' => 0);
        I('post.user_id') ? $condition['parent_id'] = trim(I('post.user_id')) : false;
        $tree_arr = M('tree')->where($condition)->select();
        $this->assign('tree_list',$tree_arr);
        $this->display();
    }

    /*请求树下面的节点*/
    public function ajax_tree(){
        I('post.user_id') ? $condition['parent_id'] = trim(I('post.user_id')) : false;
        if($condition > 0){
            $tree_arr = M('tree')->where($condition)->select();
            $this->assign('ajax_tree_list',$tree_arr);
            $this->display('ajax_data_lower');
        }
    }

    /*分销设置*/
    public function set(){
        $group_list = array('shop_info'=>'网站信息','basic'=>'基本设置','sms'=>'短信设置','shopping'=>'购物流程设置','smtp'=>'邮件设置','water'=>'水印设置','distribut'=>'分销设置');
        $this->assign('group_list',$group_list);
        $this->assign('inc_type','distribut');
        $this->assign('config',tpCache('distribut'));//当前配置项
        C('TOKEN_ON',false);
        $this->display();
    }

    /*提现申请记录*/
    public function withdrawals(){
        $condition = array();
        I('status') ? $condition['status'] = trim(I('status')) : false;
        I('user_id') ? $condition['user_id'] = trim(I('user_id')) : false;
        I('account_bank') ? $condition['account_bank'] = trim(I('account_bank')) : false;
        I('account_name') ? $condition['account_name'] = trim(I('account_name')) : false;
        I('create_time') ? $condition['create_time'] = trim(I('create_time')) : false;
        if($condition['create_time']){
            $create_time = explode('-', $condition['create_time']);
            $begin = strtotime($create_time[0]);
            $end = strtotime($create_time[1]);
            if($begin && $end){
                $condition['create_time'] = array('between',"$begin,$end");
            }
        }
        $data_list = M('withdrawals')->where($condition)->order('id desc')->select();

        $data = array(
            'data_list' => $data_list
        );
        $this->assign('data_list',$data);
        $this->display();
    }

    /*汇款记录*/
    public function remittance(){
        $this->display();
    }

    /*分成记录*/
    public function rebate_log(){
        $this->display();
    }




}