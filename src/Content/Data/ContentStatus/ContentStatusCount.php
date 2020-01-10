<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
class ContentStatusCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var ContentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentStatusModel();
}
}