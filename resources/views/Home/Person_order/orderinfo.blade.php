@extends("Home.Home_public.public")
@section("main")
<html>
 <head></head>
 <body>
  <div class="user-orderinfo"> 
   <!--标题 --> 
   <div class="am-cf am-padding"> 
    <div class="am-fl am-cf">
     <strong class="am-text-danger am-text-lg">订单详情</strong>
     <!--  / 
     <small>Order&nbsp;details</small> -->
    </div> 
   </div> 
   <hr /> 
   <!--进度条--> 
   @foreach($info as $row)
   <div class="m-progress"> 
    <div class="m-progress-list"> 
     <span class="step-1 step"> <em class="u-progress-stage-bg"></em> <i class="u-stage-icon-inner">1<em class="bg"></em></i> <p class="stage-name">拍下商品</p> </span> 
     <span class="step-2 step"> <em class="u-progress-stage-bg"></em> <i class="u-stage-icon-inner">2<em class="bg"></em></i> <p class="stage-name">卖家发货</p> </span> 
     <span class="step-3 step"> <em class="u-progress-stage-bg"></em> <i class="u-stage-icon-inner">3<em class="bg"></em></i> <p class="stage-name">确认收货</p> </span> 
     <span class="step-4 step"> <em class="u-progress-stage-bg"></em> <i class="u-stage-icon-inner">4<em class="bg"></em></i> <p class="stage-name">交易完成</p> </span> 
     <span class="u-progress-placeholder"></span> 
    </div> 
    <div class="u-progress-bar total-steps-2"> 
     <div class="u-progress-bar-inner"></div> 
    </div> 
   </div> 
   <div class="order-infoaside"> 
    <div class="order-logistics"> 
     <a href="logistics.html"> 
      <div class="icon-log"> 
       <i><img src="../images/receive.png" /></i> 
      </div> </a>
     <div class="latest-logistics">
      <a> <p class="text">已签收,签收人是青年城签收，感谢使用天天快递，期待再次为您服务</p> 
       <div class="time-list"> 
        <span class="date">2015-12-19</span>
        <span class="week">周六</span>
        <span class="time">15:35:42</span> 
       </div> 
       <div class="inquire"> 
        <span class="package-detail">物流：天天快递</span> 
        <span class="package-detail">快递单号: </span> 
        <span class="package-number">373269427868</span> 
        <a href="logistics.html">查看</a> 
       </div></a> 
     </div> 
     <span class="am-icon-angle-right icon"></span>  
     <div class="clear"></div> 
    </div> 
    <div class="order-addresslist"> 
     <div class="order-address"> 
      <div class="icon-add"> 
      </div> 
      <p class="new-tit new-p-re"> <span class="new-txt">{{$ress->name}}</span> <span class="new-txt-rd2">{{$ress->phone}}</span> </p> 
      <div class="new-mu_l2a new-p-re"> 
       <p class="new-mu_l2cw"> <span class="title">收货地址：</span> {{$ress->huo}} <span class="street">{{$ress->xhuo}}</span></p> 
      </div> 
     </div> 
    </div> 
   </div> 
   <div class="order-infomain"> 
    <div class="order-top"> 
     <div class="th th-item"> 商品 
     </div> 
     <div class="th th-price"> 单价 
     </div> 
     <div class="th th-number"> 数量 
     </div> 
     <div class="th th-operation"> 商品操作 
     </div> 
     <div class="th th-amount"> 合计 
     </div> 
     <div class="th th-status"> 交易状态 
     </div> 
     <div class="th th-change"> 交易操作 
     </div> 
    </div> 
    <div class="order-main"> 
     <div class="order-status3"> 
      <div class="order-title"> 
       <div class="dd-num">
        订单编号：
        <a href="javascript:;">{{$row->order_num}}</a>
       </div> 
       <span>成交时间：{{$row->create_time}}</span> 
       <!--    <em>店铺：小桔灯</em>--> 
      </div> 
      
      <div class="order-content"> 
       <div class="order-left"> 
          @foreach($row->goods as $r)
        <ul class="item-list"> 
         <li class="td td-item"> 
          <div class="item-pic"> 
           <a href="#" class="J_MakePoint"> <img src="{{$r->pic}}" class="itempic J_ItemImg" /> </a> 
          </div> 

          <div class="item-info"> 
           <div class="item-basic-info"> 
            <a href="#"> <p>{{$r->name}}</p> <p class="info-little">颜色：12#川南玛瑙 <br />包装：裸装 </p> </a> 
           </div> 
          </div> </li> 
         <li class="td td-price"> 
          <div class="item-price">
            {{$r->price}} 
          </div> </li> 
         <li class="td td-number"> 
          <div class="item-number"> 
           <span>&times;</span>{{$r->num}}
          </div> </li> 
          @if($row->status!="待付款")
         <li class="td td-operation"> 
          <div class="item-operation">
            退款/退货 
          </div> </li> 
          @endif
        </ul> 
      @endforeach
        
       </div> 
       <div class="order-right"> 
        <li class="td td-amount"> 
         <div class="item-amount">
           合计：{{$row->price_tot}}
          <p>含运费：<span>0.00</span></p> 
         </div> </li> 
        <div class="move-right"> 
         
         @if($row->status=="待付款")              
          <!-- 待付款 -->
          <li class="td td-status"> 
          <div class="item-status"> 
           <p class="Mystatus">{{$row->status}}</p> 
           <p class="order-info"><a href="#">取消订单</a></p> 
          </div> </li> 
          <li class="td td-change"> <a href="pay.html"> 
           <div class="am-btn am-btn-danger anniu">
             一键支付
           </div></a> </li> 
          @elseif($row->status=="已付款")
          <!-- 待发货 -->
          <li class="td td-status"> 
          <div class="item-status"> 
           <p class="Mystatus">买家已付款</p> 
           <p class="order-info"><a href="orderinfo.html">订单详情</a></p> 
          </div> </li> 
          <li class="td td-change"> 
          <div class="am-btn am-btn-danger anniu">
            提醒发货
          </div> </li> 
          @elseif($row->status=="已发货")
          <!-- 已发货 -->
          <li class="td td-status"> 
          <div class="item-status"> 
           <p class="Mystatus">卖家已发货</p> 
           <p class="order-info"><a href="orderinfo.html">订单详情</a></p> 
           <p class="order-info"><a href="logistics.html">查看物流</a></p> 
           <p class="order-info"><a href="#">延长收货</a></p> 
          </div> </li> 
          <li class="td td-change"> 
          <div class="am-btn am-btn-danger anniu">
            确认收货
          </div> </li> 
          @else
        <!-- 待评价 -->
        <li class="td td-status"> 
        <div class="item-status"> 
         <p class="Mystatus">{{$row->status}}</p> 
         <p class="order-info"><a href="orderinfo.html">订单详情</a></p> 
         <p class="order-info"><a href="logistics.html">查看物流</a></p> 
        </div> </li> 
        <li class="td td-change"> <a href="commentlist.html"> 
         <div class="am-btn am-btn-danger anniu">
           评价商品
         </div> </a> </li> 
         @endif
			

        </div> 
       </div> 
      </div> 
     </div> 
    </div>
    @endforeach 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","订单详情")