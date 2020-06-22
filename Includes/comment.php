<?php

require_once('init.php');


class comment{

    
        protected static $table_name = "comments";
        public static $table_fields  = [
            'id','photograph_id','created','author','body'
        ];
       
    
      public   $id;
      public $photograph_id ;
      public $created;
      public $author;
      public $body;




    // the following function is actting like an factory

     public static function make($photograph_id, $Author='anonymous',$body=''){
            if(!empty($photograph_id) && !empty($body) && !empty($Author)){
                    $comment = new comment();
                    $comment->photograph_id = (int)$photograph_id;
                    $comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
                    $comment->author = $Author;
                    $comment->body = $body;

                    return $comment;
            }else{
                return false;
            }

    }

    // return all comments related to a photo
    public static function find_comments_on($photo_id= 0){
        global $db;
    $sql ="SELECT * FROM".self::$table_name;
    $sql ="WHERE photograph_id".$photo_id;
    $sql = "ORDER BY created ASC";
    return  self::find_by_sql($sql);

    }


    
    
 
        // abstracted methods
        public static function find_all(){
            global $db;
            $stmt= $db->query("select * from comments");
    
            $results = $stmt->fetchall();
            
            //with fetch all method all results stored in one array
            return $results;
        }
       //  find user by id
       
     
       
       // findby sql #endregion
    
       // findby sql #endregion
    public static function find_by_id($id){
       
        global $db;
        $stmt= $db->query("select * from comments where photograph_id={$id}");

        $results = $stmt->fetchall();
        
        //with fetch all method all results stored in one array
        return $results;
    } 
    
    
       
       //==========================
    private function has_attribute($attribute){
        $object_vars = get_object_vars($this);
    
        return array_key_exists($attribute, $object_vars); // return bool
    }
    
    public function create(){
        global $db;
        // $db = $Database->connection;
        $stmt = $db->prepare('insert into '.self::$table_name.' (photograph_id,author,body) values (?, ?, ?)');
       
       
        $check_success= $stmt->execute([ $this->photograph_id,$this->body, $this->author]);
        //write into the logfile
         if($check_success){
                log_action('new comment from : ', "{$this->author} has been added.");
                notify($this->author,

                "new comment from :on {$this->body} has been added."
               
            , $photo_is=$this->photograph_id);
             
            }else{
                log_action('new comment from', "{$this->author} has been failed.");
            }
            return true;
        }
        
    
    
        // delete a user from database
    
    
    public    function delete($id){
        global $db;
    
        $stmt = $db->prepare("delete from  ".self::$table_name."  where
         id = :id limit 1");
    
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return true;
    }
    
    // destroy 
    public function destroy($id){
        if($this->delete($id)){
            unlink('../Public/Admin/images'.$this->filename);  
                return true;
                
        }else {
    
        }
    }
    
}

?>