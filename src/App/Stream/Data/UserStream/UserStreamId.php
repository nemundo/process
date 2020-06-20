<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
use Nemundo\Model\Id\AbstractModelIdValue;
class UserStreamId extends AbstractModelIdValue {
/**
* @var UserStreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserStreamModel();
}
}