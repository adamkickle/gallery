<?php
include_once('config.php');
class database {

  private $host, $database,$username , $password, $connection;
  private $port = 3306;
  public $last_query;
 
  function __construct($host=DB_HOST, $username=DB_USER, $password=DB_PASS, $database=DB_NAME, $port = 3306, $autoconnect = true) {
    $this->host = $host;
    $this->database = $database;
    $this->username = $username;
    $this->password = $password;
    $this->port = $port;

    if($autoconnect) $this->open();
  }

  /**
  * Open the connection to your database.
  */
  function open() {
    $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);
    if($this->connection->error){
      echo 'connection failed';
    } else{
     // echo "connection start successfully with {$this->database}".'<br/>';
    }

}

  /**
  * Close the connection to your database.
  */
  function close() {
    $this->connection->close();
  }

  /**
  *
  * Execute your query
  *
  * @param string $query - your sql query
  * @return the result of the executed query 
  */
  public function query($query) {

    $this->last_query = $query;
     if(!$this->connection){
       echo 'there is no connection';
     }
    return $this->connection->query($query);
  }

/* fetch result as array*/
public function fetch_array($results){
 
  return mysqli_fetch_array($results);
}

// return with affected rows
public function affected_rows(){
  return mysqli_affected_rows($this->connection);
}

// num of rows
public function num_rows($result){
return mysqli_num_rows($result);
}


// get the last query
public function last_query(){
  echo $this->last_query;
}
  /**
  * Escape your parameters to prevent SQL Injections! Usage: See documentation (link at the top of the file)
  *
  * @param string $string - your parameter to escape
  * @return the escaped string 
  */
  function escape($string) {
    return $this->connection->escape_string($string);
  }
}

$Database = new database();



?>