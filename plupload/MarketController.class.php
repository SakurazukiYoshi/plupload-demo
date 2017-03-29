<?php

/*----------------------------------------------------------------------
 * Author: ming.nie
 ----------------------------------------------------------------------*/

namespace Wechat\Controller;
use Think\Controller;

class MarketController extends Controller
{
    //市场：微信平台申请账号密码
    public function apply()
    {
        if(IS_POST) {
            $params = array();
        }
        
        layout(false);
        
        C('PAGE_TITLE', '申请');
        $this->display('apply');
    }
    
    //图片上传测试
    public function upload()
    {
        layout(false);
        
        C('PAGE_TITLE', '申请');
        $this->display('upload');
    }
    
    //文件上传
    public function imgUpload()
    {
        $type = 'market_wechat_apply';
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize  = 5*1024*1024 ;// 设置附件上传大小
        $upload->exts  = array('jpg', 'png', 'jpeg', 'bmp');// 设置附件上传类型
        $upload->rootPath = ROOT_PATH.C('UPLOAD_DIR');
        $upload->savePath =  $type.'/';// 设置附件上传目录
        $upload->subName =  '';// 按日期目录
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $data['status'] = 0;
            $data['info']   = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $data['status'] = 1;
            $data['url']   = C('UPLOAD_DIR').$upload->savePath.$info['file']['savename'];
        }
        $this->ajaxReturn($data);
    }
}
