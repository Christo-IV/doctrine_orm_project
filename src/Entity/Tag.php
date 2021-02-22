<?php

namespace App\Entity;

/**
* @Entity
*/
class Tag {
	/**
	* @Column(type="integer")
	* @Id
	* @GeneratedValue
	* @OneToMany (targetEntity="ArticleTags")
	*/
	private $id;
	/**
	* @Column(type="string")
	*/
	private $name;


	public function getId(){
		return $this->id;
	}

	public function setId($value){
		$this->id = $value;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($value){
		$this->name = $value;
	}
}

	