<?php

// A classs to help work with Sessions #endregion
// In our case, primarily to mange logging users in and out #endregion

// Keep in mind when working with sessions that #endregion
// That it is generally inadvisable to store #endregion
// DB-related objects in sessions #endregion


class session {
    private $logged_in = false;
    public $user_id = 1;
    public $user_username = '';
    public $user_last_name = '';
    public $user_first_name = '';
    public $message;
  function __construct()
  {
      session_start();
      $this->check_login();
      $this->check_message();
  }

  // see in public if logged in #endregion
  public function is_logged_in(){
      return $this->logged_in;
  }

  // login function #endregion
  public function login($user) {
      if($user){
          $this->user_id = $_SESSION['user_id'] = $user->id;
          $this->user_username = $_SESSION['username'] = $user->username;
          $this->user_first_name = $_SESSION['first_name'] = $user->first_name;
          $this->user_last_name = $_SESSION['last_name'] = $user->last_name;
          $this->logged_in = true;
      }
  }

   // login function #endregion
   public function logout() {
   unset($_SESSION['user_id']);
   unset($this->user_id);
   $this->logged_in = false;
}

  // check if logged in #endregion
  private function check_login(){
      if(isset($_SESSION['user_id'])){
          $this->user_id=$_SESSION['user_id'];
          $this->logged_in = true;
      }else{
          unset($this->user_id);
          $this->logged_in = false;
      }
  }

  // set function message
  public function message($msg=''){
      if(!empty($msg)){
          $_SESSION['message'] = $msg;
      } else {
          // act like get message 
          return $this->message;
      }
  }

  // check if there is message s stored in the session
  private function check_message(){
      if(isset($_SESSION['message'])){
       $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
      }else {
          $this->message = '';
      }
  }

}

$session = new session();
$message = $session->message();
?>