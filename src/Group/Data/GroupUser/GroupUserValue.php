<?php
namespace Nemundo\Process\Group\Data\GroupUser;
class GroupUserValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var GroupUserModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupUserModel();
}
}