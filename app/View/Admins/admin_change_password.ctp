<script type="text/javascript">
	$(document).ready(function(){
		$("#AdminAdminChangePasswordForm").validationEngine()
	});
</script>

<div class="right_content">
	<!-- PAGE HEADING START -->
	<?php echo $this->Sport->page_heading('Change Password');?>
	<!-- PAGE HEADING END -->

    <div class="content_bg">
      <div class="content">
       <?php echo $this->Form->create('Admin', array('action'=>'admin_change_password'));?>
          <table>
            <tbody>
			<tr>
                <td colspan="2">
					<?php echo $this->Session->flash();?>
				</td>
              </tr>

              <tr>
                <td class="lbl150">Current Password: *</td>
				<td>
					<div class="input text required">
						<?php echo $this->Form->password('Admin.current_password', array('div'=>false, 'label'=>false, 'class'=>'tbox245 input-01 validate[required]'));?>
					</div>
				</td>
              </tr>

			  <tr>
                <td class="lbl150">New Password: *</td>
				<td>
					<div class="input text required">
						<?php echo $this->Form->password('Admin.new_password', array('div'=>false, 'label'=>false, 'class'=>'tbox245 input-01 validate[required]'));?>
					</div>
				</td>
              </tr>

			  <tr>
                <td class="lbl150">Confirm Password: *</td>
				<td>
					<div class="input text required">
						<?php echo $this->Form->password('Admin.confirm_password', array('div'=>false, 'label'=>false, 'class'=>'tbox245 input-01 validate[required,equals[AdminNewPassword]]'));?>
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