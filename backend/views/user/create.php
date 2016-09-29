<div class="pageContent">
	<form method="post" action="index.php?r=user/create" class="pageForm required-validate"
	 onsubmit="return validateCallback(this, dialogAjaxDone);">
		
		<div class="pageFormContent" layoutH="56">
			<p class="col-md-2 col-sm-6">
				<label>用户名：</label>
				<input type="text" size="30" class="required" name="User[username]" />
			</p>
			
			<p>
				<label>邮箱：</label>
				<input type="text" size="30" class="required email" name="User[email]" />
			</p>
			
			<p>
				<label>密码：</label>
				<input type="password" class="required" size="30" name="User[password]" />
			</p>
			<p>
				<label>状态：</label>
				<input checked type="radio" name="User[status]" value="10">正常
				<input type="radio" name="User[status]" value="0">禁用
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
