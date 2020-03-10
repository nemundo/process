<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
use Nemundo\Model\Id\AbstractModelIdValue;
class ContactId extends AbstractModelIdValue {
/**
* @var ContactModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContactModel();
}
}