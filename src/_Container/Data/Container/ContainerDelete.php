<?php
namespace Nemundo\Process\Container\Data\Container;
class ContainerDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var ContainerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContainerModel();
}
}