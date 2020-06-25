<?php 
require_once __DIR__.'/helpers.php';

class DB{
    private $username;
    private $pw;
    private $name;
    private $prefix;
    private $con;
    
    public function __construct(){
        $this->username = getConfig('database->username');
        $this->pw = getConfig('database->password');
        $this->name = getConfig('database->name');
        $this->prefix = getConfig('database->prefix');

        try{
            $this->con = new \PDO("mysql:host=localhost;dbname=$this->name", $this->username, $this->pw);
            // set the PDO error mode to exception
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $checker = $this->con->prepare("DESCRIBE `$this->prefix"."users"."`");
            try{
                $checker->execute();
            }catch(\Exception $e){
                $this->createTables();
            }
        }catch(\Exception $e){
            dd($e);
        }

    }

    public function query($query, $debug = false){
        $ee = $this->con->prepare($query);
        if($debug){ dd($query); }
        if($ee->execute()){
            if(preg_match('/^INSERT/', $query, $matches)){
                $ss = $this->con->prepare("SELECT LAST_INSERT_ID() as `id`");
                $ss->execute();
                return $ss->fetch(\PDO::FETCH_ASSOC)['id'];
            }else{
                return $ee->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return false;
    }

    public function createTables(){
        $tables = [
            'users' => "CREATE TABLE IF NOT EXISTS `".$this->prefix."users`(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50),
                password VARCHAR(50),
                isActive INT(1) DEFAULT '0',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)
            ",
            "affise" => "CREATE TABLE IF NOT EXISTS `".$this->prefix."affise`(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                sub1 VARCHAR(30) NOT NULL,
                sub2 VARCHAR(30) NOT NULL,
                sub1Fake VARCHAR(30) NOT NULL,
                adm_id INT(11) NOT NULL,
                offer_id INT(11) NOT NULL,
                offer TEXT NOT NULL,

                title VARCHAR(150) NOT NULL,
                impression_url VARCHAR(150) NOT NULL,
                ad_id INT(11) NOT NULL,
                click_url VARCHAR(150) NOT NULL,
                image_url VARCHAR(150) NOT NULL)
            ",
            "adm" => "CREATE TABLE IF NOT EXISTS `".$this->prefix."adm`(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                sub1 VARCHAR(30) NOT NULL,
                sub2 VARCHAR(30) NOT NULL,
                sub1Fake VARCHAR(30) NOT NULL,
                url TEXT NOT NULL,
                name VARCHAR(150) NOT NULL,
                impression_url VARCHAR(150) NOT NULL,
                ad_id INT(11) NOT NULL,
                click_url VARCHAR(150) NOT NULL,
                image_url VARCHAR(150) NOT NULL)
            ",
        ];
        
        foreach($tables as $table){
            $cc = $this->con->prepare($table);
            $cc->execute();
        }

        $addAdmin = $this->con->prepare("INSERT INTO `".$this->prefix."users` (firstname, lastname, email, password, isActive) 
        VALUES('Admin', 'Admin', 'admin@admin','".sha1(`admin`)."', 1)");

        $addAdmin->execute();

        return true;
    }

    public function getPrefix(){
        return $this->prefix;
    }
}

$db = new DB();