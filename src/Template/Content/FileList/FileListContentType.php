<?php


namespace Nemundo\Process\Template\Content\FileList;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFile;


class FileListContentType extends AbstractFileListContentType
{

    protected function loadContentType()
    {

        $this->typeLabel='File List';
        $this->typeId='a362b20d-bcd0-4465-a112-0a2d1625161d';

    }




    public function addFileRequest(FileRequest $fileRequest) {


        $data = new TemplateMultiFile();
        $data->active=true;
        $data->dataContentId = $this->getContentId();
        $data->file->fromFileRequest($fileRequest);
        $data->save();


    }


}