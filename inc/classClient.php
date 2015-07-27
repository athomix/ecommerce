<?php
require("classModel.php");
class Client extends Model
{
	protected $id=0;
	protected $statut;
	protected $nom;
	protected $prenom;
	protected $societe;
	protected $coeff;

	/*GET*/
	public function getId(){ return $this->id;} 
	public function getStatut(){ return $this->statut;} 
	public function getNom(){ return $this->nom;} 
	public function getPrenom(){ return $this->prenom;} 
	public function getSociete(){ return $this->societe;} 
	public function getCoeff(){ return $this->coeff;} 

	/*SET*/
	public function setId($value){ $this->id = $value;} 
	public function setStatut($value){ $this->statut = $value;} 
	public function setNom($value){ $this->nom = $value;} 
	public function setPrenom($value){ $this->prenom = $value;} 
	public function setSociete($value){ $this->societe = $value;} 
	public function setCoeff($value){ $this->coeff = $value;} 

	public function Client(){}

	
}
?>