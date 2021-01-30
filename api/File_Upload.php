<?php

require_once '../helpers/common_helper.php';

class File_Upload
{
	private $fileUpload;
	private $message;
	private $error;

	public function uploadFile(){

		$this->error = false;
		allowedRequestMethod();
		
		$this->fileUpload = $_FILES;
		$this->FileValidation();

		if($this->error === true){
			jsonResponse($this->message, true, 400);
		}

		if(!is_dir(FILE_UPLOAD_PATH)){
			mkdir(FILE_UPLOAD_PATH, 0777, true);
		}

		$fileName = $this->fileUpload['file']['name'];
		$fileTmpName = $this->fileUpload['file']['tmp_name'];
		$newFileName = rand() . time() . '.' . strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		$uploadPath = FILE_UPLOAD_PATH . '/' . basename($newFileName);
		$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

		if($didUpload){
			jsonResponse("The file " . basename($newFileName) . " has been uploaded.");
		}

		jsonResponse("An error occured. Please contact the administrator.", true, 400);
	}

	private function FileValidation(){

		if(!isset($this->fileUpload['file'])){
			$this->error = true;
			$this->message = "The file field is required";
			return;
		}

		$fileName = $this->fileUpload['file']['name'];
		$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		
		$validFileExtension = ['jpg', 'png','jpeg','gif','mp4'];

		if(!in_array($ext, $validFileExtension)){
			$this->error = true;
			$this->message['file_ext'] = 'Please upload a valid file. Only jpg, png, jpeg, gif and mp4 files are allowed.';
			return;
		}

		$fileSize = $this->fileUpload['file']['size'];
		
		if($fileSize > 10000000){
			$this->error = true;
			$this->message['file_size'] = 'Maximum allowed file size is 10 MB.';
			return;
		}
	}
}

$obj = new File_Upload();
$obj->uploadFile();