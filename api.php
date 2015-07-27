<?php
// API communication entre php et angular
require_once("includeClass.php");

$listModel = array('client','commande','produit','glossaire');

if(isset($_GET['action']) && isset($_GET['model'])){
	$action = $_GET['action'];
	$model = $_GET['model'];
	$class = ucfirst($model);
	$data = json_decode($_GET['data']);
	
	if(in_array($model,$listModel)){
		switch ($action) {
			//create
			case 'save':
				$obj = new $class();
				//$props = get_object_vars($obj);
				foreach($data as $propname => $value){
					$propname = ucfirst($propname);
					$setter = "set".$propname;
					$obj->$setter($value);
				}
				$ret = $obj->save();
				$resp = array('msg' => 'sauvegardé', 'data' => $ret);
				header('Content-Type: application/json');
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, POST');
				echo json_encode($resp);
				break;
			//read
			case 'read':
				$obj = Model::read($class, $data->id);
				$obj = json_encode($obj);
				$resp = array('msg' => '', 'data' => $obj);
				header('Content-Type: application/json');
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, POST');
				echo json_encode($resp);
				break;
			//update
			case 'update':
				# code...
				break;
			//delete
			case 'delete':
				# code...
				break;
			//list
			case 'list':
				# code...
				break;
			
			default:
				echo "undefined";
				break;
		}
	}
	
}
?>