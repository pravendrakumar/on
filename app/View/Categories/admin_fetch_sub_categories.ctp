<?php 
$class = 'tbox245 input-01';
$listing = $this->Sport->fetchCatLisitings($parent_category_id);
if(!empty($listing)){
	$class = 'tbox245 input-01 validate[required]';
} //echo $sub_category_id;die;

echo $this->Form->input('Product.category_id', array('label'=>false, 'div'=>false, 'type'=>'select', 'class'=>$class, 'style'=>'width:255px; padding:5px;', 'options'=>$listing, 'empty'=>'Select', 'selected'=>$sub_category_id));
?>