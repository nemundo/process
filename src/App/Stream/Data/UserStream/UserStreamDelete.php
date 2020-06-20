<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
class UserStreamDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var UserStreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserStreamModel();
}
}