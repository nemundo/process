<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var ContentTypeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $phpClass;

/**
* @var string
*/
public $contentType;

/**
* @var bool
*/
public $setupStatus;

/**
* @var string
*/
public $applicationId;

/**
* @var \Nemundo\App\Application\Row\ApplicationCustomRow
*/
public $application;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->phpClass = $this->getModelValue($model->phpClass);
$this->contentType = $this->getModelValue($model->contentType);
$this->setupStatus = boolval($this->getModelValue($model->setupStatus));
$this->applicationId = $this->getModelValue($model->applicationId);
if ($model->application !== null) {
$this->loadNemundoAppApplicationDataApplicationApplicationapplicationRow($model->application);
}
}
private function loadNemundoAppApplicationDataApplicationApplicationapplicationRow($model) {
$this->application = new \Nemundo\App\Application\Row\ApplicationCustomRow($this->row, $model);
}
}