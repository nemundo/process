<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var ContentGroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentGroupModel();
}
}