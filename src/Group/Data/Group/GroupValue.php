<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var GroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
}