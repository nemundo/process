<?php


namespace Nemundo\Process\Com\NotFound;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;

// ItemNotFoundContainer
// ItemNotFoundDiv
class ItemNotFound extends AbstractHtmlContainer
{

    public function getContent()
    {

        $subtitle = new AdminSubtitle($this);
        $subtitle->content = 'Oooops, da ging was schief';

        $p=new Paragraph($this);
        $p->content='Datensatz nicht gefunden';

        return parent::getContent();
    }

}