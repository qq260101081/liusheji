<?php 
?>
<div class="pageHeader">
	
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="index.php?r=user/create" target="dialog" rel="user_group_create"><span>添加</span></a></li>
			<li><a class="delete" href="index.php?r=user/delete&id={user_ids}" data-method="post" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="index.php?r=user/update&id={user_ids}" target="dialog" rel="user_group_update"><span>修改</span></a></li>
			<li class="line">line</li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th>用户名</th>
				<th>邮箱</th>
				<th>状态</th>
				<th>创建时间</th>
				<th>更新时间</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($model as $v):?>
			<tr target="user_ids" rel="<?=$v->id;?>">
				<td><?= $v->username; ?></td>
				<td><?= $v->email; ?></td>
				<td><?php if($v->status == 10) echo '正常';else echo '禁用'; ?></td>
				<td><?= date('Y.m.d',$v->created_at); ?></td>
				<td><?php if($v->updated_at) echo date('Y.m.d',$v->updated_at); ?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	
</div>
