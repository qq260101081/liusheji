<h2 class="contentTitle"><font>用户组：</font><font color="red"><?= $role->description;?></font></h2>

<form method="post" action="index.php?r=role/permissions&id=<?=$role->name;?>" class="pageForm required-validate" onsubmit="return validateCallback(this);">
	
<div class="pageFormContent" layoutH="97">
	<?php foreach ($allPermissions as $k => $v):;?>
	<fieldset>
		<legend><?= $k;?></legend>
		<?php foreach ($v as $vv):;?>
			<label>
			<input type="checkbox" <?php if(isset($groupPermissions[$vv->name])) echo 'checked';?> name="Permissions[<?=$vv->name?>]" value="<?=$vv->name?>" />
				<span style="color:#999;"><?=$vv->description?></span>
			</label>
		<?php endforeach;?>
	</fieldset>
	<?php endforeach;?>
	
</div>

<div class="formBar">
	<ul>
		<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
		<li><div class="buttonActive"><div class="buttonContent"><button type="submit">确定</button></div></div></li>
		<li>
			<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
		</li>
	</ul>
</div>
</form>


