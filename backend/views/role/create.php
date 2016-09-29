<div class="pageContent">
	<form method="post" action="index.php?r=role/create" class="pageForm required-validate"
	 onsubmit="return validateCallback(this, dialogAjaxDone);">
		
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>角色：</label>
				<input type="text" size="30" class="required" name="AuthItem[name]" />
			</p>
			
			<p>
				<label>描述：</label>
				<textarea rows="5" cols="28" class="required" name="AuthItem[description]"></textarea>
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
