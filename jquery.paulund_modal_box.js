(function($){

	// Defining our jQuery plugin

	$.fn.paulund_modal_box = function(prop){

		// Default parameters

		var options = $.extend({
			height : "270",
			width : "500",
			title:"RSS Feed",
			description: "Enter URL:",
            description1:"Feed  URL:",            
                	top: "20%",
			        left: "30%",
		},prop);
				
		return this.click(function(e){
			add_block_page();
			add_popup_box();
			add_styles();
			
			$('.paulund_modal_box').fadeIn();
		});
		
		 function add_styles(){			
			$('.paulund_modal_box').css({ 
				'position':'absolute', 
				'left':options.left,
				'top':options.top,
				'display':'none',
				'height': options.height + 'px',
				'width': options.width + 'px',
				'border':'1px solid #fff',
				'box-shadow': '0px 2px 7px #292929',
				'-moz-box-shadow': '0px 2px 7px #292929',
				'-webkit-box-shadow': '0px 2px 7px #292929',
				'border-radius':'10px',
				'-moz-border-radius':'10px',
				'-webkit-border-radius':'10px',
				'background': '#f2f2f2', 
				'z-index':'50',
			});
			$('.paulund_modal_close').css({
				'position':'relative',
				'top':'-25px',
				'left':'20px',
				'float':'right',
				'display':'block',
				'height':'50px',
				'width':'50px',
				'background': 'url(images/close.png) no-repeat',
			});
					
			
                        /*Block page overlay*/
			var pageHeight = $(document).height();
			var pageWidth = $(window).width();

			$('.paulund_block_page').css({
				'position':'absolute',
				'top':'0',
				'left':'0',
				'background-color':'rgba(0,0,0,0.6)',
				'height':pageHeight,
				'width':pageWidth,
				'z-index':'10'
			});
			$('.paulund_inner_modal_box').css({
				'background-color':'#fff',
				'height':(options.height - 50) + 'px',
				'width':(options.width - 50) + 'px',
				'padding':'10px',
				'margin':'15px',
				'border-radius':'10px',
				'-moz-border-radius':'10px',
				'-webkit-border-radius':'10px'
			});
		}
		
		 function add_block_page(){
			var block_page = $('<div class="paulund_block_page"></div>');
						
			$(block_page).appendTo('body');
		}
		 		
		 function add_popup_box(){
			 var pop_up = $('<div class="paulund_modal_box"><a href="#" class="paulund_modal_close"></a><div class="paulund_inner_modal_box"><h2><center>'
			 + options.title +
			 '</center></h2><p>' + options.description + '<style>input[type="text"]{  border: 1px solid #ccc;  border-radius: 3px;  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);  width:200px;  min-height: 28px;  padding: 4px 20px 4px 8px;  font-size: 12px;  -moz-transition: all .2s linear;  -webkit-transition: all .2s linear;  transition: all .2s linear;}input[type="text"]:focus{  width: 300px;  border-color: #51a7e8;  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1),0 0 5px rgba(81,167,232,0.5);  outline: none;}</style><input type="text" id="txturl" name="url" size="35">'+
			 '<style>button{cursor:pointer;padding:4px 10px;background:#35b128;border:1px solid #33842a;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;/*give the button a drop shadow*/-webkit-box-shadow: 0 0 4px rgba(0,0,0, .75);-moz-box-shadow: 0 0 4px rgba(0,0,0, .75);box-shadow: 0 0 4px rgba(0,0,0, .75);/*style the text*/color:#f3f3f3;font-size:1.1em;}'+
			 'button:focus{background-color :#399630;-webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);-moz-box-shadow: 0 0 1px rgba(0,0,0, .75); box-shadow: 0 0 1px rgba(0,0,0, .75);}</style><button id="check">?</button><br>'+
			 '</h2><center>or</center><p>' + options.description1 + '<style>input[type="text"]{  border: 1px solid #ccc;  border-radius: 3px;  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);  width:200px;  min-height: 28px;  padding: 4px 20px 4px 8px;  font-size: 12px;  -moz-transition: all .2s linear;  -webkit-transition: all .2s linear;  transition: all .2s linear;}input[type="text"]:focus{  width: 300px;  border-color: #51a7e8;  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1),0 0 5px rgba(81,167,232,0.5);  outline: none;}</style><input type="text" id="txtfeed" name="feedurl" size="35"><br>'+
			 '</p><button id="insert" style="margin-left: 80px">Insert URL into Navigator</button></div></div>');
			 $(pop_up).appendTo('.paulund_block_page');
			     			 
			 $('.paulund_modal_close').click(function(){
                                
                              
                        
				$(this).parent().fadeOut().remove();
				$('.paulund_block_page').fadeOut().remove();
			      
			 });
			 
			 $(document).ready(function(){
                           $("#check").click(function(){
                                                           var x = document.getElementById("txturl").value;
                        
                               if(x){
                                alert("Wait While finding Feed URL");
                                document.getElementById("txtfeed").value = "Waiting...";
                                  $.post('FeedUrl.php', 'val=' + x, function (response) {
                                  
                                                           if(response.indexOf("No Feed")>-1){
                                                                        alert("Invalid URL for Feed");
                                                              }
                                                              else{
                              
                                                                        alert(response);
                                                                        document.getElementById("txtfeed").value = response;
                                                                        
                                                                }
								  
                                                            });
                                   }
                                   else{
								     alert("Please Enter URL or Feed URL");
                                   }								   
								  
				
							
			    });
                         });
				
			$(document).ready(function(){
                          $("#insert").click(function(){
                                      alert("Insert site");
					  
					var feed_url = document.getElementById("txtfeed").value;  
					if(feed_url && feed_url!="Waiting..."){
                                                        $.post('InsertFeed.php', 'val=' + feed_url, function (response) {

                                                                 $(this).parent().fadeOut().remove();
		        	                                 $('.paulund_block_page').fadeOut().remove();  

                                                          });

                                        }
                                        else{
                                            alert("Please Enter Feed Url");
                                        }  
					  
					  
					  
					
                  });
                });
			 
                         
		} 
		
		
		return this;
	};
	
})(jQuery);