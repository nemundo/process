<?php
namespace Nemundo\Process\App\Stream\Data\Stream;
use Nemundo\Model\Id\AbstractModelIdValue;
class StreamId extends AbstractModelIdValue {
/**
* @var StreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StreamModel();
}
}