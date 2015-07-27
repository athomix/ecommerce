<?php
abstract class Model{
	// CREATE
	public function save(){
		$db = new Connection();
		$table = strtolower(get_class($this));
		$prefixe = substr($table,0,3)."_";
		$props = get_object_vars($this);
		unset($props["id"]);
		foreach($props as $prop => $value){
			{
				$column[] = $prefixe.$prop;
				$prop = ":".$prop;
				$params[] = $prop;
			}
		}
		$query = "INSERT INTO ".$table."(".implode(',' , $column).") VALUES(".implode(',', $params).")";
		$request = $db->prepare($query);
		$request->execute($props);
		$id = $db->lastInsertId();
		$db= null;
		return $id;
	}

	// READ
	public static function read($type, $id=null){
		$db = new Connection();
		$class=$type;
		$table = strtolower($class);
		$prefixe = substr($table,0,3)."_";
		
		$query = "SELECT * FROM ".$table;
		$query.= " WHERE ".$prefixe."id = ".$id;

		$result = $db->query($query);
		$data = $result->fetch(PDO::FETCH_ASSOC);
		$db = null;
		return $data;
		
	}

	// UPDATE
	public function update(){
		$db = new Connection();
		$table = strtolower(get_class($this));
		$prefixe = substr($table,0,3)."_";
		$props = get_object_vars($this);
		unset($props["id"]);

		foreach($props as $prop => $value){
			{
				$up[] = $prefixe.$prop."=:".$prop;
				$prop = ":".$prop;
			}
		}

		$query="UPDATE ".$table." SET ".implode(',', $up);
		$query.=" WHERE ".$prefixe."id=".$this->getId();

		$request = $db->prepare($query);
		$request->execute($props);
		$db = null;
	}

	// DELETE
	public function delete($type, $id){
		$db = new Connexion();
		$class=$type;
		$table = strtolower($class);
		$prefixe = substr($table,0,3)."_";

		$query = "DELETE FROM ".$table;
		$query.= " WHERE ".$prefixe."id = ".$id;

		$request = $db->query($query);
		$db=null;

	}

	// LIST

	public function readAll($type){
		$db = new Connection();
		$class=$type;
		$table = strtolower($class);
		
		$query = "SELECT * FROM ".$table;

		$result = $db->query($query);
		$nb=0;

		while($data = $result->fetch(PDO::FETCH_OBJ)){

		$output[$nb] = new $class();
			foreach($data as $key => $value)
			{
				$setProp = "set".ucfirst(substr($key,4));
				$output[$nb]->$setProp($value);
			}
		$nb++;
		}

		return $output;
		$db = null;
	}
}
?>