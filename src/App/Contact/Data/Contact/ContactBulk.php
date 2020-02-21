<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var ContactModel
*/
protected $model;

/**
* @var string
*/
public $company;

/**
* @var string
*/
public $lastName;

/**
* @var string
*/
public $firstName;

/**
* @var string
*/
public $phone;

/**
* @var string
*/
public $email;

public function __construct() {
parent::__construct();
$this->model = new ContactModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->company, $this->company);
$this->typeValueList->setModelValue($this->model->lastName, $this->lastName);
$this->typeValueList->setModelValue($this->model->firstName, $this->firstName);
$this->typeValueList->setModelValue($this->model->phone, $this->phone);
$this->typeValueList->setModelValue($this->model->email, $this->email);
$id = parent::save();
return $id;
}
}