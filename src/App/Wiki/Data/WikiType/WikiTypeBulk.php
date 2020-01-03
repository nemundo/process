<?php
namespace Nemundo\Process\App\Wiki\Data\WikiType;
class WikiTypeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var WikiTypeModel
*/
protected $model;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new WikiTypeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$id = parent::save();
return $id;
}
}