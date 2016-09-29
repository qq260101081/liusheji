
<form id="pagerForm" action="demo/database/dwzOrgLookup.html">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="${model.numPerPage}" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
	<input type="hidden" name="orderDirection" value="${param.orderDirection}" />
</form>

<div class="pageContent">

	<table class="table" layoutH="118" targetType="dialog" width="100%">
		<thead>
			<tr>
				<th orderfield="series">系列</th>
				<th orderfield="product">产品名称</th>
				<th orderfield="abbreviation">简写</th>
				<th orderfield="lamp">灯珠</th>
				<th orderfield="lamp_number">灯珠数量</th>
				<th orderfield="ic">IC</th>
				<th orderfield="ic_number">IC数量</th>
				<th width="80">查找带回</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($model as $v):?>
			<tr>
				<td><?=$v->series;?></td>
				<td><?=$v->product;?></td>
				<td><?=$v->abbreviation;?></td>
				<td><?=$v->lamp;?></td>
				<td><?php if($v->lamp_number) echo $v->lamp_number;?></td>
				<td><?=$v->ic;?></td>
				<td><?php if($v->ic_number) echo $v->ic_number;?></td>
				<td>
					<a class="btnSelect" href="javascript:$.bringBack({series:'<?=$v->series;?>', product:'<?=$v->product?>', abbreviation:'<?=$v->abbreviation?>',ic:'<?=$v->ic;?>',lamp:'<?=$v->lamp;?>',lamp_number:'<?=$v->lamp_number;?>',ic_number:'<?=$v->ic_number;?>'})" title="查找带回">选择</a>
				</td>
			</tr>
			<?php endforeach;?>
			
		</tbody>
	</table>

	<div class="panelBar">
		<div class="pages">
			<span>每页</span>

			<select name="numPerPage" onchange="dwzPageBreak({targetType:'dialog', numPerPage:'10'})">
				<option value="10" selected="selected">10</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>条，共<?= count($model);?>条</span>
		</div>
		<div class="pagination" targetType="dialog" totalCount="2" numPerPage="10" pageNumShown="1" currentPage="1"></div>
	</div>
</div>