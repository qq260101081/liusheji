<?php 
	$this->registerCssFile('default/tinyselect.css');
	$this->registerJsFile('default/js/tinyselect.min.js');
?>
<div class="pageContent">
<div class="tabs" style="background: none;">
	<form method="post" action="index.php?r=orders/create" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone);">
		
		
		<div id="jbsxBox" class="unitBox">
			<div class="pageFormContent" layoutH="55">
	<p>
		<label>供应商：</label>
		<select name="supplier" class="combox required">
			<option value="">请选择</option>
			<option value="美耐斯">美耐斯</option>
			<option value="力侬">力侬</option>
			<option value="红富">红富</option>
			<option value="泰然">泰然</option>
			<option value="巴瑞德">巴瑞德</option>
			<option value="天电">天电</option>
			<option value="源磊">源磊</option>
			<option value="晶太">晶太</option>
		</select>
	</p>
	
	<p style="width:450px">
		<label>产品名称：</label>
		<select id="product_id" name="product_name" class="required">
			<option value="">请选择</option>
			<?php foreach ($category as $v):?>
			<option value="<?=$v['product'];?>"><?=$v['product'];?></option>
			<?php endforeach;?>
		</select>
		<span id="warehouse" style="display:none;">库存：<font color="red"></font></span>
	</p>
	<p>
		<label>订单号：</label>
		<input name="order_no" value="G2G<?=date('Ymd');?>" type="text" size="30" />
	</p>
	
	<p>
		<label>产品单价：</label>
		<input name="unit_price" class="number required" type="text" size="30" />
	</p>
	<p>
		<label>甲供灯珠：</label>
		<input type="text" size="30" name="lamp" readonly="true"/>
	</p>
	
	<p>
		<label>加工单价：</label>
		<input name="processing_unit_price" class="number required" type="text" size="30" />
	</p>
	<p>
		<label>灯珠数量：</label>
		<input type="text" size="30" name="lamp_number" class="digits"/>
	</p>
	<p>
		<label>成品批次编码：</label>
		<input class="required" name="product_batch_no" type="text" size="30" />
	</p>
	
	<p>
		<label>IC数量：</label>
		<input type="text" size="30" name="ic_number" class="digits"/>
	</p>	
	<p>
		<label>灯珠批号：</label>
		<input type="text" name="lamp_batch_no" readonly="true"/>
		<a class="btnLook" href="index.php?r=orders/get-material&type=lamp" lookupGroup="Lamp">查找带回</a>
		
	</p>
	<p>
		<label>甲供IC：</label>
		<input type="text" size="30" name="ic" readonly="true" />
	</p>
	<p>
		<label>IC批号：</label>
		<input type="text" name="ic_batch_no" readonly="true"/>
		<a class="btnLook" href="index.php?r=orders/get-material&type=ic" lookupGroup="Ic">查找带回</a>
	</p>
	
	<p>
		<label>产品数量：</label>
		<input name="number" class="digits required" type="text" size="30" />
	</p>
	
	<p>
		<label>备注：</label>
		<textarea rows="5" cols="28" name="remark"></textarea>
	</p>
</div>
			


		</div>

			<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
			</div>
		</form>
	</div>
</div>


<?php $this->beginBlock('test') ?> 
	
	$(function($) {   
		var category = <?= json_encode($category);?>;
		$("#product_id").tinyselect();
		$('#product_id').change(function(){
				
			$('form input[name=ic]').val(category[$(this).val()].ic);
	  		$('form input[name=lamp]').val(category[$(this).val()].lamp);
		});
    });  
    
	$.bringBack = function(data){
		$.pdialog.closeCurrent();
		
  		if(data.ic_batch_no!=undefined) $('form input[name=ic_batch_no]').val(data.ic_batch_no);
  		if(data.lamp_batch_no!=undefined)$('form input[name=lamp_batch_no]').val(data.lamp_batch_no);  		
	}
    
    
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>

