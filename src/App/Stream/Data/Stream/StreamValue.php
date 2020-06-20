<?php
namespace Nemundo\Process\App\Stream\Data\Stream;
class StreamValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var StreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StreamModel();
}
}