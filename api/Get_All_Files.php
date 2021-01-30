<?php

require_once '../helpers/common_helper.php';

$folder_name = BASE_URL . 'uploads/';
$files = scandir(FILE_UPLOAD_PATH);

$output = '';

if(false !== $files)
{
	foreach($files as $file)
	{
		if($file === '.' || $file === '..'){
			continue;
		}
		
		$output .= '
		<div class="srs_cdn_file_list" data-files="../uploads/' . $file . '">
			<img src="'.$folder_name.$file.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
			<span class="close-button"> X</span>
		</div>
		';
	}
}
$output .= '';
echo $output;