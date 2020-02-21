<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var ContactModel
*/
public $model;

/**
* @var string
*/
public $id;

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

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->company = $this->getModelValue($model->company);
$this->lastName = $this->getModelValue($model->lastName);
$this->firstName = $this->getModelValue($model->firstName);
$this->phone = $this->getModelValue($model->phone);
$this->email = $this->getModelValue($model->email);
}
}