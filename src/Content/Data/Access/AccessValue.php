<?php
namespace Nemundo\Process\Content\Data\Access;
class AccessValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var AccessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AccessModel();
}
}