<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var GroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
}