<script type="text/javascript">
	$(document).ready(function(){
		$("#AdminAdminSettingsEditForm").validationEngine()
	});
</script>
<div class="right_content">
	<!-- PAGE HEADING START -->
	<?php echo $this->Sport->page_heading('Update Setting Value');?>
	<!-- PAGE HEADING END -->

    <div class="content_bg">
      <div class="content">
       <?php 
			echo $this->Form->create('Admin', array('action'=>'admin_settings_edit/'.$this->data['Setting']['id']));
			echo $this->Form->hidden('Setting.id');
		?>
          <table>
            <tbody>
			<tr>
                <td colspan="2">
					<?php echo $this->Session->flash();?>
				</td>
              </tr>

			  <tr>
                <td class="lbl150">Setting:</td>
				<td>
					<div class="input text required">
						<?php echo $this->data['Setting']['setting_label'];?>
					</div>
				</td>
              </tr>

			  <tr>
                <td class="lbl150">Value:</td>
				<td>
					<div class="input text required">
						<?php echo $this->data['Setting']['setting_icon'].' '.$this->Form->text('Setting.setting_val', array('div'=>false, 'label'=>false, 'class'=>'tbox245 input-01 validate[required]', 'required'=>false)); 
						echo $this->Form->error('Setting.Setting_val');?>
					</div>
				</td>
              </tr>

			   <tr>
                <td class="lbl150">Status:</td>
				<td>
					<div class="input text required">
						<?php echo $this->Form->radio('Setting.status', array('1'=>'Active', '2'=>'Inactive'), array('legend'=>false));?>
					</div>
				</td>
              </tr>
              
                <td>&nbsp;</td>
                <td><input type="submit" value="Submit"></td>
              </tr>
            </tbody>
          </table>
          <div class="clearh"></div>
        <?php echo $this->Form->end();?>
      </div>
      <div class="clear "></div>
    </div>
  </div>