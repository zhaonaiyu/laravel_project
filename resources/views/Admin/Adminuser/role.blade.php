<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/static/Admin//favicon.ico" >
<link rel="Shortcut Icon" href="/static/Admin//favicon.ico" />
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

<title>新建网站角色 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="/saverole" method="post" class="form form-horizontal" id="form-admin-role-add">
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-1">角色分配：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<dl class="permission-list">
					<dt>
						当前用户:{{$adminuser->name}}
					</dt>


					<dd>
						<dl class="cl permission-list1">
							@foreach($role as $row)
							<dt>
								<label class="">
									<input name="rids[]" type="checkbox" value="{{$row->id}}" @if(in_array($row->id,$rids)) checked @endif name="user-Character-0-0-0" id="user-Character-0-0-0">
									{{$row->name}}</label>
							</dt>
							@endforeach
						</dl>
					</dd>
				</dl>
				
			</div>
		</div>
		<input type="hidden" name="uid" value="{{$adminuser->id}}">
		{{csrf_field()}}
	
			
		<input type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save" value="分配权限"> 
		

	</form>
</article>

<!--_footer 作为公共模版分离出去-->


<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>