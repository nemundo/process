<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var GroupTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupTypeModel();
}
}