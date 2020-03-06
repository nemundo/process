<?php


namespace Nemundo\Process\Template\Content\MultiFile;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFileReader;

class MultiFileContentView extends AbstractContentView
{

    public function getContent()
    {

        $reader = new TemplateMultiFileReader();
        $reader->filter->andEqual($reader->model->dataContentId, $this->contentType->getContentId());
        $reader->filter->andEqual($reader->model->active,true);

        $list = new UnorderedList($this);
        $list->addCssClass('list-unstyled');

        foreach ($reader->getData() as $row) {

            $link = new UrlHyperlink($list);
            $link->url = $row->file->getUrl();
            $link->content = $row->file->getFilename();
        }

        return parent::getContent();

    }

}