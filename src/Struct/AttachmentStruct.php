<?php

namespace Eoko\Mandrill\Struct;

class AttachmentSruct implements StructInterface
{

    /**
     * @var string the MIME type of the attachment
     */
    public $type;

    /**
     * @var string the file name of the attachment
     */
    public $name;

    /**
     * @var string the content of the attachment as a base64-encoded string
     */
    public $content;
}
