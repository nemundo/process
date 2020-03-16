<?php


namespace Nemundo\Process\App\Notification\Content\Message;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\View\AbstractContentView;

class MessageNotificationContentView extends AbstractContentView
{

    /**
     * @var MessageNotificationContentType
     */
    public $contentType;

    public function getContent()
    {

        $notificationRow = $this->contentType->getDataRow();

        $title = new AdminSubtitle($this);
        $title->content = $notificationRow->subject;

        $p = new Paragraph($this);
        $p->content = $notificationRow->message;


        return parent::getContent();

    }

}