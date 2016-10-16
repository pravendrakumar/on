<!-- REQUIRED PAGE SCRIPTS START -->
<?php echo $this->Html->script(array('Front/function', 'Front/jquery.elevatezoom'));?>
<?php echo $this->Html->script(array('Front/function', 'Front/angular.min.js'));?>
<?php echo $this->Html->script(array('Front/function', 'Front/angular-sanitize.js'));?>
<?php echo $this->Html->script(array('Front/function', 'Front/ng-infinite-scroll.min.js'));?>
<script type="text/javascript">
$('.zoom_01').elevateZoom({
	cursor: "crosshair",
	zoomWindowFadeIn: 500,
	zoomWindowPosition: 1,
	zoomWindowFadeOut: 750
});
</script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script src="js/placeholder.js"></script>
<?php echo $this->Html->script(array('Front/html5', 'Front/placeholder'));?>
  <![endif]-->
<!-- script -->
<!-- SCRIPTS END -->
<!-- REQUIRED PAGE SCRIPTS END -->
<div>
<div infinite-scroll='loadMoreProduct()' infinite-scroll-distance='2' class="rightCon">
	<ul id="showDivProd" style="display:none;" class="clearfix">
		<li ng-if="productArr.length>0 && data.image" ng-repeat="data in productArr  | unique: 'name'">
			<div class="prodBox">
				<div class="prodImg"><img ng-src="{{data.image}}" alt=""></div>
				<div class="prodDetail">
					<div class="prodName">{{data.name| limitTo:40}}</div>
					<div class="prodDetails" ng-bind="data.price"></div>
					<div class="QucikView" ng-click="productDetail(data)" id="12">Take a peek</div>
				</div>
			</div>
		</li>
	 <li style="margin-left:200px;width:600px;float:left;" ng-if="productArr.length==0 && searchTerm">
	  
	  <p  style="text-align:justify;font-size:20px;">Your search "<strong ng-bind-html="searchTerm"></strong>" did not match any products.</p>
      <br/>
      <p  style="text-align:justify"> Try something like</p>
      <p  style="text-align:justify"> Using more general terms </p>
      <p  style="text-align:justify"> Checking your spelling </p>
      </li>
      <li style="margin-left:200px;width:600px;float:left;" ng-if="productArr.length==0 && !searchTerm">
	  <p  style="text-align:justify;font-size:20px;">No product found!</p>
      </li>
	</ul>
 <div ng-if="loaderShow" style="float:left;width:250px;margin-left:100px;"><?php echo $this->Html->image('Ajax/ajax-loader.gif', array('alt'=>'loader'));?></div>

</div>

<!-- PRODUCTS DETAILS START -->
<?php 
echo $this->Html->css(array('Front/responsiveslides', 'Front/demo'));?>
<?php echo $this->Html->script('Front/responsiveslides.min');?>

<div class="prodPopOverlay" id="pro_des">
	<div class="prodPopCon">
		<a href="javascript:void(0)" ng-click="changeImg('');" class="close"><?php echo $this->Html->image('Front/close.png', array('alt'=>'X'));?></a>
		<div class="container clearfix">
			<div class="shareBx">Share With: <a href="https://www.facebook.com/login.php" target="_blank"><?php echo $this->Html->image('Front/facebook.png', array('alt'=>'f'));?></a><a href="https://twitter.com/" target="_blank"><?php echo $this->Html->image('Front/twiiter.png', array('alt'=>'t'));?></a><a href="https://in.pinterest.com/login/" target="_blank"><?php echo $this->Html->image('Front/pintrest.png', array('alt'=>'p'));?></a></div>

			<div class="clearfix"></div>
             <!-- PRODUCT GALLERY START -->
             <div class="prodectimage">
				
				<!-- Slideshow 3 -->
				<input type="hidden" name="ASINId" id="ASINId" value="{{pDetails.ASIN}}">
			    <ul class="rslides" id="slider{{pDetails.ASIN}}">
				  <li><img ng-src="{{bigImg?bigImg:pDetails.imgSet[0]}}"></li> </ul>

			    <!-- Slideshow 3 Pager -->
			    <ul  class="rslides_tabs rslides1_tabs" id="slider{{pDetails.ASIN}}-pager">
				  <li style="cursor: pointer; cursor: hand;" ng-click="changeImg(imglist)" ng-repeat="imglist in pDetails.imgSet">
					 <a ng-if="imglist"><img height="50" width="50" ng-src="{{imglist}}"></a></li>
			    </ul>
			</div>
			
			<!-- PRODUCT GALLERY END --
             <!-- PRODUCT GALLERY END -->
			<div class="productdetails">
				<div class="bigProName" style="line-height:27px;">{{pDetails.name}}</div>
				<div class="bigPrice">Price<span>{{pDetails.price}}</span></div>
				<div class="content">
					<p ng-if="pDetails.description.length>100" ng-bind-html="pDetails.description | limitTo:100">...</p>
					<p ng-if="pDetails.description.length<100" ng-bind-html="pDetails.description?pDetails.description:pDetails.name"></p>
					
				</div>
				<div class="brand">Brand<span>{{pDetails.Manufacturer}} </span></div>
				<div class="availablity">Availablity<span>In Stock</span></div>
				<div class="BtnCon">
					<a target="_blank" href="{{pDetails.buy_now_link}}" class="btnBuy">Buy It Now</a> <br/>
					<div style="margin-top:5%;" class="wishlistCont">	
					<?php if($this->Session->read('Auth.User.User.id')){?>
						<span id="wishlistSpan_8">
						<?php
							$itemStat = $this->Sport->checkWishlist(8);
							if($itemStat > 0){
						?>
						<a href="javascript:void(0);" class="addWishList" id="wishlist_8" onclick="return setWishlist('r', 8);"><?php echo $this->Html->image('Front/hear.png', array('alt'=>''));?>Remove From Wishlist</a>
						<?php }else{?>
						<a href="javascript:void(0);" class="addWishList" id="wishlist_8" onclick="return setWishlist('a', 8);"><?php echo $this->Html->image('Front/hear.png', array('alt'=>''));?>Add to Wishlist</a>
						<?php } ?>
						</span>
					<?php }else{ ?>
						<a href="javascript:void(0);" class="addWishList" id="wishlist_8"><?php echo $this->Html->image('Front/hear.png', array('alt'=>''));?>Add to Wishlist</a>
					<?php } ?>
					</div>
					<div style="margin-top:5%;" class="wishlistCont">	
						<a ng-if="pDetails.affilate_type=='sierratradingpost'" href="javascript:void(0);" class="addWishList" id="wishlist_8"><?php echo $this->Html->image('icon-100x27-4.gif', array('alt'=>''));?></a>
						<a ng-if="pDetails.affilate_type=='amazon'" href="javascript:void(0);" class="addWishList" id="wishlist_8"><?php echo $this->Html->image('amazon_fav.png', array('alt'=>''));?></a>
					   <a ng-if="pDetails.affilate_type=='etsy'" href="javascript:void(0);" class="addWishList" id="wishlist_8"><?php echo $this->Html->image('shop-etsy-icon.png', array('alt'=>''));?></a>

					</div>
				</div>
				
				<div class="detailstab">
					<div class="detailstabs">
						<a href="javascript:void(0)" class="actv">Description</a>
						<a href="javascript:void(0)">Reviews
							<?php
								$count = '(0)';
							?>
						</a>
					</div>
					<div class="tabDetails">
						<div class="tab" id="tab1">
							<div class="content">
								<p ng-bind-html="pDetails.description?pDetails.description:pDetails.name"></p>
							</div>
						</div>
						
						<div class="tab" id="tab2" style="display:none">
							<div class="content">
								<div style="text-align:center; color:#FF0000;">No Reviews Available!</div>
							
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
</div>
<!-- PRODUCTS DETAILS END -->

<script type="text/javascript">
loadSlider();
// add to wishlist functionality
function fetchProductId(idS){
	var arr = idS.split('_');
	return arr[1];
}

$('.addWishList').click(function(){
	var productId = fetchProductId($(this).attr('id')); // productId

	// check for session
	var userSession = "<?php echo $this->Session->read('Auth.User.User.id');?>";
	if(userSession != ''){ // user logged in
		
	}else{ // user not logged in
		$('#pro_des').fadeOut(); // close the current 
		$('#loginPop').fadeIn(350);
		$("body").css("overflow","hidden"); // open the login pane
	}
});


function setWishlist(type, pId){
	var types = '';
	var newvalWishlist = '';
	var wishlistCounter = parseInt($('#wishlistCounter').html());
	if(type == 'r'){
		types = 'remove';
		newvalWishlist = (wishlistCounter - 1);
	}else{
		types = 'add';
		newvalWishlist = (wishlistCounter + 1);
	}

	// set the counter in wishlist
	$('#wishlistCounter').html(newvalWishlist);

	$.ajax({
		type: "POST",
		url: "<?php echo SITE_PATH;?>/products/set_wishlist_item/",
		data: "product_id="+pId+"&type="+types,
		beforeSend:function(){
			var bSend = '<img src="<?php echo SITE_PATH;?>img/Ajax/pic-loader.gif"> Please Wait...';
			$('#wishlistSpan_'+pId).html(bSend);
		},
		success: function(response){
			$('#wishlistSpan_'+pId).html(response);
		}
	});
}
</script>
<script>
var app = angular.module('myApp', ['infinite-scroll','ngSanitize']);
app.controller('myCtrl', function($scope,$http,$timeout) {
   $scope.productArr={};
   $scope.searchTerm='';
   var catData='<?php echo json_encode($proCatArr)?>';
   $scope.loaderShow=true;
   <?php if(isset($proCatArr['product']) && $proCatArr['product']!=''){?>
   $scope.searchTerm = '<?php echo $proCatArr['product']?>';
   <?php }?>
   $scope.displayproduct=function(){
       var pageUrl = "<?php echo SITE_PATH;?>pages/getproduct"; 
	    $http.post(pageUrl,{limit:0,catData:catData}).success(function(response) {
		 $scope.productArr=response;
		 $timeout(function () {
           $('#showDivProd').show();
         }, 800);
		 $scope.loaderShow=false;
		}); 
    } 
    
  $scope.changeImg =function(imgName){
	$scope.bigImg =  imgName ; 
   }
    
   $scope.displayproduct(); 
   $scope.pDetails='';
   $scope.productDetail=function(pdata){
	$scope.bigImg ='';   
	$scope.pDetails=pdata;
	$('#pro_des').fadeIn(500);
	$("body").css("overflow","hidden");  
	
  }
  $scope.loadMoreError=true;  
  $scope.currentLimit=1;
 $scope.loadMoreProduct=function(){
	  $scope.loaderShow=true;
		 if($scope.loadMoreError==true){
	      var pageUrl = "<?php echo SITE_PATH;?>pages/getproduct"; 
	       $http.post(pageUrl,{limit:$scope.currentLimit,catData:catData}).success(function(response) {
			if(response.length>0){   
				for(var i=0;i<response.length;i++){
				  if(response[i]!="" && response[i]!=null){
					 if ($scope.productArr.indexOf(response[i]) == -1) {
					    $scope.productArr.push(response[i]);
				   }
				   }
				}
			
		 }else{ 
		   $scope.loadMoreError=false;	
		    }
		 });
	   $scope.currentLimit++;
	}
	$scope.loaderShow=false;	
   }
});
app.filter('unique', function() {
   return function(collection, keyname) {
      var output = [], 
          keys = [];

      angular.forEach(collection, function(item) {
          var key = item[keyname];
          if(keys.indexOf(key) === -1) {
              keys.push(key);
              output.push(item);
          }
      });

      return output;
   };
});
</script>
