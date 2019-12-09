<?php
namespace Nemundo\Process\Template\Data\DeadlineChange;
class DeadlineChangeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var DeadlineChangeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DeadlineChangeModel();
}
}