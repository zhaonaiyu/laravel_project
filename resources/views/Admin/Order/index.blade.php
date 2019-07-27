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
<script type="text/javascript" src="/static/Admin/jquery-1.8.3.min.js" ></script>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>订单列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 搜索：
		<!-- <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;"> -->
		<input type="text" name="" id="" value="" placeholder=" 请输入订单号" style="width:250px" class="input-text">
		<button name="" id="sousuo" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索订单</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
	 <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> -->
	 <a class="btn btn-primary radius" onclick="picture_add('批量发货','picture-add.html')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 批量发货</a></span> <span class="r">共有数据：<strong>{{$tot}}</strong> 条</span> 
	</div>
	<div id="ppage" class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="40"><input name="" type="checkbox" value=""></th>
					<th width="80">订单号</th>
					<th width="200">订单名称</th>
					<th width="100">订单状态</th>
					<th>订单价格</th>
					<th>地址</th>
					<th width="150">下单时间</th>
					<th width="60">订单状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($order as $row)
				<tr class="text-c">
					<td><input name="" type="checkbox" value="{{$row->id}}"></td>
					<td>{{$row->order_num}}</td>
					<td>
						@foreach($row->goods as $r)
						{{$r->name}}<br>
						@endforeach
						
					</td>

					<td>
					@foreach($row->goods as $r)
						<a href="javascript:;" onClick="picture_edit('图库编辑','picture-show.html','10001')"><img width="150" class="picture-thumb" src="{{$r->pic}}"></a>
					@endforeach
					</td>
					<td class="text-c">￥{{$row->price_tot}}</td>
					<td class="text-c">
						@foreach($row->nress as $resss)
						{{$resss->name}} <br>
						{{$resss->phone}} <br>
						{{$resss->huo}} <br>
						{{$resss->xhuo}} <br>
						@endforeach
					</td>

					<td class="text-c" >{{$row->create_time}}</td>
					<td class="td-status "><span class="label label-success radius">{{$row->status}}</span></td>
					<!-- <td>
						<select name="" id="">
							<option value="1" {{$row->status=="待付款"?"selected":""}}>待付款</option>
							<option value="2" {{$row->status=="已付款"?"selected":""}}>已付款</option>
							<option value="3" {{$row->status=="已发货"?"selected":""}}>已发货</option>
							<option value="4" {{$row->status=="待评价"?"selected":""}}>待评价</option>
						</select>

					</td> -->
					<td class="">
						
						<a style="text-decoration:none" onClick="picture_stop(this,'10001')" class="fahuo"  href="/fahuo/{{$row->id}}" title="发货" ><i class="Hui-iconfont">&#xe603;</i></a>
						
						<!-- <a style="text-decoration:none" class="ml-5" onClick="picture_edit('图库编辑','picture-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>  -->

						<a style="text-decoration:none" class="ml-5 order_del" onClick="picture_del(this,'10001')" href="/adminorder/{{$row->id}}/destroy" title="删除"><input type="hidden"  value="{{$row->id}}"><i class="Hui-iconfont">&#xe6e2;</i></a>

					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>
<div style="text-align:center">
		@foreach($pp as $rows)
		<button class="btn btn-default" onclick="page({{$rows}})">{{$rows}}</button>
		@endforeach
</div>
<br><br><br><br>
</body>
<script>
	// alert($);
	function page(page){
		$.get('/adminorder',{page:page},function(data){
			$('#ppage').html(data);
		});
	}

	$('#sousuo').click(function(){
		info=$(this).prev('input').val();
		// alert(info);
		$.get('/adminorder',{info:info},function(data){
			$('#ppage').html(data);

		});
	});

	// $('.order_del').click(function(){
	// 	id=$(this).find('input').val();
	// 	// alert(id);
	// 	oo=$(this);
	// 	$.get('/adminorder/'+id+'/destroy',{id:id},function(data){
	// 		// alert(data);
	// 		if(data=='1'){
	// 		oo.parents('tr').remove();
	// 		}else{
	// 			alert('删除失败');
	// 		}
	// 	},'json');
	// });
</script>
</html>