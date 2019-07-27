<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" //static/Admin/>
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/Admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>添加用户 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="/adminshop" method="post" class="form form-horizontal" id="form-member-add" enctype="multipart/form-data">
		
		@if (count($errors)> 0)
       <div class="mws-form-message error">
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error}}</li>
                  @endforeach
              </ul>
          </div>
       </div>
   		 @endif

		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>商品名：</label>
			<div class="formControls col-xs-8 col-xm-8">
				<input type="text" class="input-text" value="" placeholder="" id="username" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>类别：</label>
			<div class="formControls col-xs-8 col-xm-8">
				<select name="cate_id" class="large" id="">
					<option value="">--请选择--</option>

					@foreach($cate as $value)
					<option value="{{$value->id}}">{{$value->name}}</option>
					@endforeach

				</select>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>描述：</label>
			<div class="formControls col-xs-8 col-xm-8">
				<textarea name="descr" id="" cols="30" rows="10"></textarea>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>图片：</label>
			<div class="formControls col-xs-8 col-xm-8">
				<input type="file" class="input-text" value="" placeholder="" id="" name="pic">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>数量：</label>
			<div class="formControls col-xs-8 col-xm-8">
				<input type="text" class="input-text" value="" placeholder="" id="" name="num">
			</div>
		</div>
	
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>单价：</label>
			<div class="formControls col-xs-8 col-xm-8">
				<input type="text" class="input-text" value="" placeholder="" id="" name="price">
			</div>
		</div>


		{{csrf_field()}}
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;添加&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>


</body>
</html>