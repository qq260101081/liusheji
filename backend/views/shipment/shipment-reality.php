<div class="pageContent">
	<form method="post" action="index.php?r=shipment/reality-shipment&id=<?php echo $model->shipment_id;?>" class="pageForm required-validate"
	 onsubmit="return validateCallback(this, dialogAjaxDone);">
		
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>产品：</label>
				<input type="text" size="30" value="<?=$model->product_name;?>" readonly="readonly"/>
			</p>
			<p>
				<label>出货数量：</label>
				<input value="<?=$model->number;?>" class="digits" type="text" size="30" readonly="readonly"/>
			</p>
			<p>
				<label>加工单价：</label>
				<input name="processing_price" value="<?=$model->processing_price;?>" class="required number" type="text" size="30"/>
			</p>
			<p>
				<label>总价：</label>
				<input name="total_price" value="<?=$model->total_price;?>" class="required number" type="text" size="30"/>
			</p>
			<p>
				<label>工厂送货单号：</label>
				<input name="freight_factory_no" type="text" size="30" class="required" value="<?=$model->freight_factory_no;?>" />
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
