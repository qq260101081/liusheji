<div class="pageContent">
	<form method="post" action="index.php?r=role/update&id=<?php echo $model->name;?>" class="pageForm required-validate"
	 onsubmit="return iframeCallback(this, dialogAjaxDone);" enctype="multipart/form-data">
		
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>角色：</label>
				<input type="text" size="30" class="required" name="AuthItem[name]" value="<?= $model->name;?>" />
			</p>
			
			<p>
				<label>描述：</label>
				<textarea rows="5" cols="28" class="required" name="AuthItem[description]"><?= $model->description;?></textarea>
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
