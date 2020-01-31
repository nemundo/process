<?php
namespace Nemundo\Process\Search\Data\WordContentType;
use Nemundo\Model\Data\AbstractModelUpdate;
class WordContentTypeUpdate extends AbstractModelUpdate {
/**
* @var WordContentTypeModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$this->typeValueList->setModelValue($this->model->word, $this->word);
parent::update();
}
}