<?php
require_once 'init.php';
class photograph
{
    protected static $table_name = "photographs";
    public $id;
    public $target_file;
    public $type;
    public $size;
    public $caption;

    private $temp_file;
    public $upload_dir;
    public $target_path;
    public $errors;

    protected $upload_errors = array(
        UPLOAD_ERR_OK => 'NO ERRORS',
        UPLOAD_ERR_INI_SIZE => 'larger than upload_max_filesize',
        UPLOAD_ERR_FORM_SIZE => 'larger than from MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL => 'partial upload.',
        UPLOAD_ERR_NO_FILE => 'NO FILE',
        UPLOAD_ERR_NO_TMP_DIR => 'NO TEMP DIRECTORY',
        UPLOAD_ERR_CANT_WRITE => 'CAN\'T WRITE TO DISK',
        UPLOAD_ERR_EXTENSION => 'FILE UPLOAD STOPED BY EXTENSION.',

    );

    // pass in $_FILE['UPLOADED_FILE'] as an argument
    public function attach_file($file)
    {
        // perform an error checking
        // set object attributes to the form parameters
        if (!$file || empty($file) || !is_array($file)) {
            $this->errors[] = "no file was uploaded.";
            return false;
        } elseif ($file['error'] != 0) {
            //  error: report what PHP says went wrong
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            //set object attributes to the  form parameters
            $this->upload_dir = "images";
            $this->temp_file = $file['tmp_name'];
            $this->target_file = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];

            // proccess the form data

        }

    }

// save function
    public function save()
    {
        // A new record won't have an id yet.
        if (isset($this->id)) {
            // just to update the caption
            // $this->update();
        } else {
            // can't save if there is error exists
            if (!empty($this->errors)) {return false;}
            // make sure the caption is not to long for DB
            if (strlen($this->caption) > 255) {
                return false;
            }
            // Determine the target_path
            $this->target_path = $target_path = $this->upload_dir . "/" . $this->target_file;

            //make sure the file is already exists
            if (file_exists($target_path)) {
                $this->errors[] = "the file {$this->target_file} is already exists";
                return false;
            }
            // Attempt to move the file

            if (move_uploaded_file($this->temp_file, $target_path)) {
                // Success
                // save a corresponding entry to the database
                if ($this->create()) {
                    // we are done with the temp path ,
                    // the file is not there any more
                    unset($this->temp_file);
                    return true;
                }

            } else {
                // file was not uploaded
                $this->errors[] = "the file upload failed, possibly due to
            incorrect permission on upload folder";
                return false;
            }
        }
        return true;
    }
    // abstracted methods
    public static function find_all()
    {
        global $db;
        $stmt = $db->query('select * from photographs');

        $results = $stmt->fetchall();

        //with fetch all method all results stored in one array
        return $results;
    }
    //  find user by id

    public static function find_by_id($id = 0)
    {
        global $db;
        $stmt = $db->prepare("select * from  " . self::$table_name . "  where id ={$id} limit 1");
        $stmt->execute();
        $photo = $stmt->fetch();

        //with fetch all method all results stored in one array
        return $photo;

    }

    // findby sql #endregion

    // findby sql #endregion
    public static function find_by_sql($sql = '')
    {
        global $db;
        $database = new database();
        $result_set = $database->query($sql);
        $result_set = mysqli_fetch_array($result_set);

        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = self::instantiate($row);
        }

        return $result_set;
    }

    //==========================
    private function has_attribute($attribute)
    {
        $object_vars = get_object_vars($this);

        return array_key_exists($attribute, $object_vars); // return bool
    }

    public function create()
    {
        global $db;
        // $db = $Database->connection;
        $stmt = $db->prepare('insert into ' . self::$table_name . ' (filename,type,size, caption) values (?, ?, ?,?)');

        $check_success = $stmt->execute([$this->target_file, $this->type, $this->size, $this->caption]);
        //write into the logfile
        if ($check_success) {
            log_action('new photo', "{$this->target_file} Added.");

        } else {
            log_action('new photo failed', "{$this->target_file} to upload.");
        }
    }

    // update
    public function update($arr, $id = 1)
    {
        global $db;
        // $db = $Database->connection;
        $sql = "UPDATE " . self::$table_name . " SET  username = :username

                                where id = '$id'";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $arr['username']);
        $stmt->execute();
    }

    // delete a user from database

    public function delete($id)
    {
        global $db;

        $stmt = $db->prepare("delete from  " . self::$table_name . "  where
     id = :id limit 1");

        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return true;
    }

// destroy
    public function destroy($id)
    {
        if ($this->delete($id)) {
            unlink('../Public/Admin/images' . $this->filename);
            return true;

        } else {

        }
    }

// total num of photos
    public static function count_all()
    {
        global $db;
        $nRows = $db->query('select count(*) from photographs')->fetchColumn();

        return $nRows;
    }

    // get the photos of one page
    public static function get_page_photos($sql = '')
    {
        global $db;
        $stm = $db->query($sql);

        $rows = $stm->fetchAll();
        return $rows;
    }

}
