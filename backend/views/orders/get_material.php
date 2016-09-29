<form id="pagerForm" method="post" action="index.php?r=orders/get-material">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="${model.numPerPage}" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>


<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="index.php?r=orders/get-material" method="post">
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<!-- <td>
					我的客户：<input type="text" name="keyword" />
				</td> -->
				<td>
					<div style="float:left;padding-top:5px;">原料类型：</div>
					<select class="combox" name="type">
						<option value="">全部</option>
						<option value="ic" <?php if(isset($post['type'])&&$post['type'] == 'ic') echo 'selected';?>>IC</option>
						<option value="lamp" <?php if(isset($post['type'])&&$post['type'] == 'lamp') echo 'selected';?>>灯珠</option>
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
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="index.php?r=orders-material/create" target="navTab" title="原料添加"><span>添加</span></a></li>
			<!-- <li><a class="delete" href="demo/common/ajaxDone.html?uid={sid_user}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="demo_page4.html?uid={sid_user}" target="navTab"><span>修改</span></a></li> -->
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th>编号</th>
				<th>原料类型</th>
				<th>创建时间</th>
				<th>供应商</th>
				<th>订单号</th>
				<th>原料名称</th>
				<th>批号</th>
				<th>数量</th>
				<th>单价</th>
				<th>带回</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach ($model as $v):?>
			<tr target="sid_user" rel="<?=$v->id;?>">
				<td><?=$i;?></td>
				<td>
					<?php if($v->type == 'ic'):?>
					IC
					<?php elseif($v->type == 'lamp'):?>
					灯珠
					<?php endif;?>
				</td>
				<td><?= date('Y.m.d',$v->created_at); ?></td>
				<td><?= $v->supplier; ?></td>
				<td><?= $v->order_no; ?></td>
				<td><?= $v->name; ?></td>
				<td><?= $v->batch_no; ?></td>
				<td><?= $v->number; ?></td>
				<td><?= $v->unit_price; ?></td>
				<td>
					<a class="btnSelect" href="javascript:$.bringBack({<?=$v->type;?>_batch_no:'<?=$v->batch_no;?>'})" title="查找带回">选择</a>
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
