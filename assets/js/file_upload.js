Dropzone.autoDiscover = false;

$(document).ready(function(){
	var myDropzone = new Dropzone("#dropzoneForm", 
	{ 
		dictDefaultMessage: "Drop files here or click to upload.",
		url: "api/File_Upload.php",
		paramName: 'file',
		maxFilesize : 10, //10 MB
		acceptedFiles : 'image/*,.mp4',
		success: function(response){
			var xhrRes = response.xhr;

			if (xhrRes.readyState == 4 && xhrRes.status == 200) {
				
				maintainAjaxResponse(xhrRes.responseText);
				listAllImages();
			}
		}
	});
});