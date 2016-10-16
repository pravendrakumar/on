<?php
class SportHelper extends AppHelper{
	public $helpers = array('Html', 'Form', 'Session');

	//FUNCTION FOR ENCRYPTION START
	public function encrypt($data){
		$enc_data = base64_encode($data);
		return $enc_data;
	}
	//FUNCTION FOR ENCRYPTION END

	//FUNCTION FOR DECRYPTION START
	public function decrypt($data){
		$enc_data = base64_decode($data);
		return $enc_data;
	}
	//FUNCTION FOR DECRYPTION END
	
	//FUNCTION FOR PARSING THE URL START
	public function parseParameterNew($title){
		$title = strtolower($title);
		$newParameter = str_replace(array('/',' ',',','.',':',"'",'?','!','&','#39;','_'), array('-'), $title);
		return $newParameter;
	}
	//FUNCTION FOR PARSING THE URL END

	//SET VIEW PAGE HEADING START
	public function page_heading($heading){
		$newHeading = '<div class="heading_header">';
		$newHeading .= '	<div class="leftcorner">'.$this->Html->image('Admin/leftcorner.png', array('alt'=>'')).'</div>';
		$newHeading .= '	<div class="rightcorner">'.$this->Html->image('Admin/rightcorner.png', array('alt'=>'')).'</div>';
		$newHeading .= '	<div class="pdleft10 pdtop7 fleft">'.$heading.'</div>';
		$newHeading .= '</div>';
		$newHeading .= '<div class="clear"></div>';
		return $newHeading;
	}
	//SET VIEW PAGE HEADING END

	//SET FRONT VIEW PAGE HEADING START
	public function front_page_heading($heading){
		$newHeading = '<div class="insidetopbgmain">';
		$newHeading .= '	<div class="insidetopbg">'.$heading.'</div>';
		$newHeading .= '</div>';
		$newHeading .= '	<div class="insidetoshadow">'.$this->Html->image('Front/about_us_btm_shadow.jpg', array('alt'=>'')).'</div>';
		return $newHeading;
	}
	//SET FRONT VIEW PAGE HEADING END

	// FUNCTION TO FETCH ALL THE SUBCATEGORIES OF A CATEGORY START
	public function countAllSubCategories($id){
		App::import('Model', 'Category');
		$this->Category = new Category();

		$ret = 0;
		if(!empty($id)){
			$ret = $this->Category->find('count', array('conditions'=>array('Category.parent_id'=>$id)));
		}
		return $ret;
	}
	
	public function allCatSubCategories(){
		App::import('Model', 'Category');
		$this->Category = new Category();

		$ret = 0;
	
		$ret = $this->Category->find('list', array('fields'=>array('Category.id', 'Category.name')));
		return $ret;
	}
	// FUNCTION TO FETCH ALL THE SUBCATEGORIES OF A CATEGORY END

	//FUNCTION TO FETCH THE CATEGORY NAME START
	function fetchCatNameById($id){
		App::import('Model', 'Category');
		$this->Category = new Category();

		$ret = '';
		if(!empty($id)){
			$catArr = $this->Category->find('first', array('fields'=>array('Category.name'), 'conditions'=>array('Category.id'=>$id)));
			$ret = $catArr['Category']['name'];
		}
		return $ret;
	}
	//FUNCTION TO FETCH THE CATEGORY NAME END

	//FETCH CATEGORY MENU FOR LEFT NAVIGATION START
	public function fetchCategories($parentId){
		App::import('Model', 'Category');
		$this->Category = new Category();

		$ret = '';
		if($parentId != ''){
			$catArr = $this->Category->find('all', array('fields'=>array('Category.id', 'Category.parent_id', 'Category.alias_name', 'Category.name'), 'conditions'=>array('Category.parent_id'=>$parentId, 'Category.status'=>'1', 'Category.top'=>'0')));
			if(!empty($catArr))
				$ret = $catArr;
		}
		return $ret;
	}
	//FETCH CATEGORY MENU FOR LEFT NAVIGATION END

	//FUNCTION FOR CHECKING WHETHER ITEM IS FROM WISHLIST OR NOT START
	public function checkWishlist($productId){
		App::import('Model', 'Wishlist');
		$this->Wishlist = new Wishlist();

		$count = $this->Wishlist->find('count', array('conditions'=>array('Wishlist.user_id'=>$this->Session->read('Auth.User.User.id'), 'Wishlist.product_id'=>$productId)));
		return $count;
	}
	//FUNCTION FOR CHECKING WHETHER ITEM IS FROM WISHLIST OR NOT END

	// FETECH WISHKIST COUNTER START
	public function fetchWishlistCounter(){
		App::import('Model', 'Wishlist');
		$this->Wishlist = new Wishlist();

		$ret = 0;

		if($this->Session->read('Auth.User.User.id')){
			$ret = $this->Wishlist->find('count', array('conditions'=>array('Wishlist.user_id'=>$this->Session->read('Auth.User.User.id'))));
		}
		return $ret;
	}
	// FETECH WISHKIST COUNTER END

	// FETCH TOP TAB CTAEGORIES START
	public function fetchtopTabCategories(){
		App::import('Model', 'Category');
		$this->Category = new Category();

		$ret = '';
		$catArr = $this->Category->find('all', array('conditions'=>array('Category.parent_id'=>'0', 'Category.status'=>'1', 'Category.top'=>'1')));
		if(!empty($catArr))
			$ret = $catArr;
		return $ret;
	}
	// FETCH TOP TAB CTAEGORIES END

	// FETCH CATEGORIES LISTING START
	public function fetchCatLisitings($parentId){
		App::import('Model', 'Category');
		$this->Category = new Category();

		$ret = '';
		$catArr = $this->Category->find('list', array('fields'=>array('Category.id', 'Category.name'), 'conditions'=>array('Category.parent_id'=>$parentId, 'Category.status'=>'1', 'Category.top'=>'0')));
		if(!empty($catArr))
			$ret = $catArr;
		return $ret;
	}
	// FETCH CATEGORIES LISTING END

	// FETCH CATEGORY AND SUBCATEGORY START
	public function fetchCatSubCat($id){
		App::import('Model', 'Category');
		$this->Category = new Category();

		$ret['cat_id'] = '';
		$ret['sub_cat_id'] = '';

		$catArr = $this->Category->find('first', array('conditions'=>array('Category.id'=>$id))); //pr($catArr);die;
		if(!empty($catArr)){
			if($catArr['Category']['parent_id'] != '0'){
				$ret['cat_id'] = $catArr['Category']['parent_id'];
				$ret['sub_cat_id'] = $id;
			}else{
				$ret['cat_id'] = $id;
				$ret['sub_cat_id'] = '';
			}
		}
		return $ret;
	}
	// FETCH CATEGORY AND SUBCATEGORY END

	// FETCH PRODUCT GALLERY START
	public function fetchProductGallery($proId){
		App::import('Model', 'Product');
		App::import('Model', 'Gallery');

		$this->Product = new Product();
		$this->Gallery = new Gallery();

		$ret = '';

		// 1. find the product main image
		$this->Product->recursive = -1;
		$proArr = $this->Product->find('first', array('fields'=>array('Product.image'), 'conditions'=>array('Product.id'=>$proId))); //pr($proArr);die;
		if(!empty($proArr)){
			if($proArr['Product']['image'] != ''){
				if(is_file('../webroot/img/Products/'.$proArr['Product']['image']))
					$ret[0] = $proArr['Product']['image'];
			}
		}

		$gallArr = $this->Gallery->find('all', array('fields'=>array('Gallery.image'), 'conditions'=>array('Gallery.product_id'=>$proId))); //pr($gallArr);die;
		if(!empty($gallArr)){
			$i = 1;
			foreach($gallArr as $imageArr){ //pr($imageArr);die;
				if(is_file('../webroot/img/Products/'.$imageArr['Gallery']['image'])){
					$ret[$i] = $imageArr['Gallery']['image'];
					$i++;
				}
			}
		} $ret = array_unique($ret); //pr($ret);die;
		// 2. find the products gallery
		return $ret;
	}
	// FETCH PRODUCT GALLERY END
}
?>
