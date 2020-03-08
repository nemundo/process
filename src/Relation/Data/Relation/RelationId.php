<?php
namespace Nemundo\Process\Relation\Data\Relation;
use Nemundo\Model\Id\AbstractModelIdValue;
class RelationId extends AbstractModelIdValue {
/**
* @var RelationModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new RelationModel();
}
}