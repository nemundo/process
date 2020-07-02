<?php


namespace Nemundo\Process\Cms\Page;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\Template\AbstractTemplateDocument;
use Nemundo\Process\Cms\Com\CmsEditorContainer;
use Nemundo\Process\Content\Parameter\ParentParameter;

class CmsEditorPage extends AbstractTemplateDocument
{

    public function getContent()
    {


        $parameter= new ParentParameter();
        $parameter->contentTypeCheck=false;

        $contentType = $parameter->getContentType();

        $title=new AdminTitle($this);
        $title->content=$contentType->getSubject();

        $btn=new AdminSiteButton($this);
        $btn->site=$contentType->getSubjectViewSite();


        $editor = new CmsEditorContainer($this);
        $editor->parentId = (new ParentParameter())->getValue();

        return parent::getContent();

    }

}