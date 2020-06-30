<?php
namespace Nemundo\Process\Container\Data\Container;
class ContainerCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var ContainerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContainerModel();
}
}