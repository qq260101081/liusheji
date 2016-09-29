<div class="pageContent">
<div class="tabs" style="background: none;">
<form method="post" action="index.php?r=warehouse-sea/create" class="pageForm required-validate" onsubmit="return validateCallback(this);">
<div class="pageFormContent warehouse-tpl" layoutH="55">
	<div class="row">
		<p>
			<label>列表名称：</label>
			<input name="WarehouseSea[name]" type="text" size="30" class="required"/>
		</p>
		<p style="width: 300px;">
			<label style="width: 80px;">发出时间：</label>
			<input name="WarehouseSea[send_date]" type="text" readonly="true" class="date textInput readonly required">	
		</p>
		<p style="width: 300px;">
			<label style="width: 100px;">预计到达时间：</label>
			<input name="WarehouseSea[estimated_date]" type="text" readonly="true" class="date textInput readonly required">	
		</p>
	</div>
	
	<div class="warehouse-tpl-header">
		<div class="warehouse-tpl-row">
			<span>系列</span>
			<span>产品名称</span>
			<span>数量</span>
			<span>箱数</span>
			<span>打码内容</span>
			<span>包装要求</span>
			<span>备注</span>
		</div>
	<?php foreach ($tpl as $v):?>
		<div class="warehouse-tpl-row">
			<input name="WarehouseSeaLog[<?=$v->id;?>][series]" value="<?=$v->series;?>" class="required" type="text" size="30" />
			<input name="WarehouseSeaLog[<?=$v->id;?>][product_name]" value="<?=$v->product_name;?>" class="required" type="text" size="30" />
			<input name="WarehouseSeaLog[<?=$v->id;?>][number]" value="<?php if($v->number) echo $v->number;?>" class="digits required" type="text" size="30" />
			<input name="WarehouseSeaLog[<?=$v->id;?>][box_number]" value="<?php if($v->number) echo $v->box_number;?>" class="digits required" type="text" size="30" />
			<input name="WarehouseSeaLog[<?=$v->id;?>][code_content]" value="<?=$v->code_content;?>" class="required" type="text" size="30" />
			<input name="WarehouseSeaLog[<?=$v->id;?>][requirements]" value="<?=$v->requirements;?>" class="required" type="text" size="33" />
			<input name="WarehouseSeaLog[<?=$v->id;?>][remark]" value="<?=$v->remark;?>" class="required" type="text" size="30" />
		</div>
	<?php endforeach;?>
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