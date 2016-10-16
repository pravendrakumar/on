<div class="right_content">
	<!-- PAGE HEADING START -->
	<?php echo $this->Sport->page_heading('Categories Management');?>
	<!-- PAGE HEADING END -->
   
    <div class="content_bg">
      <div class="content"> <?php echo $this->Session->flash();?>
        <span id="order_res"></span><br/>
		
	<?php if(!empty($viewListing)){ //pr($viewListing);die;?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
		<tr>
			<th width="30%">Category</th>
			<th width="20%" style="text-align:center">Sub-Categories</th>
			<th width="10%" style="text-align:center">Status</th>
			<th width="10%" style="text-align:center">Display On Top</th>
			<th width="15%" style="text-align:center">Created On</th>
			<th width="15%" style="text-align:center">Options</th>
		</tr>

			<?php
				foreach($viewListing as $listing){ //pr($listing);die;
			?>
			<tr>
				<td><?php echo $this->Html->link($listing['Category']['name'], '/admin/categories/sub_categories_manage/'.$listing['Category']['id'].'/', array('escape'=>false));?></td>
				<td align="center"><?php 
					$counter = $this->Sport->countAllSubCategories($listing['Category']['id']);
					if($counter > 0){
						 echo $this->Html->link('<span style="font-size:15px; color:green; font-weight:bold;">'.$counter.'</span>', '/admin/categories/sub_categories_manage/'.$listing['Category']['id'].'/', array('escape'=>false)); 
					}else{
						echo $counter;
					}
				?></td>
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

					echo $this->Html->link($this->Html->image($image, array('alt'=>'')), '/admin/categories/set_status/'.$listing['Category']['id'].'/'.$new_status.'/', array('escape'=>false, 'title'=>$title), 'Are you sure to '.$msg.' this Category?');
				?></td>
				<td align="center"><?php
					if($listing['Category']['top'] == '1'){
						$title = 'Hide';
						$image = 'Admin/activate.png';
						$new_status = '0';
						$msg = 'hide';
					}else{
						$title = 'Show';
						$image = 'Admin/deactivate.png';
						$new_status = '1';
						$msg = 'show';
					}

					echo $this->Html->link($this->Html->image($image, array('alt'=>'')), '/admin/categories/set_top_status/'.$listing['Category']['id'].'/'.$new_status.'/', array('escape'=>false, 'title'=>$title), 'Are you sure to '.$msg.' this Category on top?');
				?></td>
				<td align="center"><?php echo date('d M, Y', strtotime($listing['Category']['created']));?></td>
				<td align="center"><?php
					echo $this->Html->link($this->Html->image('Admin/edit.png', array('alt'=>'')), '/admin/categories/edit/'.$listing['Category']['id'].'/', array('escape'=>false, 'title'=>'Update'));
					echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/delete.png', array('alt'=>'')), '/admin/categories/delete/'.$listing['Category']['id'].'/', array('escape'=>false, 'title'=>'Delete'), 'Do you really want to delete this Category?');
					echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/add_more.png', array('alt'=>'')), '/admin/categories/add_sub_category/'.$listing['Category']['id'].'/', array('escape'=>false, 'title'=>'Add Sub-Category'));
				?></td>
			</tr>
			<?php } ?>
          </tbody>
        </table>
		<?php 
			}else{ // if no data available ?>
		<div class="emptyData">No Category Available!!</div>
		<?php } ?>
      </div>
      <div class="clear "></div>
    </div>
</div>