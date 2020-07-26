<?php
############----Ledmago----############
##         LibreMago Library  v1.1   ##
##              24.08.2016           ##
#######################################
 
namespace DataMago;
use \PDO; // This is very important ! ;)

Class Database_Mago
{
	public function tek_data($table,$sart,$stun)
	{ 		
	include("config.php");
				
				if($sart != "")
				{
					$sart = "Where ".$sart;
				}
				 $query = $db->query("SELECT * FROM ".$table." ".$sart)->fetch(PDO::FETCH_ASSOC);
				 return $query[$stun];
				 
				
	}
	
	public function cok_data($table,$sart,$order)
	{ 	
		include("config.php");
				if($sart != "")
				{
					$sart = "Where ".$sart;
				}
		$query = $db->query("SELECT * FROM ".$table." ".$sart." ".$order, PDO::FETCH_ASSOC);
		
		if (!$query->rowCount() ){
			return "This query is empty";
		}
		else
		{
			return  $query;
		}
		
	}
	
	public function data_insert($table,$fields,$values)
	{ 				
				include("config.php");
				$query = $db->prepare("INSERT INTO ".$table." (".$fields.") VALUES (".$values.")");
				$query->execute();						
	
	}
	
	public function data_delete($table,$sart)
	{ 				
				include("config.php");
				if($sart != "")
				{
					$sart = "Where ".$sart;
				}
				$query = $db->prepare("DELETE FROM ".$table." ".$sart);
				$query->execute();						
	
	}
	
	public function data_update($table,$degisen,$sart)
	{ 				
				include("config.php");
				if($sart != "")
				{
					$sart = "Where ".$sart;
				}
				$query = $db->prepare("UPDATE ".$table." SET ".$degisen." ".$sart);
				$query->execute();						
	
	}
	public function data_count($table,$sart)
	{ 		
	include("config.php");
				
				if($sart != "")
				{
					$sart = "Where ".$sart;
				}
				 
				 $sql = "SELECT count(*) FROM ".$table." ".$sart; 
			$result = $db->prepare($sql); 
			$result->execute(); 
			return $result->fetchColumn(); 
				 
				
	}
	
}
Class UserOperation
{
	public function field_control($table,$sart,$stun,$controller)
	{
		include("config.php");
		if($sart != "")
				{
					$sart = "Where ".$sart;
				}
				 $query = $db->query("SELECT * FROM ".$table." ".$sart)->fetch(PDO::FETCH_ASSOC);
				 if($query[$stun] == $controller){return true;}else{return false;}
		
		
	}
	
	public function Login($table,$username,$password,$field1,$field2)
	{
		include("config.php");
		 $query = $db->query("SELECT * FROM ".$table." Where ".$field1." = '".$username."' and ".$field2." = '".$password."'")->fetch(PDO::FETCH_ASSOC);
		if($query){return true;}else{return false;}
	}
	public function clear_special($string)
	{
		  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		
	}
}

Class OnlineOperation
{
	public function add_online($table,$field1,$field2,$username)
	{
		include("config.php");
		 $query = $db->query("SELECT * FROM ".$table." Where ".$field1." = "."'".$username."'")->fetch(PDO::FETCH_ASSOC);
		 if($query){
			 
			 $query2 = $db->prepare("UPDATE ".$table." SET ".$field2." = '".time()."' Where ".$field1." = '".$username."'");
				$query2->execute();		
		 }
		 else
		 {
			 $query = $db->prepare("INSERT INTO ".$table." (".$field1.",".$field2.") VALUES ('".$username."','".time()."')");
			$query->execute();	
		 }
		
		
	}
	
	public function delete_offline($table,$field2,$second)
	{
		include("config.php");
		$time_of_time = time() - $second;
		
		 $query = $db->prepare("DELETE FROM ".$table." Where ".$field2." < '".$time_of_time."'");
		$query->execute();	
		
	}
	
	
	
	
}
Class Image_Mago
{
	
	public function Upload($resim,$kacmb,$yol,$isim)
	{
		if (($resim["type"]=="image/jpeg" || $resim["type"]=="image/png") && $_FILES["resim"]["size"]<1024*1024*$kacmb){
			$dosya_adi=$resim["name"];
			//Dosyaya yeni bir isim oluşturuluyor
			$uret=array("as","rt","ty","yu","fg");
			$uzanti=substr($dosya_adi,-4,4);
			$sayi_tut=rand(1,10000);
			$aradosya = "/";
			if ($yol == "")
			{
				$aradosya = "";
			}
			if($isim == "random")
			{
				$yeni_ad= $yol.$aradosya.$uret[rand(0,4)].$sayi_tut.$uzanti;
			}
			else{
				$yeni_ad= $yol.$aradosya.$isim.$uzanti;
			}
			
			//Dosya yeni adıyla dosyalar klasörüne kaydedilecek
			if (move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad)){
				
				return $yeni_ad;
			}else{
				return "img_error2";
			}
		
		}
		else{
			
			return "img_error1";
		}
	}
}

?>