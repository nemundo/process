<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var GroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
}