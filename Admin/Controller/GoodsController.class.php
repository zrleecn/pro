<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/29/029
 * Time: 10:00
 */

namespace Admin\Controller ;
use Admin\Controller;
use Think\Image;
use Think\Upload;

class GoodsController extends CommonController {

    /**
     * 上传商品展示页面
     */
    public function upload_goods(){
        $goods = M('category') ;
        //加载分类 动态添加到页面上
        $data = $goods->select() ;
        $this->category = $data ;
        $this->display ();
    }

    /**
     * 商品上传处理
     */
    public function upload(){
        $form_data = $_POST;

        $goodsModel = M('goods') ;

        //文件上传配置
        $config = array(
            'maxSize' => 3145728,
            'rootPath' => './Public/upload/',
            'savePath' => '',
            'saveName' => array('uniqid',''),
            'exts' => array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub' => true,

        );

        // 实例化上传类
        $file_upload = new Upload($config) ;
//        $file_upload->maxSize = 3145728 ;// 设置附件上传大小
        // 设置附件上传类型

        //长传图片
        if($info = $file_upload->upload()){ //上传成功
            //图片路径
            $image_path = 'upload/' .$info['pic']['savepath']. $info['pic']['savename'] ;
            //实例化图形处理对象
            $image = new Image() ;
            //打开图片流
            $image->open("./Public/" .$image_path) ;
            //制作缩略图 保存
            $image->thumb(385,236)->save("./Public/" .$image_path) ;
            //追加图片路径到form_data数组
            $form_data['thumb_image'] = $image_path ;

           // 插入新数据
            if( $goodsModel->add($form_data) ){
                //获得用户名
                $user_name = session('user_name') ;
                //实例化用户模型
                $userModel = M('user') ;

                //查询当前发布的商品id
                $goods_row = $goodsModel->field('goods_id')->order('goods_id desc')->find() ;
                $goods_id =  $goods_row['goods_id'] ;

                //查询用户发布商品的id
                $row = $userModel->where("user_name='$user_name'")->find() ;
                $public_goods_id = $row['public_goods_id'] ;

                //更新用户发布商品id
                if($public_goods_id){
                    $public_goods_id .=",$goods_id" ;
                }else{
                    $public_goods_id = $goods_id ;
                }

                $userdata['public_goods_id'] = $public_goods_id ;
                $userModel->where("user_name='$user_name'")->save($userdata) ;

                $this->success('发布成功' , U("Admin/Index/my") , 1) ;
            }

        }else{
            echo $file_upload->getError() ;
            echo "<br><a href='upload_goods'>返回</a>" ;
        }




    }


    /**
     * 删除发布的商品
     */

    public function delete_goods(){
        $m = M('goods') ;
        //商品id
        $id = $_GET['goods_id'] ;
        //实例化商品模型
        $goodsModel = M('goods') ;
        $goods_data = $goodsModel->where("goods_id='$id'")->find() ;

        //删除图片
        if(unlink( "./Public/".$goods_data['thumb_image']) ){
            if($m->where("goods_id='$id'")->delete()){

                //删除用户表对应的发布商品id
                $user = M('user') ;
                $uname = session('user_name') ;

                $public_id = $user->where("user_name='$uname'")->field('public_goods_id')->find() ;
                //组织成数组
                $arr_id = explode(',',$public_id['public_goods_id']) ;
                $index = array_search($id , $arr_id) ;
                if($index !== false) {
                    unset($arr_id[$index]);
                }
                $str_id = implode(',' , $arr_id) ;
                $user = M('user');
                $update['public_goods_id'] = $str_id ;
                //更新用户发布商品的id
                if($user->where("user_name='$uname'")->save($update) ){


                     $this->success('移除商品成功',U('Admin/Index/my'),1);
                }else{
                    $this->error('移除失败！',U('Admin/Index/my') ,1);

                }

            }else{
                $this->error('移除商品失败',U('Admin/Index/my'),1);
            }
        }else{
            $this->error('移除商品失败',U('Admin/Index/my'),1);
        }







    }

    /**
     * 删除收藏的商品
     */

    public function delete_collection(){
        $m = M('user') ;
        $user_name = session('user_name') ;  //当前操作的用户
        if(!$user_name){
            $this->error("您还没有登录" , U('Home/Index/myaccount'),2) ;
        }
        $goods_id = $_GET['goods_id'] ;   //获得要删除的收藏商品的id
        //查询该用户的收藏商品id
        $data = $m->where("user_name='$user_name'")->field('collection_goods_id')->find();
        $arr_id = explode(',' , $data['collection_goods_id']) ;
        $index = array_search($goods_id , $arr_id);
        //移除商品id
        unset($arr_id[$index]) ;
        //组织成字符串
        $str_id = implode(',' , $arr_id) ;
        $update['collection_goods_id'] =$str_id ;
        if($m->where("user_name='$user_name'")->save($update) ){
            $this->success('移除成功！',U('Admin/Index/collection'));
        }else{
            $this->error('移除失败！',U('Admin/Index/collection'));
        }


    }

    public function test(){
        $script_name = $_SERVER['SCRIPT_NAME'] ;

        $rootpath = substr($script_name , 0 , strrpos($script_name , '/')+1) ;
        echo $rootpath ;
    }

}