<?php

 class DB {
   private static $instance = null;
   private $pdo,
           $error=false,
           $results,
           $query,
           $count = 0;

   private function __construct(){
     $host=Config::get('mysql/host');
     $db=Config::get('mysql/db');

     $username=Config::get('mysql/username');

     $password=Config::get('mysql/password');

     try{
       $this->pdo = new PDO("mysql:host=$host;dbname=$db",$username,$password);
        //print_r($this->pdo);

     }catch(PDOException $e){
       die($e->getMessage());
     }

   }

   public static function getInstance(){

          if(!isset(self::$instance)){
            self::$instance = new DB();
           return self::$instance;
          };

          return self::$instance;

   }

   public function query($sql,$params=[]){
     $this->error = false;
     if($this->query = $this->pdo->prepare($sql)){
       $statement = $this->query;
       //print_r($statement) ;
        $i = 1;
        //print_r($this->query);
        //echo count($params);
        if(count($params)){
          foreach($params as $p){
            //echo $x;
            $statement->bindValue($i, $p, PDO::PARAM_STR);
            $i++;
            //echo $x;
          }
        }

        //print_r($statement);
        if($statement->execute()){
          $this->results = $statement->fetchAll(PDO::FETCH_OBJ);
          $this->count = $statement->rowCount();
          //var_dump($this->results[0]->username);
        }else{
          $this->error = true;
        }
     }
          return $this;
   }
   public function action($action,$table, $where = []){
      if(count($where===3) && !empty($where)){
     $operators = ['=','<','>','<=','>='];
      //print_r($where);
       $field = $where[0];
       $operator = $where[1];
       $value = $where[2];
       if(in_array($operator,$operators)){
         $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
         if(!$this->query($sql, [$value])->error()){
           return $this;
         }
       }

     }elseif(empty($where)){
       $sql = "{$action} FROM {$table}";
       if(!$this->query($sql)->error()){
         return $this;
       }
     }else{
       return false;
     }
   }
   public function get($table, $where =[]){
     return $this->action("SELECT*",$table, $where);
   }
   public function all($table){
     return $this->action("SELECT*",$table);
   }
   public function delete($table, $where=[]){
     return $this->action("DELETE", $table, $where);

   }
   public function insert($table, $fields = []){
      if(count($fields)){
        $keys = array_keys($fields);
        $keys = implode('`, `',$keys);
        $values = '';
        $x =1;

        foreach ($fields as $field) {
          $values.= '?';
          if($x<count($fields)){
            $values .= ', ';
            $x++;
          }

        }

      $sql = "INSERT INTO {$table} (`".$keys."`) VALUES (".$values.")";
      //print_r($sql);
        if(!$this->query($sql,$fields)->error()){
          return true;
        }
        return false;
      }
   }
   public function update($table, $id, $fields =[]){
     $set = '';
     $x =1;
     foreach($fields as $key => $value){
       $set .= "{$key}= ?";
       if($x<count($fields)){
         $set .= ', ';
         $x++;
       }
     }
     $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
     //print_r($sql);
       if(!$this->query($sql,$fields)->error()){
         return true;
       }
       return false;

   }

    public function first(){
     return $this->results()[0];
   }
   public function error(){
     return $this->error;
   }

   public function count(){
     return $this->count;
   }
   public function results(){
     return $this->results;
   }
 }
