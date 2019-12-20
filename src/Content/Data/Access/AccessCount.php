<?php
namespace Nemundo\Process\Content\Data\Access;
class AccessCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var AccessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AccessModel();
}
}