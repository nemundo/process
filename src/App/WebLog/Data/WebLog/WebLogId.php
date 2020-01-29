<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
use Nemundo\Model\Id\AbstractModelIdValue;
class WebLogId extends AbstractModelIdValue {
/**
* @var WebLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WebLogModel();
}
}