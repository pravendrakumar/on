<?php
	$enquiryContactDetailsArr = $this->Sport->fetchEnquiryContactInfo();

	if(!empty($enquiryContactDetailsArr)){ //pr($enquiryContactDetailsArr);
?>
<div class="contct-details">
	<ul>
		<li class="address"><?php echo '<p>'.nl2br($enquiryContactDetailsArr['EnquiryContact']['address']).'</p>';?></li>
		<li class="contact-us">
			<?php
				echo '<p>'.$enquiryContactDetailsArr['EnquiryContact']['phone_1'].'</p>';
				if($enquiryContactDetailsArr['EnquiryContact']['phone_1'] != '')
					echo '<p>'.$enquiryContactDetailsArr['EnquiryContact']['phone_2'].'</p>';
			?>
		</li>
		<li class="messege">
			<p><a title="Mail Us" target="_blank" href="mailto:<?php echo $enquiryContactDetailsArr['EnquiryContact']['email'];?>"><?php echo $enquiryContactDetailsArr['EnquiryContact']['email'];?></a></p>
		</li>
	</ul>

	<!-- SOCIAL MEDIA ICONS START -->
	<?php
		$socialMediaArr = $this->Sport->fetchActiveSocialMedia(); //pr($socialMediaArr);die;
		if(!empty($socialMediaArr)){
	?>
	<div class="social-links">
		<?php foreach($socialMediaArr as $social)
			echo $this->Html->link('', $social['Social']['url'], array('escape'=>false, 'class'=>$social['Social']['css_class'], 'target'=>'_blank'));
		?>

	</div>
	<?php } ?>
	<!-- SOCIAL MEDIA ICONS END -->
</div>
<div class="clear"></div>

<!-- GOOGLE MAP START -->
	<div class="googlemap color_white">
		<p><?php echo $enquiryContactDetailsArr['EnquiryContact']['content']; ?></p>
		<?php if(!empty($enquiryContactDetailsArr['EnquiryContact']['image'])){
					echo $this->Image->resize('Enquiry/'.$enquiryContactDetailsArr['EnquiryContact']['image'],960,420, array("alt" => ""));
				}  ?>
		<?php //echo $enquiryContactDetailsArr['EnquiryContact']['content']; ?>
	</div>
<!-- GOOGLE MAP END -->
<?php } ?>