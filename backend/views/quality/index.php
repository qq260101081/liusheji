<form id="pagerForm" method="post" action="index.php?r=quality/index">
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
				<th>创建于</th>
				<th>供应商</th>
				<th>成品批次号</th>
				<th>产品名称</th>
				<th>实际数量</th>
				<th>分几次品检</th>
				<th>品检人</th>
				<th>批注</th>
				<th>附件</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach ($model as $v):?>
			<tr target="sid_user" rel="<?=$v->order_id;?>">
				<td><?=$i;?></td>
				<td><?= date('Y.m.d',$v->created_at); ?></td>
				<td><?= $v['orders']->supplier; ?></td>
				<td><?= $v['orders']->product_batch_no; ?></td>
				<td><?= $v['orders']->product_name; ?></td>
				<td><?= $v->number; ?></td>
				<td><?= $v->howmany; ?></td>
				<td><?= $v->username; ?></td>
				<td><?= $v->remark; ?></td>
				<td>
					<?php if($v->fiels):;?>
						<a style="color: blue;" href="/upload/<?=$v->fiels; ?>" target="_blank">查看附件</a>
					<?php endif;?>
				</td>
				<td>
					<?php if(!$v->username):?>
					<a class="button" href="index.php?r=quality/update&id=<?=$v->order_id;?>" target="dialog" rel="quality_update"><span>申请入库</span></a>
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
