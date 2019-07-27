
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
<script type="text/javascript" src="/static/Admin/jquery-1.8.3.min.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>商品列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品列表   <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">

		<!-- <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120<form action="admincates" method="get">
			<input type="text" name="keyword" id="" value="{{$request['keyword'] or ''}}" placeholder="分类名称" style="width:250px" class="input-text">
		
			<input name="" id="" class="btn btn-success" value="搜索" type="submit"><i class="Hui-iconfont">&#xe665;</i> 
		</form>px;"> -->

	</div>
	
	<div id="uid">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
					<th width="80">ID</th>
					<th width="80">商品名称</th>
				<!-- 	<th width="80">分类</th> -->
					<th width="120">分类</th>
					<th width="80">主图</th>
					<th width="120">描述</th>
					<th width="80">数量</th>
					<th width="70">单价</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
			@foreach($shop as $row)
				<tr class="text-c">
					<!-- <td><input type="checkbox" value="" name=""></td> -->
					<td class="sid">{{$row->sid}}</td>
					<td>{{$row->sname}}</td>
					<td>{{$row->cname}}</td>
					<td><img src="{{$row->pic}}" alt="" style="width:300px"></td>
					<td>{!!$row->descr!!}</td>
					<td>{{$row->num}}</td>
					<td>￥{{$row->price}}</td>
					<!-- <td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看">资讯标题</u></td>
					<td>行业动态</td>
					<td>H-ui</td>
					<td>2014-6-11 11:11:42</td>
					<td>21212</td>
					<td class="td-status"><span class="label label-success radius">已发布</span></td> -->
					<td class="f-14 td-manage">
					<a style="text-decoration:none" class="ml-5" onClick="article_edit('修改管理员','article-add.html','10001')" href="/adminshop/{{$row->sid}}/edit" title="修改管理员">
					<i class="Hui-iconfont">&#xe6df;</i></a> 

					<a style="text-decoration:none" class="ml-5 shop_del"  onClick="article_del('删除','10001')" href="javascript:void(0)" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>

	

	</div>
</div>


</body>
<script type="text/javascript">

$('.shop_del').click(function(){
	aa=$(this);
	sid=$(this).parents('tr').find('.sid').html();
	// alert(sid);
	//ajax
	msg="你确定要删除吗?\n 请选择";
	if(confirm(msg)==true){
		// alert(1);
		//ajax
		$.get('/shop_del',{sid:sid},function(data){
			// alert(data);
			if(data==1){
				aa.parents('tr').remove();
			}
		});
	}

});

</script>
</html>