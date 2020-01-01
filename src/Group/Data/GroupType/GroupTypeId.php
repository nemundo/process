<?php
namespace Nemundo\Process\Group\Data\GroupType;
use Nemundo\Model\Id\AbstractModelIdValue;
class GroupTypeId extends AbstractModelIdValue {
/**
* @var GroupTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupTypeModel();
}
}