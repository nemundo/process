<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var ContactModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContactModel();
}
}