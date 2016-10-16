<!-- PAGINATION SECTION END -->
<div class="paging" style="margin-top:20px;">
	<div class="totalresults">
		<strong><?php echo $this->Paginator->counter(array('format' => __('Showing', true).' %start% - %pages%</strong> (%count%)'));?></strong>
	</div>

	<div class="pagenumber">
		<ul>
			<!-- FOR PREVIOUS/ FIRST BUTTON START -->
			<?php if($this->Paginator->hasPrev()){?>
			<li><?php echo $this->Paginator->first( __('Start', true),null, null, array('class'=>'disabled'));?></li>
			<li><?php echo $this->Paginator->prev( __('Prev', true), null, null, array('class'=>'disabled'));?></li>
			<?php } ?>
			<!-- FOR PREVIOUS/ FIRST BUTTON START -->

			<!-- FOR MIDDLE NUMBERS START -->
			<?php 
				if(is_string($this->Paginator->numbers()))
					echo $this->Paginator->numbers(array('separator'=>'</li><li>', 'before'=>'<li>', 'after'=>'</li>'));
			?>
			<!-- FOR MIDDLE NUMBERS END -->

			<!-- FOR NEXT/ END BUTTON START -->
			<?php if($this->Paginator->hasNext()){?>
			<li><?php echo $this->Paginator->next( __('Next', true), null, null, array('class'=>'disabled'));?></li>
			<li><?php echo $this->Paginator->last( __('End', true), null, null, array('class'=>'disabled'));?></li>
			<?php } ?>
			<!-- FOR NEXT/ END BUTTON END -->
		</ul>
	</div>
</div>
<!-- PAGINATION SECTION START -->