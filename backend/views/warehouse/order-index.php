<form id="pagerForm" method="post" action="index.php?r=warehouse/order-index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="${model.numPerPage}" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="index.php?r=orders/create" target="navTab"><span>添加</span></a></li>
			<li><a class="delete" href="demo/common/ajaxDone.html?uid={sid_user}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="demo_page4.html?uid={sid_user}" target="navTab"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th>编号</th>
				<th>入库时间</th>
				<th>供应商</th>
				<th>产品名称</th>
				<th>成品批次号</th>
				<th>数量</th>
				<th>加工价格</th>
				<th>成品单价</th>
				<th>合计</th>
				<th>入库人</th>
				<th>备注</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach ($model as $v):?>
			<tr target="sid_user" rel="<?=$v->order_id;?>">
				<td><?=$i;?></td>
				<td><?= date('Y.m.d',$v->created_at); ?></td>
				<td><?= $v['orders']->supplier; ?></td>
				<td><?= $v['orders']->product_name; ?></td>
				<td><?= $v['orders']->product_batch_no; ?></td>
				<td><?= $v->number; ?></td>
				<td><?= $v['orders']->processing_unit_price; ?></td>
				<td><?= $v['orders']->unit_price; ?></td>
				<td><?= $v['orders']->total_price; ?></td>
				<td><?= $v->warehouse_username; ?></td>
				<td><?= $v->remark; ?></td>
				<td>
					<?php if(!$v->warehouse_username):?>
					<a class="button" href="index.php?r=warehouse/update-order&id=<?=$v->order_id;?>" target="ajaxTodo" title="确定入库吗？"><span>确认入库</span></a>
					
					<?php else:?>
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
