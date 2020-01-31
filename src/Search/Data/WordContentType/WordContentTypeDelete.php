<?php
namespace Nemundo\Process\Search\Data\WordContentType;
class WordContentTypeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var WordContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WordContentTypeModel();
}
}