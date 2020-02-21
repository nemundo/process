<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var ContactModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContactModel();
}
/**
* @return ContactRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new ContactRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}