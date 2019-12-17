<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var ContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentModel();
}
}