<?php
namespace Nemundo\Process\Geo\Data\Geo;
use Nemundo\Model\Id\AbstractModelIdValue;
class GeoId extends AbstractModelIdValue {
/**
* @var GeoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GeoModel();
}
}