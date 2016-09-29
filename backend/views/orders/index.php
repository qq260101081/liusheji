<form id="pagerForm" method="post" action="index.php?r=orders/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="${model.numPerPage}" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>


<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="index.php?r=orders/index" method="post">
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<!-- <td>
					我的客户：<input type="text" name="keyword" />
				</td> -->
				<td>
					<div style="float:left;padding-top:5px;">订单状态：</div>
					<select class="combox" name="is_apply">
						<option value="">全部</option>
						<option value="yes" <?php if(isset($post['is_apply'])&&$post['is_apply'] == 'yes') echo 'selected';?>>已完成</option>
						<option value="no" <?php if(isset($post['is_apply'])&&$post['is_apply'] == 'no') echo 'selected';?>>未完成</option>
					</select>
				</td>
				<!-- 
				<td>
					建档日期：<input type="text" class="date" readonly="true" />
				</td> 
				-->
			</tr>
		</table>
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
			</ul>
		</div>
	</div>
	</form>
</div>
<div class="pageContent" style="width:100%;">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="index.php?r=orders/create" target="navTab" rel="orders_create" title="成品下单"><span>添加</span></a></li>
			<!-- <li><a class="delete" href="demo/common/ajaxDone.html?uid={sid_user}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="demo_page4.html?uid={sid_user}" target="navTab"><span>修改</span></a></li> -->
			<li class="line">line</li>
			<li><a class="icon" href="index.php?r=orders/export" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="list" width="100%" layoutH="115">
		<thead>
			<tr>
				<th>编号</th>
				<th >创建时间</th>
				<th>供应商</th>
				<th>订单号</th>
				<th>产品名称</th>
				<th style="background:#ccc;">IC</th>
				<th style="background:#ccc">IC批号</th>
				<th style="background:#ccc">灯珠</th>
				<th style="background:#ccc">灯珠批号</th>
				<th >成品批号</th>
				<th >数量</th>
				<th >加工价</th>
				<th >单价</th>
				<th >总价</th>
				<th >备注</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach ($model as $v):?>
			<tr target="sid_user" rel="<?=$v->id;?>">
				<td><?=$i;?></td>
				<td><?= date('Y.m.d',$v->created_at); ?></td>
				<td><?= $v->supplier; ?></td>
				<td><?= $v->order_no; ?></td>
				<td><?= $v->product_name; ?></td>
				<td><?= $v->ic; ?></td>
				<td><?= $v->ic_batch_no; ?></td>
				<td><?= $v->lamp; ?></td>
				<td><?= $v->lamp_batch_no; ?></td>
				<td><?= $v->product_batch_no; ?></td>
				<td><?= $v->number; ?></td>
				<td><?= $v->processing_unit_price; ?></td>
				<td><?= $v->unit_price; ?></td>
				<td><?= $v->total_price; ?></td>
				<td><?= $v->remark; ?></td>
				<td>
					<?php if($v->is_apply=='no'):?>
					<a class="button" href="index.php?r=orders/apply-storage&id=<?=$v->id;?>" target="ajaxTodo" title="确定申请入库吗？"><span>申请入库</span></a>
					<?php elseif($v->is_apply=='yes'):?>
					<font color="red">已完成</font>
					<?php endif;?>
				</td>
			</tr>
			<?php $i++; endforeach;?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="200">200</option>
			</select>
			<span>条，共<?=$pages['count'];?>条</span>
		</div>

		<div class="pagination" targetType="navTab" totalCount="<?=$pages['count'];?>" numPerPage="<?=$pages['pageSize'];?>" pageNumShown="<?=$pages['pageNum'];?>" currentPage="<?=$pages['page'];?>"></div>

	</div>
</div>
