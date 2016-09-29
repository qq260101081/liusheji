<?php 

	$this->registerCssFile('default/tinyselect.css');
	$this->registerJsFile('default/js/tinyselect.min.js');
?>
<div class="pageContent">
	<form method="post" action="index.php?r=shipment/arrangement-create" class="pageForm required-validate"
	 onsubmit="return validateCallback(this,navTabAjaxDone);">
		
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>日期：</label>
				<input type="text" size="30" value="<?php echo date('Y-m-d');?>" readonly="readonly"/>
			</p>
			<p style="width:450px">
				<label>产品名称：</label>
				<select id="product_id" name="product_name" class="required">
					<option value="">请选择</option>
					<?php foreach ($warehouseModel as $v):?>
					<option rel="<?=$v->number;?>" value="<?=$v->product_name;?>"><?=$v->product_name;?></option>
					<?php endforeach;?>
				</select>
				<span id="warehouse" style="display:none;">库存：<font color="red"></font></span>
			</p>
			
			<p>
				<label>出货数量：</label>
				<input name="number" class="required digits" type="text" size="30"/>
			</p>
			<p>
				<label>配送地址：</label>
				<input name="shipping_address" class="required" type="text" size="30" />
			</p>
			<p>
				<label>运输方式：</label>
				<select name="ship_type" class="combox required">
					<option value="">请选择</option>
					<option value="sea">海运</option>
					<option value="air">空运</option>
					<option value="other">其它</option>
				</select>
			</p>
			<p>
				<label>运单号：</label>
				<input name="freight_no" class="required" type="text" size="30" />
			</p>
			<p>
				<label>发货需求：</label>
				<textarea rows="5" cols="28" name="ask_remark" class="required"></textarea>
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


<?php $this->beginBlock('test') ?>  
    $(function($) {  
		$("#product_id").tinyselect();
		 
		$('#product_id').change(function(){
			if($(this).val())
			{
				$('#warehouse').show();
				$('#warehouse font').text($(this).find('option:selected').attr('rel'));
			}
			else
			{
				$('#warehouse').hide();
			}
		});
    });  
    
    
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?> 
