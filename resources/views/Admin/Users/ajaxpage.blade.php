<div id="uid">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
					<th width="80">ID</th>
					<th width="80">姓名</th>
				<!-- 	<th width="80">分类</th> -->
					<th width="120">邮箱</th>
					<th width="80">手机号码</th>
					<th width="120">更新时间</th>
					<th width="120">创建时间</th>
					<th width="30">状态</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data as $row)
				<tr class="text-c">
					<!-- <td><input type="checkbox" value="" name=""></td> -->
					<td class="user_id">{{$row->id}}</td>
					<td>{{$row->username}}</td>
					<td>{{$row->email}}</td>
					<td>{{$row->phone}}</td>
					<td>{{$row->updated_at}}</td>
					<td>{{$row->created_at}}</td>
					<td>{{$row->status}}</td>
					<!-- <td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看">资讯标题</u></td>
					<td>行业动态</td>
					<td>H-ui</td>
					<td>2014-6-11 11:11:42</td>
					<td>21212</td>
					<td class="td-status"><span class="label label-success radius">已发布</span></td> -->
					<td class="f-14 td-manage">
					<a style="text-decoration:none" class="ml-5" onClick="article_edit('修改会员','article-add.html','10001')" href="/adminusers/{{$row->id}}/edit" title="修改会员">
					<i class="Hui-iconfont">&#xe6df;</i></a> 

					<a style="text-decoration:none" class="ml-5 users_del" onClick="article_del('删除','10001')" href="javascript:void(0)" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>