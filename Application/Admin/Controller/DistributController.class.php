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
        $create_time[0]?$startDate = $create_time[0]:$startDate = $this->last_month_today(time());
        $create_time[1]?$endDate = $create_time[1]:$endDate = date('Y/m/d');
        $data_list = M('withdrawals')->where($condition)->order('id desc')->select();
        $data_list = array(
            'data_list' => $data_list,
            'startDate' => $startDate,
            'endDate' => $endDate
        );
        $this->assign('data_list',$data_list);
        $this->display();
    }

    /*编辑提现申请记录*/
    public function editWithdrawals(){
        if(IS_POST){
            I('user_id') ? $condition['user_id'] = trim(I('user_id')) : false;
            $users = M('users')->where($condition)->find();
            $remark = trim(I('remark'));
            if(!$users)
                $this->error('用户信息错误!');
            if(!$remark)
                $this->error('备注不能为空!');
            I('id') ? $condition['id'] = trim(I('id')) : false;
            $condition['if_del'] = 0;
            $withdrawals = M('withdrawals')->where($condition)->find();
            I('status') ? $status = trim(I('status')) : false;

            if(!empty($withdrawals) && $users['user_money'] > $withdrawals['money'] && $status == 1 && $withdrawals['status'] == 0){
                $remark = trim(I('remark'));
                M('users')->where(array('user_id' => $condition['user_id']))->setDec('user_money',$withdrawals['money']);
                M('withdrawals')->where($condition)->save(array('status' => $status,'remark' => $remark));
            }
            $this->success('生成转账记录成功',U('Admin/Distribut/withdrawals'));
        }else{
            I('id') ? $condition['id'] = trim(I('id')) : false; //id
            $condition['if_del'] = 0;
            if($condition > 0){
                $data = M('withdrawals')->where($condition)->find();
                if(!empty($data['user_id']))
                    $users_info = M('users')->where(array('user_id' => $data['user_id']))->field('user_money,nickname')->find();
                $data['user_money'] = $users_info['user_money'];
                $data['nickname'] = $users_info['nickname'];
                $data_info = array(
                    'data_info' => $data
                );
                $this->assign($data_info);
                $this->display();
            }
        }

    }
    /*删除提现申请记录*/
    public function delWithdrawals(){
        I('id') ? $condition['id'] = trim(I('id')) : false; //id
        if($condition['id'] > 0)
            $data = M('withdrawals')->where($condition)->find();
        if($data['if_del'] == 0)
            $res = M('withdrawals')->where($condition)->save(array('if_del' => 1));
        if($res){
            $sr = array(
              'status' => 1,
              'msg' => '删除记录成功'
            );
        }else{
          $sr = array(
            'status' => 0,
            'msg' => '删除记录失败'
          );
        }
        $this->ajaxReturn($sr);
    }
    /*汇款记录*/
    public function remittance(){
        $this->display();
    }

    /*分成记录*/
    public function rebate_log(){
        $this->display();
    }
    /*上一个月的今天 没有返回最后一天*/
    function last_month_today($time){
        $last_month_time = mktime(date("G", $time), date("i", $time),date("s", $time), date("n", $time), 0, date("Y", $time));
        $last_month_t =  date("t", $last_month_time);  //二月份的天数
        if ($last_month_t < date("j", $time))
            return date("Y-m-t H:i:s", $last_month_time);
        return date(date("Y/m", $last_month_time) . "/d", $time);
    }
}
