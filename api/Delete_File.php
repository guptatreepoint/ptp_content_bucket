<?php

require_once '../helpers/common_helper.php';

/**
 * ============================================================================
 *@className : Delete_File
 *@author  : <sumit kumar gupta>
 *@date : 05-January-2020
 *@purpose : To delete file from folder and return message
 *=============================================================================
 */
class Delete_File
{
	private $message;
	private $error;
	private $successMessage;
	private $errorMessage;

	/**
	 * delete file from this API
	 * @return json
	 */
	public function deleteFile(){

		$this->error = false;
		allowedRequestMethod();

		$this->inputValidations();
		if($this->error === true){
			jsonResponse($this->message, true, 400);
		}

		$filePath = $_POST['file_path'];

		$filePathArray = explode(',', $filePath);

		if(empty($filePathArray)){
			jsonResponse('Please provide file path.', true, 400);
		}

		foreach ($filePathArray as $file) {

			$fileName = trim($file);
			if(file_exists($fileName)){
				unlink($fileName);
				$this->successMessage[] = 'File ' . $fileName . ' deleted successfully.';
			}else{
				$this->errorMessage[] = 'The file ' . $fileName . ' does not exist.';
			}
		}

		if(!empty($this->errorMessage)){
			jsonResponse($this->errorMessage, true, 400);
		}else{
			jsonResponse($this->successMessage);
		}
	}

	/**
	 * input field validation
	 * @return json or empty
	 */
	private function inputValidations(){

		if(!isset($_POST['file_path'])){
			$this->error = true;
			$this->message = 'The file path field is required.';
			return;
		}

		if(!is_string($_POST['file_path'])){
			$this->error = true;
			$this->message = 'The file path field must be string.';
			return;
		}
	}

}

$obj = new Delete_File();
$obj->deleteFile();