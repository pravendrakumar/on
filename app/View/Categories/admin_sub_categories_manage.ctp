<?php $catName = $this->Sport->fetchCatNameById($parentId);?>

<div class="right_content">
	<!-- PAGE HEADING START -->
	<?php echo $this->Sport->page_heading('Sub Categories Management');?>
	<!-- PAGE HEADING END -->
   
    <div class="content_bg">
      <div class="content"> <?php echo $this->Session->flash();?>
        <span id="order_res"></span><br/>

	<div style="margin-bottom:20px; font-size:18px;">
		<strong>Category:</strong> <?php echo $catName;?>

		<span style="float:right;">
		<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/add_more.png', array('alt'=>'')), '/admin/categories/add_sub_category/'.$parentId.'/', array('escape'=>false, 'title'=>'Add More Sub-Category'));?>
		</span>
	</div>
		
	<?php if(!empty($viewListing)){ //pr($viewListing);die;?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
		<tr>
			<th width="5%" style="text-align:center">S#</th>
			<th width="35%">Sub-Category Name</th>
			<th width="20%" style="text-align:center">Status</th>
			<th width="20%" style="text-align:center">Created On</th>
			<th width="20%" style="text-align:center">Options</th>
		</tr>

			<?php
				$i = 1;
				foreach($viewListing as $listing){ //pr($listing);die;
			?>
			<tr>
				<td align="center"><?php echo $i;?></td>
				<td><?php echo $listing['Category']['name'];?></td>
				<td align="center"><?php
					if($listing['Category']['status'] == '1'){
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

					echo $this->Html->link($this->Html->image($image, array('alt'=>'')), '/admin/categories/set_sub_status/'.$parentId.'/'.$listing['Category']['id'].'/'.$new_status.'/', array('escape'=>false, 'title'=>$title), 'Are you sure to '.$msg.' this Sub-Category?');
				?></td>
				<td align="center"><?php echo date('d M, Y', strtotime($listing['Category']['created']));?></td>
				<td align="center"><?php
					echo $this->Html->link($this->Html->image('Admin/edit.png', array('alt'=>'')), '/admin/categories/sub_edit/'.$parentId.'/'.$listing['Category']['id'].'/', array('escape'=>false, 'title'=>'Update'));
					echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/delete.png', array('alt'=>'')), '/admin/categories/sub_delete/'.$parentId.'/'.$listing['Category']['id'].'/', array('escape'=>false, 'title'=>'Delete'), 'Do you really want to delete this Sub-Category?');
				?></td>
			</tr>
			<?php $i++;} ?>
          </tbody>
        </table>
		<?php 
			}else{ // if no data available ?>
		<div class="emptyData">No Sub-Category Available!!</div>
		<?php } ?>
      </div>
      <div class="clear "></div>
    </div>
</div>