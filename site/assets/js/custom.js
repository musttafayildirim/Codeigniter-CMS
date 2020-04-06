(function($){
	$(document).ready(function(){

		// Notify Plugin - The below code (until line 42) is used for demonstration purposes only
		//-----------------------------------------------
		if (($(".main-navigation.onclick").length>0) && !Modernizr.touch ){
			$.notify({
				// options
				message: 'The Dropdowns of the Main Menu, are now open with click on Parent Items. Click "Home" to checkout this behavior.'
			},{
				// settings
				type: 'info',
				delay: 10000,
				offset : {
					y: 150,
					x: 20
				}
			});
		};
		if (!($(".main-navigation.animated").length>0) && !Modernizr.touch && $(".main-navigation").length>0){
			$.notify({
				// options
				message: 'The animations of main menu are disabled.'
			},{
				// settings
				type: 'info',
				delay: 10000,
				offset : {
					y: 150,
					x: 20
				}
			}); // End Notify Plugin - The above code (from line 14) is used for demonstration purposes only

		};

		$(".share-button").click(function(e){

			e.stopPropagation();

			var window_size = "width=585,height=511";
			var url = this.href;
			var domain = url.split("/")[2];

			switch (domain){
				case "www.facebook.com":
					window_size = "width=585,height=368";
					break;
				case "www.twitter.com":
					window_size = "width=585,height=261";
					break;
			}

			window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,' + window_size);
			return false;

		});

		$(".neverShowAgainBtn").click(function () {

			var $url = $(this).data("url");
			var $id  = $(this).data("popup-id");

			var $data = {
				url : $url,
				popup_id : $id,
			};

			var csrf_key   	= $(this).data("csrf-key");
			var csrf_value 	= $(this).data("csrf-value");

			$data[csrf_key] = csrf_value;

			$.post($url, $data, function () {})
		});

	}); // End document ready
})(this.jQuery);
