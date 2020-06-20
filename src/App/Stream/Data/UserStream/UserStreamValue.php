<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
class UserStreamValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var UserStreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserStreamModel();
}
}