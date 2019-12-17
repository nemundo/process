<?php


namespace Nemundo\Process\App\News\Com;


use Nemundo\Admin\Com\Form\AbstractAdminEditForm;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\App\News\Data\News\NewsReader;
use Nemundo\Process\App\News\Item\NewsContentItem;
use Nemundo\Process\Form\AbstractContentForm;

class NewsContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapTextBox
     */
    private $newsTitle;

    /**
     * @var BootstrapLargeTextBox
     */
    private $teaser;


    public function getContent()
    {

        $p = new Paragraph($this);
        $p->content = 'dataid:'.$this->dataId;


        $this->newsTitle=new BootstrapTextBox($this);

        $this->teaser = new BootstrapLargeTextBox($this);



        return parent::getContent();

    }


    protected function loadUpdateForm()
    {
    //    parent::loadUpdateForm(); // TODO: Change the autogenerated stub


        $newsRow = (new NewsReader())->getRowById($this->dataId);

        $this->newsTitle->value= $newsRow->title;
        $this->teaser->value= $newsRow->teaser;

        /*$subtitle = new AdminSubtitle($this);
        $subtitle->content=$row->title;

        $p = new Paragraph($this);
        $p->content = $row->teaser;*/

    }

    protected function onSubmit()
    {

        $item = new NewsContentItem($this->dataId);
        $item->parentId=$this->parentId;
        $item->title=$this->newsTitle->getValue();
        $item->teaser = $this->teaser->getValue();
        $item->saveItem();


    }




}