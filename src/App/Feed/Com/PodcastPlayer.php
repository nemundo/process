<?php


namespace Nemundo\Process\App\Feed\Com;


use Nemundo\Admin\Com\Card\AdminCard;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Multimedia\Audio;
use Nemundo\Html\Paragraph\Paragraph;


// AudioPodcastPlayer
class PodcastPlayer extends AbstractHtmlContainer
{

    public $title;

    public $description;

    public $mediaUrl;

    public function getContent()
    {


        $card= new AdminCard($this);
        $card->title=$this->title;


        //$subtitle=new AdminSubtitle($card);
        //$subtitle->content=$this->title;

        $p=new Paragraph($card);
        $p->content= $this->description;

        $audioPlayer=new Audio($card);
        $audioPlayer->src=$this->mediaUrl;


        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}