<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var ContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentModel();
}
}