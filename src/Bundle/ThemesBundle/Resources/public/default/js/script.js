jQuery(document).ready(function(){
/**************swipe menu***************/
jQuery('#page').click(function(){
	if(jQuery(this).parents('body').hasClass('ind')){
		jQuery(this).parents('body').removeClass('ind');
		return false
	}
	})
	jQuery('.swipe-control').click(function(){
		if(jQuery(this).parents('body').hasClass('ind')){
		jQuery(this).parents('body').removeClass('ind');
		return false
	}
	else{
		jQuery(this).parents('body').addClass('ind');
		return false
	}
});
 

/****************BACK TO TOP*********************/
var IE='\v'=='v';
	// hide #back-top first
	jQuery("#back-top").hide();
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (!IE) {
				if (jQuery(this).scrollTop() > 100) {
					jQuery('#back-top').fadeIn();
				} else {
					jQuery('#back-top').fadeOut();
				}
			}
			else {
				if (jQuery(this).scrollTop() > 100) {
					jQuery('#back-top').show();
				} else {
					jQuery('#back-top').hide();
				}	
			}
		});

		// scroll body to 0px on click
		jQuery('#back-top a').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
/********************************************************************************************/	
$(function(){
	$('.breadcrumb li').last().addClass('last');
	$('#cart .total tbody tr').last().addClass('last');	
})

$(document).ready(function(){
		$(".breadcrumb li").last().on("click",function(e){
			e.preventDefault();
		})
	});		
/***********************shadow height***********************************************************/
var sect = 1;
$(document).ready(function() {
	$('.swipe').height($(window).height()-50);

	$(window).resize(function() {
		$('.swipe').height($(window).height()-50);
	});

	var sects = $('.swipe').size();

});
/**************lazy load***************/
jQuery("img.lazy").unveil(1, function(){
	jQuery(this).load(function() {
		jQuery(this).animate({'opacity':1}, 700);
	});
});

/************product gallery on product page***********/
$("#gallery_zoom").elevateZoom({gallery:'image-additional', cursor: 'pointer',zoomType : 'inner', galleryActiveClass: 'active', imageCrossfade: true}); 
//pass the images to Fancybox
$("#gallery_zoom").bind("click", function(e) {  
  var ez =   $('#gallery_zoom').data('elevateZoom');	
	$.fancybox(ez.getGalleryList());
  return false;
});
$('#image-additional').bxSlider({
	mode:'vertical',
	pager:false,
	controls:true,
	slideMargin:13,
	minSlides: 5,
	maxSlides: 5,
	slideWidth: 99,
	nextText: '<i class="fa fa-chevron-down"></i>',
	prevText: '<i class="fa fa-chevron-up"></i>',
	infiniteLoop:false,
	adaptiveHeight:true,
	moveSlides:1
});
$('#gallery').bxSlider({
	pager:false,
	controls:true,
	minSlides: 1,
	maxSlides: 1,
	infiniteLoop:false,
	moveSlides:1
});
/******************* category name height**************************/
(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
$(window).load(function(){
	if($("#content .product-grid .name a").length){
	$("#content .product-grid .name a").equalHeights()}
});
/**************related name height ******************/
(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
$(window).load(function(){
	if($(".related-products .name a").length){
	$(".related-products .name a").equalHeights()}
});
/******************************************************/
if ($('body').width() > 767) {
(function($){ 
	  $(document).ready(function(){
		var exampleOptions = {
			delay:       1000,                            
			animation:   {opacity:'show',height:'show'},  
			speed:       'fast',                          
			autoArrows:  true
		}		
		var example = $('.menu').superfish(exampleOptions);
	  });

	})(jQuery); 
}
/***********CATEGORY DROP DOWN****************/
jQuery("#menu-icon").on("click", function(){
  jQuery("#menu-gadget .menu").slideToggle();
  jQuery("#menu-gadget").toggleClass("active");
 });
 
	if ($('body').width() > 767) {
		
		jQuery(document).on("click touchstart", function(){
		  jQuery("#menu-gadget .menu").slideUp();
		  jQuery("#menu-gadget").removeClass("active");
		 });
		
		jQuery('#menu-gadget .menu').on("click touchstart", function(event){
			event.stopPropagation();
		})
		jQuery('#menu-gadget').on("click touchstart", function(event){
			event.stopPropagation();
		})
		jQuery('#menu-icon').on("click touchstart", function(event){
			event.stopPropagation();
		})
	
	}

  if ($('body').width() < 768) {
  jQuery('#menu-gadget .menu').find('li>ul').before('<i class="fa fa-angle-down"></i>');
  jQuery('#menu-gadget .menu li i').on("click", function(){
   if (jQuery(this).hasClass('fa-angle-up')) { jQuery(this).removeClass('fa-angle-up').addClass('fa-angle-down').parent('li').find('> ul').slideToggle(); } 
	else {
	 jQuery(this).removeClass('fa-angle-down').addClass('fa-angle-up').parent('li').find('> ul').slideToggle();
	}
  }); 
  };

/***********column dropdown box*******************/
  if ($('body').width() < 768) {
		leftColumn = $('body').find('#column-left');
		leftColumn.remove().insertAfter('#content');
	  jQuery("img.lazy").unveil(1, function(){
			jQuery(this).load(function() {
				jQuery(this).animate({'opacity':1}, 700);
			});
		});
		jQuery('.col-sm-3 .box-heading h3').append('<i class="fa fa-plus-circle"></i>');
		jQuery('.col-sm-3 .box-heading').on("click", function(){
		if (jQuery(this).find('i').hasClass('fa-minus-circle')) { jQuery(this).find('i').removeClass('fa-minus-circle').parents('.col-sm-3 .box').find('.box-content').slideToggle(); }
		else {
			jQuery(this).find('i').addClass('fa-minus-circle').parents('.col-sm-3 .box').find('.box-content').slideToggle();
		}
		})
	};
/************************* RELATED PRODUCTS************************************/
$(".related-slider").owlCarousel({
// Most important owl features
	items : 4,
	itemsCustom : false,
	itemsDesktop : [1199,4],
	itemsDesktopSmall : [991,3],
	itemsTablet: [767,2],
	itemsTabletSmall: false,
	itemsMobile : [640,1],
	singleItem : false,
	itemsScaleUp : false,
 
	//Basic Speeds
	slideSpeed : 200,
	paginationSpeed : 800,
	rewindSpeed : 1000,
 
	//Autoplay
	autoPlay : false,
	stopOnHover : false,
 
	// Navigation
	navigation : true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	rewindNav : true,
	scrollPerPage : false,
 
	//Pagination
	pagination : false,
	paginationNumbers: false,
 
	// Responsive 
	responsive: true,
	responsiveRefreshRate : 200,
	responsiveBaseWidth: window,
 
	// CSS Styles
	baseClass : "owl-carousel",
	theme : "owl-theme",
 
	//Lazy load
	lazyLoad : false,
	lazyFollow : true,
	lazyEffect : "fade",
 
	//Auto height
	autoHeight : false,
 
	//JSON 
	jsonPath : false, 
	jsonSuccess : false,
 
	//Mouse Events
	dragBeforeAnimFinish : true,
	mouseDrag : true,
	touchDrag : true,
 
	//Transitions
	transitionStyle : false,
 
	// Other
	addClassActive : false,


	});
/************************ brand ********************************/
var element1=document.getElementById('owl-example2');
if(element1){
		$("#owl-example2").owlCarousel({
			items : 6,
			itemsCustom : false,
			itemsDesktop : [1199,5],
			itemsDesktopSmall : [991,3],
			itemsTablet: [767,3],
			itemsTabletSmall: [600,2],
			itemsMobile : [480,1],
			singleItem : false,
			itemsScaleUp : false,
		 
			//Basic Speeds
			slideSpeed : 200,
			paginationSpeed : 800,
			rewindSpeed : 1000,
		 
			//Autoplay
			autoPlay : false,
			stopOnHover : false,
		 
			// Navigation
			navigation : true,
			navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
			rewindNav : true,
			scrollPerPage : false,
		 
			//Pagination
			pagination : false,
			paginationNumbers: false,
		 
			// Responsive 
			responsive: true,
			responsiveRefreshRate : 200,
			responsiveBaseWidth: window,
		 
			// CSS Styles
			baseClass : "owl-carousel",
			theme : "owl-theme",
		 
			//Lazy load
			lazyLoad : false,
			lazyFollow : true,
			lazyEffect : "fade",
		 
			//Auto height
			autoHeight : false,
		 
			//JSON 
			jsonPath : false, 
			jsonSuccess : false,
		 
			//Mouse Events
			dragBeforeAnimFinish : true,
			mouseDrag : true,
			touchDrag : true,
		 
			//Transitions
			transitionStyle : false,
		 
			// Other
			addClassActive : false
				});
}


/*********product tabs**********/
if ($('body').width() < 768) {
	jQuery('.tab-heading').append('<i class="fa fa-plus-circle"></i>');
	jQuery('.tab-heading').on("click", function(){
	if (jQuery(this).find('i').hasClass('fa-minus-circle')) { jQuery(this).find('i').removeClass('fa-minus-circle').parents('.tabs').find('.tab-content').slideToggle(); }
		else {
		jQuery(this).find('i').addClass('fa-minus-circle').parents('.tabs').find('.tab-content').slideToggle();
	}
	})
	};
});

$(document).ready(function(){
	if ($('body').width() > 767) {
		$(".top-info").appendTo(".top-panel");
	}
})

var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);

/***********************************/
if(!isMobile) {

 // $(".box_html.video_block").vide("image/catalog/video/video_1");

$(document).ready(function(){
	var stickMenu = false;
	var docWidth= $('body').find('.container').width();
	
	if(!isMobile) {	
	
	controller = new ScrollMagic();
	
	fadein_left = jQuery('.parallax .col-sm-6:nth-child(1) > div:nth-child(1)');
	fadein_left1 = jQuery('.parallax .col-sm-6:nth-child(1) > div:nth-child(2)');
	fadein_right = jQuery('.parallax .col-sm-6:nth-child(2) > div:nth-child(1)');
	fadein_right1 = jQuery('.parallax .col-sm-6:nth-child(2) > div:nth-child(2)');
	
	left_animate = TweenMax.from(fadein_left, 0.5, {left:"-200px", alpha: 0, ease:Power1.easeOut});
	left_animate1 = TweenMax.from(fadein_left1, 0.5, {left:"-200px", alpha: 0, ease:Power1.easeOut});
	right_animate = TweenMax.from(fadein_right, 0.5, {right:"-200px", alpha: 0, ease:Power1.easeOut});
	right_animate1 = TweenMax.from(fadein_right1, 0.5, {right:"-200px", alpha: 0, ease:Power1.easeOut});

	if(jQuery(".parallax .col-sm-6:nth-child(1)").length){ 
	var scene_1 = new ScrollScene({
		triggerElement: ".parallax .col-sm-6:nth-child(1)",
		offset: -300
		}).setTween(left_animate)
		  .addTo(controller)
		  .reverse(false);
	var scene_2 = new ScrollScene({
		triggerElement: ".parallax .col-sm-6:nth-child(1)",
		offset: -200
		}).setTween(left_animate1)
		  .addTo(controller)
		  .reverse(false);	  
	  };
	if(jQuery(".parallax .col-sm-6:nth-child(2)").length){ 
	var scene_3 = new ScrollScene({
		triggerElement: ".parallax .col-sm-6:nth-child(2)",
		offset: -300
		}).setTween(right_animate)
		  .addTo(controller)
		  .reverse(false);
	var scene_4 = new ScrollScene({
		triggerElement: ".parallax .col-sm-6:nth-child(2)",
		offset: -200
		}).setTween(right_animate1)
		  .addTo(controller)
		  .reverse(false);
	  };
	  
	  
	  function listBlocksAnimate(block,element,row,offset,difEffect){
		if(jQuery(block).length){
			  var i = 1;
			  var j = row;
			  var k = 1;
			  var effect = -1;
			  $(element).each(function() {
				  i++;				  
				  if(i>j){
					j += row;
					k = i;
					effect = effect*(-1);
				  }				  
				  if(effect == -1 && difEffect == true) {
					ef = TweenMax.from(element+':nth-child('+i+')', .5, {scale:.1*i+.5, opacity:0, alpha: 0, ease:Power1.easeOut})
				  }	else{
					  ef = TweenMax.from(element+':nth-child('+i+')', .5, {scale:1-.2*i, opacity:0, alpha: 0, ease:Power1.easeOut})					  
				  }			  
				  var scene_new = new ScrollScene({
					triggerElement: element+':nth-child('+k+')',
					offset: offset,
					}).setTween(ef)
					  .addTo(controller)
					  .reverse(false);
			});
		  }
	}
	
	$(window).load(function(){
		 listBlocksAnimate('.box.featured', '.box.featured .product-layout > div', 4, -200, false);
	});
	  
	}	
})

}
