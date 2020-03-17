<?php


namespace Nemundo\Process\Template\Content\FileList;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Debug\Debug;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFileReader;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\FileInactiveSite;

class FileListContentView extends AbstractContentView
{

    /**
     * @var AbstractFileListContentType
     */
    public $contentType;

    public function getContent()
    {

        //$contentId = $this->contentType->getContentId();

        //(new Debug())->write($contentId);


       /* $p=new Paragraph($this);
        $p->content ='Content Id: '. $this->contentType->getContentId();

        $p=new Paragraph($this);
        $p->content ='Data Id: '. $this->contentType->getContentId();*/



        $table= new AdminTable($this);

        $header = new TableHeader($table);
        //$header->addText('');
        $header->addText('File');
        $header->addEmpty();


        foreach ($this->contentType->getChild() as $child) {

            $contentType = $child->getContentType();

            $row=new TableRow($table);
            //$row->addText('File');
            //$row->addText($child->subject);
            $row->addText($contentType->getSubject());

            $site = clone(FileInactiveSite::$site);
            $site->addParameter(new FileParameter($child->dataId));
            $row->addIconSite($site);

        }


        /*
        $reader = new TemplateMultiFileReader();
        $reader->filter->andEqual($reader->model->dataContentId, $this->contentType->getContentId());
        $reader->filter->andEqual($reader->model->active,true);

        $list = new UnorderedList($this);
        $list->addCssClass('list-unstyled');

        foreach ($reader->getData() as $row) {

            $link = new UrlHyperlink($list);
            $link->url = $row->file->getUrl();
            $link->content = $row->file->getFilename();
        }*/

        return parent::getContent();

    }

}