<style>
	.asc_option_table{
		width: 100%;
		border-collapse: collapse;
    	
	}
	.asc_option_table tr th {
		text-align: left;font-size: 12px;
		background: #ddd;padding: 6px;
		border:1px solid #ccc;
	}
	.asc_option_table tr td{
		border: 1px solid #ccc;
		padding: 6px;
	}
	/*.asc_option_table tr td.label{
		width: 20%;
	}
	.asc_option_table tr td.values{
		width: 50%;
	}*/
	
</style>
<div class="wrap">
<h2>Plugin Settings Mapping</h2>
<p>Configure the plugins settings mapping</p>

<?php if(empty($this->plugin_json_files)):?>
	<div class="error">
       <p>There are no JSON plugin configuration available.</p>
    </div>

<?php else:?>
	<?php foreach ($this->plugin_json_files as $json): ?>
		<?php $plugin_info = $this->get_plugin_info($json);?>
		<?php if(is_array($plugin_info) && !empty($plugin_info)):?>
			<h3>Name: <?php echo $plugin_info['name'];?></h3>
			<p>Path: <?php echo $plugin_info['path'];?></p>
			<?php if(is_array($plugin_info['options']) && !empty($plugin_info['options'])):?>
				<?php foreach($plugin_info['options'] as $option):?>
					<table class="asc_option_table">
						<tr>
							<th>Option group</th>
							<th>Settings ID</th>
							<th>Values</th>
						</tr>
						<?php if(is_array($option['settings']) && !empty($option['settings'])):?>
							<?php foreach($option['settings'] as $option_setting):?>
								<tr>
									<td><?php echo $option['name']?></td>
									<td><?php echo $option_setting['id'] ?></td>
									<td><?php echo implode("<br/>", $option_setting['values']) ?></td>
								</tr>
							<?php endforeach;?>
						<?php endif;?>
					</table>
				<?php endforeach;?>
			<?php endif;?>
		<?php endif;?>

	<?php endforeach;?>
<?php endif;?>
</div>