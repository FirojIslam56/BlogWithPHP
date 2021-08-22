<?php
	class DateFormation{
		public function myDate($get_date){
			return date('F j, Y, g:i a', strtotime($get_date));
		}




		//---------For post text shorten--------//
		public function postShorting($get_text, $limit=250){
			$get_text = $get_text." ";
			$get_text = substr($get_text, 0, $limit);
			$get_text = substr($get_text, 0, strrpos($get_text, ' '));
			$get_text = $get_text."...";
			return $get_text;
		}
		/*-----From admin panel------------*/
		public function adminLoginValidation($data){
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		/*-----From website main home page------------*/
		public function title(){
			$path = $_SERVER['SCRIPT_FILENAME'];
			$title_name = basename($path, ".php");
			if ($title_name == 'index') {
				$title_name = 'Home';
			}elseif ($title_name == 'contact') {
				$title_name = 'Contact';
			}
			return $title_name;
		}

	}
?>