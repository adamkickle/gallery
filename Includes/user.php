<?php
     
 require_once('database.php');   
 require_once('init.php');   


class User{
    protected static $table_name = "users";
    public $id;
    public $username ='def name';
    public $password;
    public $first_name;
    public $last_name;
 
 public static function find_all(){
     
     return self::find_by_sql("SELECT * FROM ".self::$table_name);
 }
//  find user by id




public static function find_by_id($id=0){
    global $database;
    $database = new database();
       
        $result_array = self::find_by_sql("select * from  ".self::$table_name."  where id ={$id} limit 1");
      //var_dump($result_array);
       //$fuond = $database->fetch_array($result_array);
        
    

        return !empty($result_array) ? array_shift($result_array) : false;

    }

// findby sql #endregion
public static function find_by_sql($sql=''){
    global $database;
    $database = new database();
    $result_set = $database->query($sql);
    

    $object_array = array();
    while($row = $database->fetch_array($result_set)){
        $object_array[] = self::instantiate($row);
    }


    return $object_array;
} 

//+++++++++++++++++ Authnticate a user to login
public static function Authenticate($username='', $password=''){
global $database; //= new database();

$sql = "select * from users ";
$sql .=  "where username = '{$username}' ";
$sql .="AND password = '{$password}' ";
$sql .="limit 1";
$result_array = self::find_by_sql($sql);
return !empty($result_array) ? array_shift($result_array) : false;

}



//=================

public function full_name(){
    if(isset($this->first_name) && isset($this->last_name)){
        return $this->first_name. ' ' .$this->last_name;
    } else{
        return '';
    }
}


//=================
private static function instantiate($record){
 $object = new self;
/*  $object->id = $record['id'];
  $object->username = $record['username'];
 $object->password = $record['password'];
  $object->last_name = $record['last_name'];
  $object->first_name = $record['first_name']; */

//  more dynamic, short-form approach:
    foreach($record as $attribute=>$value){
        if($object->has_attribute($attribute)){
            $object->$attribute = $value;
        }
    }
    return $object;
}

//==========================
private function has_attribute($attribute){
    $object_vars = get_object_vars($this);

    return array_key_exists($attribute, $object_vars); // return bool
}
// insert  anew user 


public function create($arr){
global $db;
// $db = $Database->connection;
$stmt = $db->prepare('insert into '.self::$table_name.' (username,password,first_name, last_name) values (?, ?, ?,?)');

 $check_success= $stmt->execute([ $arr['username'],$arr['password'],  $arr['first_name'],$arr['last_name']]);
//write into the logfile
 if($check_success){
        log_action('new user', "{$arr['first_name']} registered.");
     
    }else{
        log_action('new user failed', "{$arr['first_name']} to register.");  
    }
}


// update
public function update($arr,$id=1){
    global $db;
    // $db = $Database->connection;
    $sql = "UPDATE ".self::$table_name." SET  username = :username
                             
                                where id = '$id'";
    $stmt = $db->prepare($sql);                                  
    $stmt->bindParam(':username', $arr['username']);     
    $stmt->execute(); 
    }


// delete a user from database

function delete($id){
    global $db;

    $stmt = $db->prepare("delete from  ".self::$table_name."  where
     id = :id limit 1");

$stmt->bindValue(':id', $id);
$stmt->execute();

}

}







?>