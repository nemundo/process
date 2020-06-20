<?php
namespace Nemundo\Process\App\Stream\Data\Stream;
class StreamCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var StreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StreamModel();
}
}