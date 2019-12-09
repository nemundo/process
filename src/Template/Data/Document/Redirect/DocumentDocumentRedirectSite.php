<?php
namespace Nemundo\Process\Template\Data\Document\Redirect;
class DocumentDocumentRedirectSite extends \Nemundo\Model\Redirect\AbstractRedirectFilenameSite {
public function loadSite() {
parent::loadSite();
$this->url = "process-template-document-document-redirect";
$this->model = new  \Nemundo\Process\Template\Data\Document\DocumentModel();
$this->type = $this->model->document;
}
public function registerSite() {
DocumentRedirectConfig::$redirectDocumentDocumentSite = $this;
}
}