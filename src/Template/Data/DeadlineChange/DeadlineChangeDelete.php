<?php
namespace Nemundo\Process\Template\Data\DeadlineChange;
class DeadlineChangeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var DeadlineChangeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DeadlineChangeModel();
}
}