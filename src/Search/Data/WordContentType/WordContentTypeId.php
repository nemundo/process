<?php
namespace Nemundo\Process\Search\Data\WordContentType;
use Nemundo\Model\Id\AbstractModelIdValue;
class WordContentTypeId extends AbstractModelIdValue {
/**
* @var WordContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WordContentTypeModel();
}
}