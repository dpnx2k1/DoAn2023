<?php
class Database{
    public $host= "DB_HOST";
    public $user= "DB_USER";
    public $pass= "PASS";
    public $dbName="DB_NAME";
    
    public $link;
    public $error;

    public function __construct()
    {
        $this-> connectDB();
    }

    private function connectDB(){
        $this->link=new mysqli($this->host,$this->user,$this->pass,$this->dbName);
        if ($this->link) {
            $this->error="Connection Fail".$this->link->connect_error;
            return false;
        }
    }

#doc data 
public function select($query){
    $result= $this->link->query($query) or die($this->link->error.__LINE__);
   if ($result->num_rows >0) {
    # code...
    return $result;
   }else { 
    return false;
   }
}

public function insert($query){
    $insert_row= $this->link->query($query) or die($this->link->error.__LINE__);
   if ($insert_row) {
    # code...
    return $insert_row;
   }else { 
    return false;
   }
}

public function update($query){
    $update_row= $this->link->query($query) or die($this->link->error.__LINE__);
   if ($update_row) {
    # code...
    return $update_row;
   }else { 
    return false;
   }
}

public function delete($query){
    $delete_row= $this->link->query($query) or die($this->link->error.__LINE__);
   if ($delete_row) {
    # code...
    return $delete_row;
   }else { 
    return false;
   }
}

}


?>