<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
class UserStreamCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var UserStreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserStreamModel();
}
}