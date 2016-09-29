<?php 
	function tree2html($tree) {
		foreach($tree as $leaf) {
			echo '<li><a rel="'.$leaf['id'].'" >'.$leaf['name'].'</a>';	
			
			if(isset($leaf['son']))
			{
				echo '<ul>';
				tree2html($leaf['son']);
				echo '</ul>';
			}

			echo '</li>';
		}		
	}
?>

<div class="panelBar">
	<ul class="toolBar">
		<li><a class="add" href="index.php?r=menus/create&root=0" target="dialog" rel="menus_add"><span>添加顶级菜单</span></a></li>
		<li><a class="add subadd" href="#" rel="menus_add"><span>添加子级菜单</span></a></li>
		<li><a class="edit" href="#"><span>修改菜单</span></a></li>
		<li><a class="delete" href="#"><span>删除菜单</span></a></li>
		<li class="line">line</li>
	</ul>
</div>
<div id="resultBox"></div>
	
<div style="margin-left:10%;">
<ul class="tree treeFolder expand selectMenus">
	<?php tree2html($menus);?>
</ul>

</div>
<script>

$('.panelBar .subadd').on('click', function(){
	var id = $('.selectMenus .selected a').attr('rel');
	if(id != undefined)
	{
		var url = 'index.php?r=menus/create&root=' + id;
		$.pdialog.open(url, 'menus_add', '添加子级菜单', {width:'580',height:'300'}); 
	}
	else
	{
		alertMsg.error('请选择信息！');
	}
});

$('.panelBar .edit').on('click', function(){
	var id = $('.selectMenus .selected a').attr('rel');
	if(id != undefined)
	{
		var url = 'index.php?r=menus/update&id=' + id;
		$.pdialog.open(url, 'menus_add', '修改菜单', {width:'580',height:'300'}); 
	}
	else
	{
		alertMsg.error('请选择信息！');
	}
});

$('.panelBar .delete').on('click', function(){
	var id = $('.selectMenus .selected a').attr('rel');
	if(id != undefined)
	{
		var url = 'index.php?r=menus/delete&id=' + id;
		alertMsg.confirm("确定要删除吗?", {
			okCall: function(){
				$.post(url, {id: id}, DWZ.ajaxDone, "json");
				
			}
		});
				
	}
	else
	{
		alertMsg.error('请选择信息！');
	}
});

</script>