<?php


namespace Nemundo\Process\Template\Content\MultiFile;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFile;

class MultiFileContentType extends AbstractMultiFileContentType
{

    protected function loadContentType()
    {

        $this->typeLabel='Multi File';
        $this->typeId='a362b20d-bcd0-4465-a112-0a2d1625161d';

     // $this->formClass=MultiFileContentForm::class;
     //   $this->viewClass=MultiFileContentView::class;

        // TODO: Implement loadContentType() method.
    }



    protected function onCreate()
    {



    }


    public function addFileRequest(FileRequest $fileRequest) {


        $data = new TemplateMultiFile();
        $data->dataContentId = $this->getContentId();
        $data->file->fromFileRequest($fileRequest);
        $data->save();


    }


}