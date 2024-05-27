//function addToWishlist(obj) {
//	var p_id = $(obj).data("pid");
//	$(obj).find("svg").hide();
//	$(obj).find("img").show();
//	$.ajax({
//		url : "AJAX/Add-To-Wishlist.phpp",
//		type : "POST",
//		data : 'p_id=' + p_id,
//		success : function(data) {
//			$(obj).find("svg").show();
//			$(obj).find("img").hide();
//			if (data > 0) {
//				markedAsChecked($(obj));
//				
//			}
//		}
//	});
//}
//
//function removeFromWishlist(obj) {
//	var p_id = $(obj).data("pid");
//	$(obj).find("svg").hide();
//	$(obj).find("img").show();
//	$.ajax({
//		url : "ajax-endpoint/remove-from-wishlist.php",
//		type : "POST",
//		data : 'p_id=' + p_id,
//		success : function(data) {
//			if (data > 0) {
//				$(obj).find("svg").show();
//				$(obj).find("img").hide();
//				markedAsUnchecked($(obj));
//			}
//		}
//	});
//}
//
//function markedAsChecked(obj) {
//	$(obj).find("svg").addClass("color-filled");
//	$(obj).find("svg").parent().attr("onClick", "removeFromWishlist(this)");
//	$(obj).find("svg").parent().attr("title", "Remove from wishlist")
//}
//
//function markedAsUnchecked(obj) {
//	$(obj).find("svg").removeClass("color-filled");
//	$(obj).find("svg").parent().attr("onClick", "addToWishlist(this)");
//	$(obj).find("svg").parent().attr("title", "Add to wishlist")
//}

                $("#whishstate").click(function(){
                 alert("External content loaded successfully!");
                //           $.ajax({
//              type: "POST",
//              url: 'AJAX/Add-To-Wishlist.php',
//              data: ({product_id: link_data}),
//              success: function(data) {
//                   if(data == '1')
//                   {
//                      $('a[data-data="' + link_data + '"] > i.whishstate').css({"color":"red"})
//                   }
//                   else{
//                       $('a[data-data="' + link_data + '"] > i.whishstate').css({"color":"red"})
//                   }
//              }   
//           });
                });
                