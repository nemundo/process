<?php
namespace Nemundo\Process\Template\Data\DeadlineChange;
use Nemundo\Model\Id\AbstractModelIdValue;
class DeadlineChangeId extends AbstractModelIdValue {
/**
* @var DeadlineChangeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DeadlineChangeModel();
}
}