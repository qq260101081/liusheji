<?php 
?>
<div class="pageHeader">
	
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="index.php?r=role/create" target="dialog" rel="user_group_create"><span>添加</span></a></li>
			<li><a class="delete" href="index.php?r=role/delete&id={role_ids}" data-method="post" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="index.php?r=role/update&id={role_ids}" target="dialog" rel="user_group_update"><span>修改</span></a></li>
			<li><a class="icon" href="index.php?r=role/permissions&id={role_ids}" target="navTab" rel="permissions_management"><span>权限管理</span></a></li>
			
			<li class="line">line</li>
		</ul>
	</div>
	<table class="list" width="100%" layoutH="138">
		<thead>
			<tr>
				<th>角色</th>
				<th>描述</th>
				<th>创建时间</th>
				<th>更新时间</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($model as $v):?>
			<tr target="role_ids" rel="<?=$v->name;?>">
				<td><?= $v->name; ?></td>
				<td><?= $v->description; ?></td>
				<td><?= date('Y.m.d',$v->createdAt); ?></td>
				<td><?php if($v->updatedAt) echo date('Y.m.d',$v->updatedAt); ?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	
</div>
