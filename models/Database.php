<?php

class Database{
    protected \PDO|null $pdo=null ;
    protected  string $tableName="reservations";
    protected  string $classeName="ReservationEntity";
     

    protected function __construct()
    {
       
    }
    
    protected function openConnexion():void{
      $hote= "127.0.0.1";
      $port= "5432";
      $userMysql= "postgres";
      $passwordMysql= "Steven-Gerard08";
      $bdName= "hotel";
        try {
          if($this->pdo==null){
              $this->pdo = new \PDO("pgsql:host=$hote;port=$port;dbname=$bdName", $userMysql, $passwordMysql);
          }
        } catch (\PDOException $e) {
          echo "Connection failed " . $e->getMessage();
        }
    }

    protected function closeConnexion(){
      $this->pdo=null;
    }
    
}