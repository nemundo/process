<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var CmsTypeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $parentContentTypeId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $parentContentType;

/**
* @var string
*/
public $cmsContentTypeId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $cmsContentType;

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
$this->parentContentTypeId = $this->getModelValue($model->parentContentTypeId);
if ($model->parentContentType !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypeparentContentTypeRow($model->parentContentType);
}
$this->cmsContentTypeId = $this->getModelValue($model->cmsContentTypeId);
if ($model->cmsContentType !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypecmsContentTypeRow($model->cmsContentType);
}
$this->setupStatus = boolval($this->getModelValue($model->setupStatus));
$this->applicationId = $this->getModelValue($model->applicationId);
if ($model->application !== null) {
$this->loadNemundoAppApplicationDataApplicationApplicationapplicationRow($model->application);
}
}
private function loadNemundoProcessContentDataContentTypeContentTypeparentContentTypeRow($model) {
$this->parentContentType = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentTypeContentTypecmsContentTypeRow($model) {
$this->cmsContentType = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
private function loadNemundoAppApplicationDataApplicationApplicationapplicationRow($model) {
$this->application = new \Nemundo\App\Application\Row\ApplicationCustomRow($this->row, $model);
}
}