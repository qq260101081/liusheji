<form id="pagerForm" method="post" action="index.php?r=warehouse/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="${model.numPerPage}" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>



<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="75">
		<thead>
			<tr>
				<th>编号</th>
				<th>产品名称</th>
				<th>库存</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach ($model as $v):?>
			<tr target="warehouse_id" rel="<?=$v->id;?>">
				<td><?=$i;?></td>
				<td><?= $v->product_name; ?></td>
				<td><?= $v->number; ?></td>
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
