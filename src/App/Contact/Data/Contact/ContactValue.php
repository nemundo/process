<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var ContactModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContactModel();
}
}