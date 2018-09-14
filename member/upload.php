<?php
function json_msg($data = array()){
	exit(json_encode($data));
}
function json_error($msg){
	json_msg(array("msg"=>$msg,'code'=>0));
}

if(!isset($_FILES['file'])){
	json_msg(array("msg"=>"请选择要上传文件",'code'=>0));
}

$CONFIG_MAX_SIZE = 800 * 1024;
$CONFIG_FILE_BAD_CHR = array('\\','/',':','*','?','"','<','>','|');
$CONFIG_FILE_MIME = array('image/jpeg','image/pjpeg','image/jpg','image/gif','image/png','image/x-png','application/msword','application/pdf','application/zip','application/x-zip-compressed');
$CONFIG_FILE_EXT = array('.zip','.jpg','.png','.gif','.doc','.pdf');
$CONFIG_UPLOAD_FOLDER = "../upload/";

if(!is_dir($CONFIG_UPLOAD_FOLDER)){
	mkdir($CONFIG_UPLOAD_FOLDER);
}


$dateNewFolder = 1;

$uploadFile = $_FILES['file'];
if($uploadFile){
	$file_name = $uploadFile['name'];
	$file_ext = substr($file_name,strrpos($file_name,"."));
	$file_temp_name = $uploadFile['tmp_name'];
	
	if($file_name == ''){
		json_error("抱歉，文件名不可为空！");
	}elseif($file_ext == ''){
		json_error("抱歉，文件必须有扩展名！");
	}elseif($uploadFile['size'] > $CONFIG_MAX_SIZE){
		json_error("文件太大不能上传");
	}elseif(!in_array($uploadFile['type'],$CONFIG_FILE_MIME) && !in_array($file_ext,$CONFIG_FILE_EXT)){
		json_error("对不起你所上传的文件类型不符合规定，不允许上传");
	}else{
		$new_file_name = $file_name;
	
		$new_file_name = date("YmdHis") . rand(10000,99999) . $file_ext;

		
		$save_file_path = $CONFIG_UPLOAD_FOLDER;
		if($dateNewFolder == 1){
			$save_file_path .= date("Y") . '/';
			if(!is_dir($save_file_path)) mkdir($save_file_path);

			$save_file_path .= date("m") . '/';
			if(!is_dir($save_file_path)) mkdir($save_file_path);

			$save_file_path .= date("d") . '/';
			if(!is_dir($save_file_path)) mkdir($save_file_path);
		}
		$save_file_path .= $new_file_name;
		
		if (file_exists($save_file_path) == 1){
			json_error("抱歉，同名文件已经存在，停止上传！");
		}else{
			$result = move_uploaded_file($file_temp_name,$save_file_path);
			
			if(!$result) $result = copy($file_temp_name,$save_file_path);
			
			if($result){
				json_msg(array("msg"=>"文件上传成功",'code'=>1,'path'=>$save_file_path));
			}else{
				json_error("上传失败，请重新上传");
			}
		}
	}
}