<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/Admin/static/h-ui.admin/css/style.css" />
<script src="/static/Admin/jquery-1.8.3.min.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 公告管理 <span class="c-gray en">&gt;</span> 公告列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:void(0)" class="btn btn-danger del"><i class="Hui-iconfont del">&#xe6e2;</i> 批量删除</a> <a href="/adminarticle/create"  class="btn btn-primary "><i class="Hui-iconfont">&#xe600;</i> 添加公告</a></span> <span class="r">共有数据：<strong></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort" id="tables">
		<thead>
			<tr class="text-c">
				<th width="15"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">标题</th>
				<th width="140">描述</th>
				<th width="90">主图</th>
				<th width="150">作者</th>
				<!-- <th width="">地址</th>
				<th width="130">加入时间</th>
				<th width="70">状态</th> -->
				<th width="100">操作</th>
			</tr>
		</thead>
		@foreach($article as $row)
		<tbody>
			
			<tr class="text-c">
				<td><input type="checkbox" value="{{$row['id']}}" name=""></td>
				<td>{{$row['id']}}</td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','360','400')">{{$row['title']}}</u></td>
				<td>{!!$row['descr']!!}</td>
				<td><img src="{{$row['thumb']}}" alt=""></td>
				<td>{{$row['editor']}}</td>
				<!-- <td class="text-l">北京市 海淀区</td>
				<td>2014-6-11 11:11:42</td>
				<td class="td-status"><span class="label label-success radius">已启用</span></td> -->
				<td class="td-manage"><a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member-add.html','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','change-password.html','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i>
				</a> 
				<!-- 				<a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> -->
			</td>
			</tr>
			@endforeach
			

		</tbody>
			<tr>
					<td colspan="7">
						<a href="javascript:void(0)"><span class="btn btn-default allchoose">全选</span></a>
						<a href="javascript:void(0)"><span class="btn btn-default fchoose">反选</span></a>
						<a href="javascript:void(0)"><span class="btn btn-default nohoose">全不选</span></a>

						<a href="javascript:void(0)"><span class="btn btn-default del">删除</span></a>
					</td>
					
				</tr>
	</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script>
	// alert($);
	//全选
	$(".allchoose").click(function(){
	 $("#tables").find("tr").each(function(){
	 	$(this).find(":checkbox").attr("checked",true);
	 });
	});

	// 反选
	$(".fchoose").click(function(){
	 $("#tables").find("tr").each(function(){
	 	// 判断  如果选中
	 	if($(this).find(":checkbox").attr("checked")){
	 		// 就设置为不选中
	 		$(this).find(":checkbox").attr("checked",false);
	 	}else{
	 		// 否则设置为选中
	 		$(this).find(":checkbox").attr("checked",true);
	 	}
	 });
	});

	//全不选
	$(".nohoose").click(function(){
	 $("#tables").find("tr").each(function(){
	 	$(this).find(":checkbox").attr("checked",false);
	 });
	});


	//删除
	$(".del").click(function(){
		arr=[];
		//变量选中复选框的id
		$(":checkbox").each(function(){
			//判断是否选中
			if($(this).attr("checked")){
				//获取id
				id=$(this).val();
				// alert(id);
				//把每个ID存储在数据arr
				arr.push(id);
			}
		});
		// alert(arr);
		
		//Ajax
		$.get("/del",{arr:arr},function(data){
			// alert(data);
			if(data==1){
				for(i=0;i<arr.length;i++){
					$("input[value='"+arr[i]+"']").parents("tr").remove();
				}
			}else{
				alert(data);
			}
		}); 
	});
</script>
</body>
</html>