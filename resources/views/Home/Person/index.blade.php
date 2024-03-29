@extends("Home.Home_public.public")
@section("main")

<html>
 <head></head>
 <body>
  <div class="user-info"> 
   <!--标题 --> 
   <div class="am-cf am-padding"> 
    <div class="am-fl am-cf">
     <strong class="am-text-danger am-text-lg">个人资料</strong> <!-- / 
     <small>Personal&nbsp;information</small> -->
    </div> 
   </div> 
   <hr /> 
   <!--头像 --> 
   @foreach($user as $row)
   <div class="user-infoPic"> 
    <div class="filePic"> 
     <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" /> 
     <img class="am-circle am-img-thumbnail" src="/static/Home/xiangmv/images/getAvatar.do.jpg" alt="" /> 
    </div> 
    <p class="am-form-help">头像</p> 
    <div class="info-m"> 
     <div>
      <b>用户名：<i>{{$row->username}}</i></b>
     </div> 
     <div class="u-level"> 
      <span class="rank r2"> 
       <s class="vip1"></s><a class="classes" href="#">铜牌会员</a> </span> 
     </div> 
     <div class="u-safety"> 
      <a href="safety.html"> 账户安全 <span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span> </a> 
     </div> 
    </div> 
   </div> 
   <!--个人信息 --> 
   <div class="info-main"> 
    <form class="am-form am-form-horizontal" action="/homeperson" method="post"> 
     <div class="am-form-group"> 
      <label for="user-name2" class="am-form-label">昵称</label> 
      <div class="am-form-content"> 
       <input type="text" id="user-name2" value="{{$row->nickname}}" name="nickname" placeholder="nickname" /> 
      </div> 
     </div> 
     <div class="am-form-group"> 
      <label for="user-name" class="am-form-label">姓名</label> 
      <div class="am-form-content"> 
       <input type="text" id="user-name2" name="username" value="{{$row->username}}" placeholder="name" /> 
      </div> 
     </div> 
     <div class="am-form-group"> 
      <label class="am-form-label">性别</label> 
      <div class="am-form-content sex"> 
       <label class="am-radio-inline"> <input type="radio" name="sex" value="0" data-am-ucheck="" {{$row->sex==0?'checked':''}}/> 女 </label> 
       <label class="am-radio-inline"> <input type="radio" name="sex" value="1" data-am-ucheck="" {{$row->sex==1?'checked':''}}/> 男 </label> 
       <label class="am-radio-inline"> <input type="radio" name="sex" value="2" data-am-ucheck="" {{$row->sex==2?'checked':''}}/> 保密 </label> 	

      </div> 
     </div> 
     <!-- <div class="am-form-group"> 
      <label for="user-birth" class="am-form-label">生日</label> 
      <div class="am-form-content birth"> 
       <div class="birth-select"> 
        <select data-am-selected=""> <option value="a">2015</option> <option value="b">1987</option> </select> 
        <em>年</em> 
       </div> 
       <div class="birth-select2"> 
        <select data-am-selected=""> <option value="a">12</option> <option value="b">8</option> </select> 
        <em>月</em>
       </div> 
       <div class="birth-select2"> 
        <select data-am-selected=""> <option value="a">21</option> <option value="b">23</option> </select> 
        <em>日</em>
       </div> 
      </div> 
     </div>  -->
     <div class="am-form-group"> 
      <label for="user-phone" class="am-form-label">电话</label> 
      <div class="am-form-content"> 
       <input id="user-phone" value="{{$row->phone}}" name="phone" placeholder="telephonenumber" type="tel" /> 
      </div> 
     </div> 
     <div class="am-form-group"> 
      <label for="user-email" class="am-form-label">电子邮件</label> 
      <div class="am-form-content"> 
       <input id="user-email" value="{{$row->email}}" name="email" placeholder="Email" type="email" /> 
      </div> 
     </div> 

     <div class="am-form-group address"> 
      <label for="user-address" class="am-form-label">收货地址</label> 
      <div class="am-form-content address"> 
       <a href="address.html"> <p class="new-mu_l2cw"> <span class="province">湖北</span>省 <span class="city">武汉</span>市 <span class="dist">洪山</span>区 <span class="street">雄楚大道666号(中南财经政法大学)</span> <span class="am-icon-angle-right"></span> </p> </a> 
      </div> 
     </div> 
     <div class="am-form-group safety"> 
      <label for="user-safety" class="am-form-label">账号安全</label> 
      <div class="am-form-content safety"> 
       <a href="safety.html"> <span class="am-icon-angle-right"></span> </a> 
      </div> 
     </div> 
     <input type="hidden" name="id" value="{{$row->id}}">
     {{csrf_field()}}
     <div class="info-btn"> 
      <div >
       <input type="submit" class="am-btn am-btn-danger" value="保存修改">
      </div> 
     </div> 
    </form> 
   </div> 
   @endforeach
  </div> 
 </body>
</html>

@endsection
@section("title","个人信息")