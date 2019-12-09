<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeTextValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var LargeTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new LargeTextModel();
}
}