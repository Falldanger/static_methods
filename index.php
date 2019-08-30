<?php
	define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'date_test');

    try{
    $pdo= new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
	}
	catch(PDOException $e){
		echo "Connection error";
	}
	
	class Test{

		public static $pos;
		public static $lastWord;
		public static $matches;
		public static $date;
		public static $getstr;

		public static function last_word($sentence){
			// position of last occuring space 
			// in the string 
			self::$pos = strrpos($sentence, ' '); 
			  
			// if the string has only one word 
			if(!self::$pos) 
			{ 
			    self::$pos = 0; 
			} 
			else
			{ 
			    self::$pos = self::$pos + 1; 
			} 
			  
			// get the last word in the string 
			self::$lastWord = substr($sentence,self::$pos); 
			  
			// return length of last word  
			return strlen(self::$lastWord); 
		}

		public static function sql_date_format($dateStr){
			return self::$date=date("d-m-Y H:i:s",strtotime($dateStr));
		}

		public static function extract_string($str){
			preg_match_all('#\[(.*?)\]#', $str, self::$matches);
			self::$getstr='';
			for ($i=0; $i <count(self::$matches[0]) ; $i++) { 
				self::$getstr=self::$getstr.' '.self::$matches[1][$i];
			}
			
			return self::$getstr;
		}
	}

echo '<b>Test task:</b></br>';

//last_word function
echo Test::last_word('Hello World').'</br>';
echo Test::last_word('').'</br>';

//sql_date_format function
$query='SELECT `date` FROM `test`';
	$result=$pdo->query($query);
	$rows=$result->fetch();
	$getdate=$rows['date'];
	
echo Test::sql_date_format($getdate).'</br>';

//extract_string function
echo Test::extract_string('The quick [brown fox].').'</br>';

?>