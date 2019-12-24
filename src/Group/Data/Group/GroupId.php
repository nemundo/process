<?php
namespace Nemundo\Process\Group\Data\Group;
use Nemundo\Model\Id\AbstractModelIdValue;
class GroupId extends AbstractModelIdValue {
/**
* @var GroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
}