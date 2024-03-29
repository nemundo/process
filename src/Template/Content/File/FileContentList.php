<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\View\AbstractContentList;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFilePaginationReader;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\File\FileSite;

class FileContentList extends AbstractContentList
{

    public function getContent()
    {

        $fileReader = new TemplateFilePaginationReader();
        $fileReader->model->loadContent();
        $fileReader->model->content->loadContentType();
        $fileReader->model->content->loadUser();
        $fileReader->paginationLimit = 50;



        $table = new AdminClickableTable($this);

        $header = new AdminTableHeader($table);

        $header->addText('File');
        $header->addText('Extension');
        $header->addText('Size');
        $header->addText('Date/Time');
        $header->addText('User');
        $header->addText('Source');
        $header->addEmpty();

        foreach ($fileReader->getData() as $fileRow) {

            $row = new BootstrapClickableTableRow($table);

            if (!$fileRow->active) {
                $row->strikeThrough = true;
            }

            $row->addText($fileRow->file->getFilename());
            $row->addText($fileRow->file->getFileExtension());
            $row->addText($fileRow->file->getFileSize());
            $row->addText($fileRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($fileRow->content->user->displayName);
            $row->addText($fileRow->content->contentType->contentType);

            $ul = new UnorderedList($row);
            foreach ($fileRow->content->getContentType()->getParentContent() as $contentRow) {
                $ul->addText($contentRow->subject);
            }

            $site = clone(FileSite::$site);
            $site->addParameter(new FileParameter($fileRow->id));
            $row->addClickableSite($site);


        }

        $pagination = new BootstrapPagination($this);
        $pagination->paginationReader = $fileReader;


        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}