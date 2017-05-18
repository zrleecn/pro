<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品列表</title>
    <link rel="stylesheet" href="/web/shop2/Public/bootstrap/css/bootstrap.min.css">
    <script src="/web/shop2/Public/js/jquery.js"></script>
    <script src="/web/shop2/Public/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/web/shop2/Public/css/font-awesome.min.css">
    <link rel="stylesheet" href="/web/shop2/Public/css/index.css">
    <link rel="stylesheet" href="/web/shop2/Public/css/login.css">
    <link rel="stylesheet" href="/web/shop2/Public/css/upload_goods.css">
    <script src="/web/shop2/Public/js/holder.js"></script>
    <script src="/web/shop2/Public/js/device.min.js"></script>
    <script src="/web/shop2/Public/js/check_device.js"></script>

</head>
<script>

    /**
     *
     * 图片预览
     *
    */
     function showImage(obj){
        var preview = document.querySelector('img');
        var file  = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();
        reader.onloadend = function () {

            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
//            preview.src = "";
        }
    }
    $(function (){

        (function (window) {
            $('.upload_btn .fa-plus-square-o').click(function (){
                $('input[type="file"]').click() ;
            })
            $('.goods_name').keyup(function(){
                    check("goods_name");
                }
            );
            $('.shop_price').keyup(function(){
                    check("shop_price");
                }
            );
            $('.old_price').keyup(function(){
                    check("old_price");
                }
            );

            check("goods_name");
            check("shop_price");
            check("old_price");


            /**
             * 检查输入是否正确
             * @param className 需要检查的元素的类名
             */
            function check (className){
                //获取输入内容
                var value = $('.'+className).val() ;
                if(value=='' || value == undefined || value==null){
                    $('.'+className+ '~ p').text('输入内容不能为空') ;
                }else{
                    if(className == 'shop_price'){
                        //验证价格 你们搞定吧
                    }
                    $('.'+className+ '~ p').text('') ;
                }

            }

        })(window) ;


    })
</script>


<body>
<!--导航-->
<div class="container header">
    <div class="row">
        <div class="header-nav">
            <ul class="nav nav-pills  center-block">
                <li ><a href="/web/shop2/index.php/Home/Index/index">首页</a></li>
                <li ><a href="/web/shop2/index.php/Home/Goods/showlist">商品</a></li>
                <li class="active"><a href="/web/shop2/index.php/Admin/Index/my">个人中心</a></li>
                <li><a href="/web/shop2/index.php/Home/Index/contact">联系客服</a></li>
            </ul>
        </div>
    </div>
</div>


<!--插空填补-->
<div style="height:50px;">

</div>
<!--商品信息-->
<div class="container">
    <div class="row">
        <p class="text col-xs-10" style="margin-top: 20px;">请填写您的商品信息</p>

    </div>
    <hr>
    <div class="row upload-goods">
        <form class="form" method="post" action="/web/shop2/index.php/Admin/Goods/upload" enctype="multipart/form-data">
            <lable>商品名称：</lable>
            <div class="form-group .user-input">

                <input name="goods_name" class="col-xs-12 form-control goods_name" type="text" placeholder="商品名称">
                <i class="fa fa-fire" aria-hidden="true"></i>
                <P class="help-block text">名称格式不正确</P>
            </div>
            <lable>商品价格：</lable>
            <div class="form-group .user-input">

                <input name="shop_price" class="col-xs-12 form-control shop_price" type="text" placeholder="商品价格">
                <i class="fa fa-money" aria-hidden="true"></i>
                <P class="help-block text">请输入正确的价格</P>
            </div>
            <lable>原价：</lable>
            <div class="form-group .user-input">

                <input name="old_price" class="col-xs-12 form-control old_price" type="text" placeholder="商品价格">
                <i class="fa fa-money" aria-hidden="true"></i>
                <P class="help-block text">请输入正确的价格</P>
            </div>
            <br>
            <hr>
            <div class="select">
                <div class="col-xs-5">
                    <select class="form-control" name="cat_id">
                        <option value="#">父级分类</option>
                        <?php if(is_array($category)): foreach($category as $key=>$v): ?><option value="<?php echo ($v["cat_id"]); ?>"><?php echo ($v["cat_name"]); ?></option><?php endforeach; endif; ?>



                    </select>
                </div>


                <!--<div class="col-xs-5">-->
                    <!--<select class="form-control">-->
                        <!--<option value="#">二级分类</option>-->
                        <!--<option value="#">可以不选</option>-->



                    <!--</select>-->
                <!--</div>-->
            </div>
            <div style="clear: both;"></div>
            <div class="row">

                <div class="upload_btn col-xs-5">
                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                    <p class="tip">点击上传商品图片</p>
                </div>

                <input type="file" name="pic" style="display: none;" onchange="showImage(this)">
                <!--商品图片-->

                <div class="pic_wrap col-xs-5 " >
                    <img src="holder.js/213x131" class="center-block preview_img" width="213" height="131">
                </div>
            </div>
            <lable>商品描述：</lable>
            <div class="describe">
                <textarea class="form-control" name="goods_desc" id="" cols="10" rows="10" placeholder="请输入...">

                </textarea>

            </div>

            <div class="col-xs-8" style="margin-bottom: 20px">
                <input type="submit" value="发布" class="btn btn-primary btn-lg " />
                <input type="button" value="取消" class="btn btn-danger btn-lg " />
            </div>
        </form>




        <!--<div class="row" >-->
            <!--<div class="goods_pic_box col-xs-5 pull-left">-->
                <!--<i class="fa fa-plus-square-o" aria-hidden="true"></i>-->
                <!--<p class="tip">点击上传商品图片</p>-->
                <!--<div style="clear: both;"></div>-->
            <!--</div>-->

            <!--<div class="goods_pic_selected col-xs-6 " >-->
                <!--<img src="holder.js/100x100" class="center-block">-->
            <!--</div>-->
        <!--</div>-->

    </div>



</div>




<!--页脚-->
<footer>
    <div class="container">
        <div class='row'>
            <div>
					<span class="text text-center">Copyright ©2017 sweetencounter.cn 版权所有
                        <br>
                        <a href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action" class="text" target="_blank">粤ICP备17043092号</a>
                    </span>
            </div>
        </div>
    </div>
</footer>

<!--背景动画-->
<!--<script src="//cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>-->
</body>
</html>