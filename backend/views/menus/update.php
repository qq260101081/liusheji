<div class="pageContent">
	<form method="post" action="index.php?r=menus/update&id=<?= $model->id;?>" class="pageForm required-validate"
	 onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>菜单名称：</label>
				<input type="text" size="30" class="required" name="Menus[name]" value="<?= $model->name; ?>" />
			</p>
			
			<p>
				<label>路由：</label>
				<input type="text" size="30" value="#" class="required" name="Menus[route]" value="<?= $model->route; ?>" />
			</p>
			
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
</div>
