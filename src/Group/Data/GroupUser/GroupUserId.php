<?php
namespace Nemundo\Process\Group\Data\GroupUser;
use Nemundo\Model\Id\AbstractModelIdValue;
class GroupUserId extends AbstractModelIdValue {
/**
* @var GroupUserModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupUserModel();
}
}