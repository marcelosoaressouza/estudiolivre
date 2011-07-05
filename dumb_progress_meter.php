<?php

if (!function_exists("upload_progress_meter_get_info")) {
	function upload_progress_meter_get_info($uploadId) {
		return array('bytes_uploaded' => 0, 'bytes_total' => 1);
	}
}
?>
