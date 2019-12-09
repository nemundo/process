<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeTextDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var LargeTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new LargeTextModel();
}
}