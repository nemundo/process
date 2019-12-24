<?php
namespace Nemundo\Process\Group\Data\GroupUser;
class GroupUserDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var GroupUserModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupUserModel();
}
}