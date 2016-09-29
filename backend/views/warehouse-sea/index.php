<form id="pagerForm" method="post" action="index.php?r=warehouse-sea/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="${model.numPerPage}" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>



<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="index.php?r=warehouse-sea/create" target="navTab" rel="warehouse_sea_create" title="海上库存添加"><span>添加</span></a></li>
			<li><a class="delete" href="index.php?r=warehouse-sea/create?id={warehouse_id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="index.php?r=warehouse-sea/delete?id={warehouse_id}" target="navTab"><span>修改</span></a></li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="75">
		<thead>
			<tr>
				<th>编号</th>
				<th>列表名称</th>
				<th>发出时间</th>
				<th>预计到达时间</th>
				<th>创建时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach ($model as $v):?>
			<tr target="warehouse_id" rel="<?=$v->id;?>">
				<td><?=$i;?></td>
				<td><?= $v->name; ?></td>
				<td><?= date('Y.m.d', $v->send_date); ?></td>
				<td><?= date('Y.m.d', $v->estimated_date); ?></td>
				<td><?= date('Y.m.d', $v->created_at); ?></td>
				<td>
					<a style="color:blue;text-align:center; " href="index.php?r=warehouse-sea/view&id=<?=$v->id;?>" target="dialog" rel="warehouse_sea_logs">使用明细</a>
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
