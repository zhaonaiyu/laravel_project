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