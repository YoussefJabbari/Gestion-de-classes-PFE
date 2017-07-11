<?php
	
	class Connexion{

		private $host="localhost";
		private $user='root';
		private $pwd='';
		private $dbname="pfe";
		
		public function getPDO()
        {
            $p = new PDO("mysql:host=localhost;dbname=pfe",'root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			return $p;
        }


	}


?>