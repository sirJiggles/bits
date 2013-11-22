jQuery.noConflict();
jQuery(function($) {

	function updatePodSlection(){
		var selected = $( "#type-controlls select" ).val();

		$.each($('.type-select'), function(key, val){

			var type = $(val).attr('id').replace('-type', '');
			if(type != selected){
				$(val).hide();
			}else{
				$(val).show();
			}

		})
	}

	// if we are on a pod page
	if( $('#type-controlls').length ){

		updatePodSlection();

		// on chnage for the pod type select
		$('#type-controlls select').change(function(event){
			updatePodSlection();
		});
	}

	
});