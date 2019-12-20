<?php
namespace Nemundo\Process\Search\Data\Word;
use Nemundo\Model\Data\AbstractModelUpdate;
class WordUpdate extends AbstractModelUpdate {
/**
* @var WordModel
*/
public $model;

/**
* @var string
*/
public $word;

public function __construct() {
parent::__construct();
$this->model = new WordModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->word, $this->word);
parent::update();
}
}