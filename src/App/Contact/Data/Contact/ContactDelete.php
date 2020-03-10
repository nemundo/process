<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var ContactModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContactModel();
}
}