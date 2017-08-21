<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Think\Upload\Driver;

class Localfile extends Local
{
    /**
     * 保存指定文件
     * @param  array   $file    保存的文件信息
     * @param  boolean $replace 同名文件是否覆盖
     * @return boolean          保存状态，true-成功，false-失败
     */
    public function save($file, $replace = true)
    {
    	if(!is_file($file['tmp_name'])){
    		$this->error = '源文件不存在';
        	return false;
    	}
    	
        $filename = $this->rootPath . $file['savepath'] . $file['savename'];

        /* 不覆盖同名文件 */
        if (!$replace && is_file($filename)) {
            $this->error = '存在同名文件' . $file['savename'];
            return false;
        }

        /* 移动文件 */
        if (!copy($file['tmp_name'], $filename)) {
            $this->error = '文件上传保存错误！';
            return false;
        }
        
        
        if(!is_file($filename)){
        	$this->error = '文件上传保存错误！';
        	return false;
        }
        unlink($file['tmp_name']);
        return true;
    }

}
