<div class="pageContent">
	<form method="post" action="index.php?r=files/create" class="pageForm required-validate"
	 onsubmit="return iframeCallback(this, dialogAjaxDone);" enctype="multipart/form-data">
		
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>文件分类：</label>
				<select name="Files[category]" class="combox required">
					<option value="">请选择</option>
					<option value="order">下单</option>
					<option value="quality">品质</option>
					<option value="warehouse">仓库</option>
					<option value="shipment">出货</option>
					<option value="finance">财务</option>
					<option value="manager">经理</option>
				</select>
			</p>
			<p>
				<label>文件名：</label>
				<input type="text" size="30" class="required" name="Files[name]" />
			</p>
			<p>
				<label>文件：</label>
				<input type="file" name="files" size="30" class="required" />
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
