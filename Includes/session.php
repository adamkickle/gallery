<?php

// A classs to help work with Sessions #endregion
// In our case, primarily to mange logging users in and out #endregion

// Keep in mind when working with sessions that #endregion
// That it is generally inadvisable to store #endregion
// DB-related objects in sessions #endregion


class session {
    private $logged_in = false;
    public $user_id = 1;
  function __construct()
  {
      session_start();
      $this->check_login();
  }

  // see in public if logged in #endregion
  public function is_logged_in(){
      return $this->logged_in;
  }

  // login function #endregion
  public function login($user) {
      if($user){
          $this->user_id = $_SESSION['user_id'] = $user->id;
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

}

$session = new session();
?>