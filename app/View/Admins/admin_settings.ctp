<div class="right_content">
	<!-- PAGE HEADING START -->
	<?php echo $this->Sport->page_heading('Settings Management');?>
	<!-- PAGE HEADING END -->
   
    <div class="content_bg">
      <div class="content"> <?php echo $this->Session->flash();?>
        
		<?php if(!empty($viewListing)){ //pr($viewListing);die;?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <th width="30%"><?php echo $this->Paginator->sort('Setting.key', 'Setting');?></th>
			  <th width="20%"><?php echo $this->Paginator->sort('Setting.value', 'Value');?></th>
			   <th width="20%" style="text-align:center"><?php echo $this->Paginator->sort('Setting.status', 'Status');?></th>
			   <th width="20%"><?php echo $this->Paginator->sort('Setting.modified', 'Last Modified');?></th>
			  <th width="10%">Options </th>
            </tr>

			<?php
				foreach($viewListing as $listing){ //pr($listing);die;
			?>
			<tr>
				<td><?php echo $listing['Setting']['setting_label'];?></td>
				<td><?php echo $listing['Setting']['setting_icon'].$listing['Setting']['setting_val'];?></td>
				<td align="center"><?php
					if($listing['Setting']['status'] == '1'){
						$title = 'Deactivate';
						$image = 'Admin/activate.png';
						$new_status = '0';
						$msg = 'deactivate';
					}else{
						$title = 'Activate';
						$image = 'Admin/deactivate.png';
						$new_status = '1';
						$msg = 'activate';
					}

					echo $this->Html->link($this->Html->image($image, array('alt'=>'')), '/admin/admins/set_settings_status/'.$listing['Setting']['id'].'/'.$new_status.'/', array('escape'=>false, 'title'=>$title), 'Are you sure to '.$msg.' this Setting?');
				?></td>
				<td><?php echo date('d M, Y', strtotime($listing['Setting']['created']));?></td>
				<td><?php
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/edit.png', array('alt'=>'')), '/admin/admins/settings_edit/'.$listing['Setting']['id'].'/', array('escape'=>false, 'title'=>'Update'));
				?></td>
			</tr>
			<?php } ?>
          </tbody>
        </table>
		<?php 
			echo $this->Element('Admin/pagination'); // for pagination
			}else{ // if no data available ?>
		<div class="emptyData">No Setting Data Available!!</div>
		<?php } ?>
      </div>
      <div class="clear "></div>
    </div>
</div>