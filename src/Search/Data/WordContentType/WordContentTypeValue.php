<?php
namespace Nemundo\Process\Search\Data\WordContentType;
class WordContentTypeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var WordContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WordContentTypeModel();
}
}