<?php
namespace Nemundo\Process\Template\Data\SourceLog;
use Nemundo\Model\Id\AbstractModelIdValue;
class SourceLogId extends AbstractModelIdValue {
/**
* @var SourceLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SourceLogModel();
}
}