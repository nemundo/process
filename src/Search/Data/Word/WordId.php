<?php
namespace Nemundo\Process\Search\Data\Word;
use Nemundo\Model\Id\AbstractModelIdValue;
class WordId extends AbstractModelIdValue {
/**
* @var WordModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WordModel();
}
}