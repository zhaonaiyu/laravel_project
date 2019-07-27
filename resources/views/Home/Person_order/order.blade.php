@extends("Home.Home_public.public")
@section("main")


 <div class="user-order"> 


  <!--标题 --> 
  <div class="am-cf am-padding"> 
   <div class="am-fl am-cf">
    <strong class="am-text-danger am-text-lg">订单管理</strong> 
    <!--/  <small>Order</small> -->
   </div> 
  </div> 
  <hr /> 
  <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs=""> 
   <ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs"> 
    <li class="am-active"><a href="#tab1">所有订单</a></li> 
    <li><a href="#tab2">待付款</a></li> 
    <li><a href="#tab3">待发货</a></li> 
    <li><a href="#tab4">待收货</a></li> 
    <li><a href="#tab5">待评价</a></li> 
   </ul> 
   <div class="am-tabs-bd"> 
    <div class="am-tab-panel am-fade am-in am-active" id="tab1"> 
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
      <div class="order-list"> 
       

       <!--所有订单遍历开始--> 
       @foreach($order as $row)
       <div class="order-status3"> 
        <div class="order-title"> 
         <div class="dd-num">
          订单编号：
          <a class="order_info" href="javascript:void(0)">{{$row->order_num}}</a>
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
           <li class="td td-operation"> 
            <div class="item-operation"> 
             <a href="refund.html">退款/退货</a> 
            </div> </li> 
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
       @endforeach

<!-- 所有订单遍历结束 -->

      </div> 
     </div> 
    </div> 



    <div class="am-tab-panel am-fade" id="tab2"> 
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
      <div class="order-list"> 

      <!-- 未付款订单遍历开始 -->

      @foreach($order as $row)
      @if($row->status=="待付款")
       <div class="order-status1"> 
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
           <li class="td td-operation"> 
            <div class="item-operation"> 
            </div> </li> 
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
           <li class="td td-status"> 
            <div class="item-status"> 
             <p class="Mystatus">{{$row->status}}</p> 
             <p class="order-info"><a href="#">取消订单</a></p> 
            </div> </li> 
           <li class="td td-change"> <a href="pay.html"> 
             <div class="am-btn am-btn-danger anniu">
               一键支付
             </div></a> </li> 
          </div> 
         </div> 
        </div> 
       </div> 
     
      @endif
      @endforeach
<!-- 未付款订单遍历 -->
      </div>
     </div> 
    </div> 


    <!-- 已付款模块 -->
    <div class="am-tab-panel am-fade" id="tab3"> 
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
      <div class="order-list"> 

        <!-- 已付款遍历开始 -->
      @foreach($order as $row)
      @if($row->status=="已付款")
       <div class="order-status2"> 
        <div class="order-title"> 
         <div class="dd-num">
          订单编号：
          <a href="javascript:;">{{$row->order_num}}</a>
         </div> 
         <span>成交时间：{{$row->update_time}}</span> 
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
           <li class="td td-operation"> 
            <div class="item-operation"> 
             <a href="refund.html">退款</a> 
            </div> </li> 
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
           <li class="td td-status"> 
            <div class="item-status"> 
             <p class="Mystatus">买家已付款</p> 
             <p class="order-info"><a href="orderinfo.html">订单详情</a></p> 
            </div> </li> 
           <li class="td td-change"> 
            <div class="am-btn am-btn-danger anniu">
              提醒发货
            </div> </li> 
          </div> 
         </div> 
        </div> 
       </div>
        @endif
      @endforeach
  <!-- 已付款遍历结束 -->


      </div>
     </div> 
    </div> 



    <!-- 已发货模块 -->
    <div class="am-tab-panel am-fade" id="tab4"> 
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
      <div class="order-list"> 

        <!-- 已发货遍历开始 -->
      @foreach($order as $row)
      @if($row->status=="已发货")
       <div class="order-status3"> 
        <div class="order-title"> 
         <div class="dd-num">
          订单编号：
          <a href="javascript:;">1601430</a>
         </div> 
         <span>成交时间：2015-12-20</span> 
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
           <li class="td td-operation"> 
            <div class="item-operation"> 
             <a href="refund.html">退款/退货</a> 
            </div> </li> 
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
          </div> 
         </div> 
        </div> 
       </div> 
       @endif
       @endforeach
     <!-- 已发货遍历结束 -->

      </div> 
     </div> 
    </div> 


    <!-- 待评价订单模块 -->
    <div class="am-tab-panel am-fade" id="tab5"> 
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
      <div class="order-list"> 


       <!--待评价订单遍历订单开始  --> 
      @foreach($order as $row)
      @if($row->status=="待评价")
       <div class="order-status4"> 
        <div class="order-title"> 
         <div class="dd-num">
          订单编号：
          <a href="javascript:;">{{$row->order_num}}</a>
         </div> 
         <span>成交时间：{{$row->create_time}}</span> 
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
           <li class="td td-operation"> 
            <div class="item-operation"> 
             <a href="refund.html">退款/退货</a> 
            </div> </li> 
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
              </div> 
         </div> 
        </div> 
       </div> 
       @endif
       @endforeach
<!-- 待评价订单遍历结束 -->

      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
 </div> 


<script>
    
$('.order_info').click(function(){
  onum=$(this).html();
  // alert(onum);
  $.get('/homeorderinfo',{onum:onum},function(data){
    window.location.href="/orders_info/"+data;
  },'json');
});

</script>

@endsection
@section("title","后台首页")