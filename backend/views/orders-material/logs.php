
<div class="pageContent">
	
	<table class="table" width="100%" layoutH="25">
		<thead>
			<tr>
				<th>编号</th>
				<th>使用时间</th>
				<th>产品名称</th>
				<th>订单号</th>
				<th>
					<?php if($type == 'ic'):?>
					IC
					<?php elseif($type == 'lamp'):?>
					灯珠
					<?php endif;?>
				</th>
				<th>
					<?php if($type == 'ic'):?>
					IC批号
					<?php elseif($type == 'lamp'):?>
					灯珠批号
					<?php endif;?>
				</th>
				<th>使用数量</th>
			
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach ($model as $v):?>
			<tr>
				<td><?=$i;?></td>
				<td><?= date('Y.m.d',$v->created_at); ?></td>
				<td><?= $v->product_name; ?></td>
				<td><?= $v->order_no; ?></td>
				<td>
					<?php if($type == 'ic'):?>
						<?=$v->ic;?>
					<?php elseif($type == 'lamp'):?>
						<?=$v->lamp;?>
					<?php endif;?>
				</td>
				<td>
					<?php if($type == 'ic'):?>
						<font color="red"><?=$v->ic_batch_no;?></font>
					<?php elseif($type == 'lamp'):?>
						<font color="red"><?=$v->lamp_batch_no;?></font>
					<?php endif;?>
				</td>
				<td>
					<?php if($type == 'ic'):?>
						<?=$v->ic_number;?>
					<?php elseif($type == 'lamp'):?>
						<?=$v->lamp_number;?>
					<?php endif;?>
				</td>
			</tr>
			<?php $i++; endforeach;?>
		</tbody>
	</table>
</div>
