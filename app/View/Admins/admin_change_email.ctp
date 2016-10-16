<script type="text/javascript">
	$(document).ready(function(){
		$("#AdminAdminChangeEmailForm").validationEngine()
	});
</script>

<div class="right_content">
	<!-- PAGE HEADING START -->
	<?php echo $this->Sport->page_heading('Change Email');?>
	<!-- PAGE HEADING END -->

    <div class="content_bg">
      <div class="content">
       <?php 
			echo $this->Form->create('Admin', array('action'=>'admin_change_email'));
			echo $this->Form->hidden('Admin.id');
		?>
          <table>
            <tbody>
			<tr>
                <td colspan="2">
					<?php echo $this->Session->flash();?>
				</td>
              </tr>

              <tr>
                <td class="lbl150">Change Email: *</td>
				<td>
					<div class="input text required">
						<?php echo $this->Form->text('Admin.email', array('div'=>false, 'label'=>false, 'class'=>'tbox245 input-01 validate[required,custom[email]]'));?>
					</div>
				</td>
              </tr>
              
                <td>&nbsp;</td>
                <td><input type="submit" value="Submit" id="submit_form"></td>
              </tr>
            </tbody>
          </table>
          <div class="clearh"></div>
        <?php echo $this->Form->end();?>
      </div>
      <div class="clear "></div>
    </div>
  </div>