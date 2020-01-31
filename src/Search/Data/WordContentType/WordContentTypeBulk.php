<?php
namespace Nemundo\Process\Search\Data\WordContentType;
class WordContentTypeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var WordContentTypeModel
*/
protected $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $contentTypeId;

/**
* @var string
*/
public $word;

public function __construct() {
parent::__construct();
$this->model = new WordContentTypeModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$this->typeValueList->setModelValue($this->model->word, $this->word);
$id = parent::save();
return $id;
}
}