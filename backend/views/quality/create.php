<div class="pageContent">
	<form method="post" action="index.php?r=quality/create&id=<?php echo $id;?>" class="pageForm required-validate"
	 onsubmit="return iframeCallback(this, dialogAjaxDone);" enctype="multipart/form-data">
		
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>日期：</label>
				<input type="text" size="30" value="<?php echo date('Y-m-d');?>" readonly="readonly"/>
			</p>
			<p>
				<label>实际数量：</label>
				<input name="number" class="required digits" type="text" size="30"/>
			</p>
			<p>
				<label>分几次品检：</label>
				<select name="howmany" class=" combox required">
					<option value="">请选择</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select>
			</p>
			
			<p>
				<label>附件：</label>
				<input type="file" name="files[]" multiple size="30" />
			</p>
			<p>
				<label>批注：</label>
				<textarea rows="5" cols="28" name="remark"></textarea>
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
