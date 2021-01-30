$(document).ready(function(){
	listAllImages();
});

function listAllImages(){
	$.ajax({
		url: 'api/get_all_files.php',
		method: 'POST',
		success: function(response){
			$('.file-listings').html(response);
		}
	});
}

/**
 * delete
 */
$(document).on('click', '.close-button', function(){

	if(!confirm('Do you want to remove?')){
		return;
	}

	$.ajax({
		url: 'api/delete_file.php',
		method: 'POST',
		data: {file_path : $(this).parent('div.srs_cdn_file_list').attr('data-files')},
		success: function(response){
			maintainAjaxResponse(response);
			listAllImages();
		}
	});
});