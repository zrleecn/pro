###一. 测试环境

    PHP5.5.12 
    Apache2.4.9 
    MySQL5.6.17
    
###二. 功能清单

####控制器
#####Admin/Controller


 - CommonController 
  
       _initialize()-------------------- 检查用户是否登录进行跳转登录 
        
- GoodsController 商品控制器

       upload_goods() --------------------- 上传商品
       upload()------------------------- 商品上传处理
       delete_goods() --------------------- 删除商品
       delete_collection() ---------------- 删除收藏的商品
- IndexController 个人中心控制器

      my ()---------------------------- 个人中心默认打开我的商品页面
      collection()--------------------- 个人中心收藏商品页面
 - ManagerController 管理控制器

       manager ()---------------------- 个人中心默认打开我的商品页面
       myinfo()------------------------ 个人中心收藏商品页面
       modify()------------------------ 修改用户信息
       modify_update()----------------- 更新修改的用户信息
       count()------------------------- 计算商品数量以及收藏商品数量
 - UserController 用户控制器
 
        login ()--------------------- 用户登录
        register()------------------- 显示注册页面 
        adduser()-------------------- 注册用户 添加用户到数据库
        active()--------------------- 激活邮箱
        check()---------------------- 检查验证码
        check_uname()---------------- 检查用户名是否正确 (ajax)
        check_pwd ------------------  检查密码是否正确 (ajax)
        logout ---------------------  用户登出      
       count()------------------------- 计算商品数量以及收藏商品数量
     
 #####Home/Controller 
 - ContactController 联系客服
 
        send ()--------------------- 发送邮件
 - GoodsController 商品控制器
   
          showlist ()---------------------- 商品列表
          category()----------------------- 加载分类
          goods()-------------------------- 展示商品
          search()------------------------- 搜索
          order_by_price()----------------- 搜索按照价格排序
          goods_detail -------------------- 展示商品详情
          loadComment --------------------- 加载评论      
         addNewComment()------------------- 新增评论      
 - GoodsController 商品控制器
   
          index ()------------------------- 商品列表
          category()----------------------- 显示分类
          contact()------------------------ 联系客服
          goods_list()--------------------- 商品列表入口
          goods_list_main()---------------- 搜索到的商品列表
          myaccount ----------------------- 登录界面
          verify -------------------------- 输出验证码      
         addNewComment()------------------- 新增评论 
 ###三. 视图
 #####Admin/View
- Goods/
    
        upload_goods.html  -------------------- 商品上传视图
            
- Index/
  
      collection.html  -------------------- 我的收藏视图          
      my.html          -------------------- 我的商品视图          
            
- Manager/
  
      manager.html     -------------------- 个人中心管理入口视图          
      modify.html      -------------------- 修改个人信息视图
      myinfo.html      -------------------- 展示个人信息视图
- User/
  
      register.html     -------------------- 用户注册视图         
#####Home/View 
- Goods/
    
        category.html  ----------------------- 分类视图 
        goods.html     ----------------------- 商品视图 
        goods_detail.html     ---------------- 商品详情视图 
        goods_list.html    ------------------- 商品列表视图 
        goods_list_main.html ----------------- 搜索商品视图 
- Index/
    
        contact.html  ----------------------- 联系客服视图 
        index.html    ----------------------- 首页视图 
        myaccount.html     ------------------ 用户登录视图 
            
      
      
      
      
###四. 目前功能
- 首页 
     
      首页主要加载数据库中火热的商品列表
      轮播图广告
      轮播图下面有快速分类链接可以直接到达某一个分类
      显示商品收藏数量、价格..
      点击某个商品进入商品详情页面
      商品详情中可以尽行商品评论
      根据用户登录情况如果用户登录并对某一个商品收藏则该商品的“心形”应为红色
      否则为灰色 如果没有登录则全部心为灰色只显示收藏数量
      以登录状态如果点击心形为红色的商品(已经收藏)则通过模态框提示取消收藏该商品是否成功
      若为灰色则提示收藏该商品是否成功
      
- 商品列表 
     
      加载数据库分类 展示分类列表
      点击某一个分类右边显示出对应分类的商品列表
      模糊搜索功能 输入关键字可以查到含有关键字的商品 并显示出来
- 个人中心 
      
      没有登录的跳转到登录页面(含有注册超链接)
      登录页面通过ajax异步查询数据库 用户不存在或者用户密码不正确给出相应提示
      同理注册页面类似
      注册通过邮箱激活(当前功能实现为了用户快捷操作暂时不用激活)
      已经登录用户可以查看自己发布的商品以及收藏商品
      商品列表中有个快捷删除(取消收藏)商品图标 点击效果同样使用模态框提示效果和首页点击心形类似
      导航有商品上传链接以及个人管理入口
      个人中心管理界面主要是修改个人信息 查看个人信息 个人收到的消息 
      个人商品 个人商品收藏 帮助中心 联系客服
-  联系客服
     
       将问题通过邮箱的形式发送给客服 回复消息将发回用户的邮箱以及个人中心管理界面的
        “我的消息”
      
      
      
       
            
     
    
     
      
      