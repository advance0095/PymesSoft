<?php
class Notification {
	public static $tablename = "notifications";
	


	public function Notification(){

   $this->Type= $notificationType="";
   $this->Status=$status ="";
	}


	public function changeStatusEnable($Type,$status){

        $sql = "update ".self::$tablename." set Status=\"$status\" where NotificationType=$Type";
		Executor::doit($sql);	

if($sql){}else{
       echo mysqli_errno($sql) . ": " . mysqli_errno($sql) . "\n";
}


	}


    public function changeStatusDisable($Type,$status){
    $sql = "update ".self::$tablename." set Status=\"$status\" where NotificationType=$Type";
		Executor::doit($sql);

        if($sql){}else{
            echo mysqli_error($sql) . ": " . mysqli_error($sql) . "\n";
            echo "no se pudo";
        }
	}



public function changeStatusTest($Type,$status){
    $sql = "update ".self::$tablename." set Status=\"$status\" where NotificationType=$Type";
    Executor::doit($sql);
    if($sql){}else{
        echo mysqli_error($sql) . ": " . mysqli_error($sql) . "\n";
        echo "no se pudo";
    }
	}





	public function add($notificationType,$status){
		$sql = "insert into notifications (id,NotificationType,Status) ";
		$sql .= "value ('','$name','$q')";
		return Executor::doit($sql);
	}



	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto StatusData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new StatusData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new StatusData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new StatusData());
	}


}

?>