<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var ContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
}