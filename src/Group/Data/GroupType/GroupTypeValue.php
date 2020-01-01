<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var GroupTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupTypeModel();
}
}