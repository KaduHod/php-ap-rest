<?php 

namespace Utils;

class Logger {
		
	public function __construct(){
	
	}

	static function LOG(string $message){
		file_put_contents("/var/log/php-rest.log", "\n".Logger::DATE().$message, FILE_APPEND);
	}

	static function DATE() {
		return "[".date("Y-m-d H:i:s")."]";
	}

	static function INFO(string $message) {
		return Logger::LOG("[INFO] .:: ".$message." ::.");
	}

	static function WARNING(string $message) {
               Logger::LOG("[WARNING] .:: ".$message." ::.");
        }

	static function DEBUG(string $message) {
		$line  = debug_backtrace()[0]['line'];	
                Logger::LOG("[DEBUG][$line] .:: ".$message." ::.");
        }

}

