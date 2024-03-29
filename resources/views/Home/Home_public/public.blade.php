<!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 

  <title>@yield("title")</title> 
  
  

  <link href="/static/Home/xiangmv/basic/css/demo.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/xiangmv/css/cartstyle.css" rel="stylesheet" type="text/css" />
  <link href="/static/Home/xiangmv/css/jsstyle.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/xiangmv/css/addstyle.css" rel="stylesheet" type="text/css">
  <link href="/static/Home/xiangmv/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css"/> 
  <link href="/static/Home/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css"/> 
  <link href="/static/Home/xiangmv/css/personal.css" rel="stylesheet" type="text/css"/> 
  <link href="/Static/Home/xiangmv/css/infstyle.css" rel="stylesheet" type="text/css"/>
  <link href="/static/Home/xiangmv/css/orstyle.css" rel="stylesheet" type="text/css"/> 

  <!-- <link href="/static/Home/xiangmv//AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/xiangmv//basic/css/demo.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/xiangmv//css/cartstyle.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/xiangmv//css/jsstyle.css" rel="stylesheet" type="text/css" />  -->

  <script src="/static/Home/xiangmv/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
  <script src="/static/Home/xiangmv/AmazeUI-2.4.2/assets/js/jquery.min.js"></script> 
  <script src="/static/Home/xiangmv/AmazeUI-2.4.2/assets/js/amazeui.js"></script> 
  <script type="text/javascript" src="/static/Home/xiangmv//js/address.js"></script> 

  
  
 </head> 
 <body> 
  <!--头 --> 
  <header> 
   <article> 
    <div class="mt-logo"> 
     <!--顶部导航条 --> 
     <div class="am-container header"> 
      <ul class="message-l"> 
       <div class="topMessage"> 
        <div class="menu-hd"> 

    	@if(session('accounts'))
        欢迎<a href="#" target="_top" class="h">{{session('accounts')}}</a> 
        <a href="/homelogout" target="_top">退出</a>
        @else 
        <a href="/homelogin/create" target="_top" class="h">亲，请登录</a> 
        <a href="/homeregister/create" target="_top">免费注册</a> 
        @endif

        </div> 
       </div> 
      </ul> 
      <ul class="message-r"> 
       <div class="topMessage home"> 
        <div class="menu-hd">
         <a href="/homeindex" target="_top" class="h">商城首页</a>
        </div> 
       </div> 
       <div class="topMessage my-shangcheng"> 
        <div class="menu-hd MyShangcheng">
         <a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a>
        </div> 
       </div> 
       <div class="topMessage mini-cart"> 
        <div class="menu-hd">
         <a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a>
        </div> 
       </div> 
       <div class="topMessage favorite"> 
        <div class="menu-hd">
         <a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a>
        </div> 
       </div>
      </ul> 
     </div> 
     <!--悬浮搜索框--> 
     <div class="nav white"> 
      <div class="logoBig"> 
       <li><img src="/static/Home/xiangmv/images/logobig.png" /></li> 
      </div> 
      <div class="search-bar pr"> 
       <a name="index_none_header_sysc" href="#"></a> 
       <form> 
        <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off" /> 
        <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit" /> 
       </form> 
      </div> 
     </div> 
     <div class="clear"></div> 
    </div>  
   </article> 
  </header> 
  <div class="nav-table"> 
   <div class="long-title">
    <span class="all-goods">全部分类</span>
   </div> 
   <div class="nav-cont"> 
    <ul> 
     <li class="index"><a href="#">首页</a></li> 
     <li class="qc"><a href="#">闪购</a></li> 
     <li class="qc"><a href="#">限时抢</a></li> 
     <li class="qc"><a href="#">团购</a></li> 
     <li class="qc last"><a href="#">大包装</a></li> 
    </ul> 
    <div class="nav-extra"> 
     <i class="am-icon-user-secret am-icon-md nav-user"></i>
     <b></b>我的福利 
     <i class="am-icon-angle-right" style="padding-left: 10px;"></i> 
    </div> 
   </div> 
  </div> 
  <b class="line"></b> 
  <div class="center"> 
   <div class="col-main"> 
    <div class="main-wrap"> 




  <!--*********************头部结束***********************-->


@section("main")

@show


    </div> 

    <!--底部--> 
    <br><br><br><br><br><br><br><br><br>
  

    <div class="footer"> 
     <div class="footer-hd"> 
      <p> <a href="#">恒望科技</a> <b>|</b> <a href="#">商城首页</a> <b>|</b> <a href="#">支付宝</a> <b>|</b> <a href="#">物流</a> </p> 
     </div> 
     <div class="footer-bd"> 
      <p> <a href="#">关于恒望</a> <a href="#">合作伙伴</a> <a href="#">联系我们</a> <a href="#">网站地图</a> <em>&copy; 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em> </p> 
     </div> 
    </div> 
   </div> 

   <aside class="menu"> 
    <ul> 
     <li class="person active"> <a href="index.html"><i class="am-icon-user"></i>个人中心</a> </li> 
     <li class="person"> <p><i class="am-icon-newspaper-o"></i>个人资料</p> 
      <ul> 
       <li> <a href="/homeperson">个人信息</a></li> 
       <li> <a href="#">安全设置</a></li> 
       <li> <a href="/homeperson/show">地址管理</a></li> 
       <li> <a href="#">快捷支付</a></li> 
      </ul> </li> 
     <li class="person"> <p><i class="am-icon-balance-scale"></i>我的交易</p> 
      <ul> 
       <li><a href="/homeorder">订单管理</a></li> 
       <li> <a href="#">退款售后</a></li> 
       <li> <a href="#">评价商品</a></li> 
      </ul> </li> 
     <li class="person"> <p><i class="am-icon-dollar"></i>我的资产</p> 
      <ul> 
       <li> <a href="#">我的积分</a></li> 
       <li> <a href="#">优惠券 </a></li> 
       <li> <a href="#">红包</a></li> 
       <li> <a href="#">账户余额</a></li> 
       <li> <a href="#">账单明细</a></li> 
      </ul> </li> 
     <li class="person"> <p><i class="am-icon-tags"></i>我的收藏</p> 
      <ul> 
       <li> <a href="#">收藏</a></li> 
       <li> <a href="#">足迹</a></li> 
      </ul> </li> 
     <li class="person"> <p><i class="am-icon-qq"></i>在线客服</p> 
      <ul> 
       <li> <a href="#">商品咨询</a></li> 
       <li> <a href="#">意见反馈</a></li> 
       <li> <a href="#">我的消息</a></li> 
      </ul> </li> 
    </ul> 
   </aside> 
  </div>  
 </body>
</html>
