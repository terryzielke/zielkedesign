(function ($) {
	$(function(){
		/* ------------------------------------------------------------------------------
			Delete image.
		------------------------------------------------------------------------------ */
		$(document).on('click','.deleteImage',function(){
			var answer = confirm('Are you sure you want to delete this image?');
			
			if(answer){
				// get current csv value
				var galleryArray	= $('#gallery_array').val();
				
				// get value of selected image to delete
				var badImage		= $(this).parent().find('img').attr('alt');
				//alert(badImage);
				
				// remove selected image from csv array with trailing comma
				var newcsvOrder		= galleryArray.replace(badImage+',', '');
				// remove selected image from csv array with procedding comma
				var newcsvOrder		= newcsvOrder.replace(','+badImage, '');
				// remove any undefined values
				newcsvOrder		= newcsvOrder.replace('undefined,', '');
				newcsvOrder		= newcsvOrder.replace('undefined', '');
				newcsvOrder		= newcsvOrder.replace(',,', ',');
				
				// update csv field
				$('#gallery_array').val(newcsvOrder);
				
				// delete list item from UI
				$(this).closest('li').remove();
			}
			else{
				// alert('you did no delete');
			}
		
		});
		
		/**/
		
		/*
			SORTABLE
			
			First call functions from jQuery UI and then
			create a mouseup event to get the new order of images.
		*/
		$( function() {
			$( "#zpg_ui_list" ).sortable();
			$( "#zpg_ui_list" ).disableSelection();
		} );
		
		$('#zpg_ui_list').mouseup(function(){
			var imageOrder = 'empty';
			setTimeout(function(){
					
				$('#zpg_ui_list li figure img').each(function(){
					var mediaID = $(this).attr('alt');
					if(imageOrder == 'empty'){
						imageOrder = mediaID;
					}
					else{
						imageOrder = imageOrder +','+ mediaID;
					}
				});
				// remove any undefined values
				imageOrder		= imageOrder.replace('undefined,', '');
				imageOrder		= imageOrder.replace('undefined', '');
				imageOrder		= imageOrder.replace(',,', ',');
				
				$('#gallery_array').val(imageOrder);

			}, 200);
			
		});
		
		/*
			CLICK TO COPY
		*/
		$(document).on('click','.zielkedesign_click_to_copy', function(){
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($(this).find('.clipboard').html()).select();
			document.execCommand("copy");
			$temp.remove();
			// Notify user of successful copy
			if($(this).find('i').length){}else{
				$(this).append('<i class="fas fa-clipboard" style="margin-left:5px;"></i>');
			}
		});

	});
})(jQuery);