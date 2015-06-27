<?php

namespace Eoko\Mandrill\Struct;

use Mandrill\Struct\AttachmentSruct;
use Mandrill\Struct\RecipientStruct;
use Zend\Stdlib\Hydrator\ObjectProperty;

class MessageStruct implements StructInterface
{

    /**
     * @var string HTML content to be sent
     */
    public $html;

    /**
     * @var string full text content to be sent
     */
    public $text;

    /**
     * @var string message subject
     */
    public $subject;

    /**
     * @var string sender's email address
     */
    public $from_email;

    /**
     * @var string sender's name
     */
    public $from_name;

    /**
     * @var array recipient information
     */
    public $to = [];

    /**
     * @var array extra headers to add to the message
     */
    public $headers = [];

    /**
     * @var bool whether or not this message is important
     */
    public $important;

    /**
     * @var bool whether or not to turn on open tracking for this message
     */
    public $track_opens;

    /**
     * @var bool whether or not to turn on click tracking for this message
     */
    public $track_clicks;

    /**
     * @var bool whether or not to automatically generate text for messages which are not given text
     */
    public $auto_text;

    /**
     * @var bool whether or not to automatically generate an HTML part for messages not given HTML
     */
    public $auto_html;

    /**
     * @var bool whether or not to automatically inline all CSS provided in the message HTML
     */
    public $inline_css;

    /**
     * @var bool whether or not to strip the query string from URLs when aggregating tracked URL data
     */
    public $url_strip_qs;

    /**
     * @var bool whether or not to expose all recipients in "To" header for each email
     */
    public $preserve_recipients;

    /**
     * @var bool set to false to remove content logging for sensitive emails
     */
    public $view_content_link;

    /**
     * @var string an optional address to receive an exact copy of each recipient's email
     */
    public $bcc_address;

    /**
     * @var string a custom domain to use for tracking opens and clicks
     */
    public $tracking_domain;

    /**
     * @var string a custom domain to use for SPF/DKIM signing
     */
    public $signing_domain;

    /**
     * @var string a custom domain to use for the message's return path
     */
    public $return_path_domain;

    /**
     * @var bool whether or not to evaluate merge tags in the message
     */
    public $merge;

    /**
     * @var array Global merge variables to be used for all recipients. Can be overridden on a per-recipient basis.
     */
    public $global_merge_vars = [];

    /**
     * @var array per-recipient merge variables
     */
    public $merge_vars = [];

    /**
     * @var string[] an array of strings with which to tag the message
     */
    public $tags = [];

    /**
     * @var string the unique id of a subaccount for this message
     */
    public $subaccount;

    /**
     * @var string[] URLs matching domains listed here will automatically have Google Analytics parameters appended to their query strings
     */
    public $google_analytics_domains = [];

    /**
     * @var string the value to set for the utm_campaign tracking parameter
     */
    public $google_analytics_campaign;

    /**
     * @var array an associative array of metadata. Can be overridden on a per-recipient basis.
     */
    public $metadata = [];

    /**
     * @var array per-recipient metadata
     */
    public $recipient_metadata = [];

    /**
     * @var array
     */
    public $attachments = [];

    /**
     * @var array
     */
    public $images = [];

    /**
     * Set a global merge variable. Will overwrite any current variable with the given key.
     * @param string $name
     * @param string $content
     * @return $this
     */
    public function addGlobalMergeVar($name, $content)
    {
        $this->global_merge_vars[] = [
            'name' => $name,
            'content' => $content
        ];
        return $this;
    }

    /**
     * Set all global merge variables. Will overwrite any currently set global merge variables.
     * @param array $vars array('name1' => 'content1', 'name2' => 'content2')
     * @return $this
     */
    public function setGlobalMergeVars(array $vars)
    {
        $this->global_merge_vars = [];
        foreach ($vars as $name => $content) {
            $this->addGlobalMergeVar($name, $content);
        }
        return $this;
    }

    /**
     * Add a tag to this message
     * @param string $tag
     * @return $this
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * Set all tags for this message. Will overwrite any currently existent tags.
     * @param string[] $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Add a Google Analytics domain
     * @param string $domain
     * @return $this
     */
    public function addGoogleAnalyticsDomain($domain)
    {
        $this->google_analytics_domains[] = $domain;
        return $this;
    }

    /**
     * Set all Google Analytics domains for this message. Will overwrite any current domains.
     * @param string[] $domains
     * @return $this
     */
    public function setGoogleAnalyticsDomains(array $domains)
    {
        $this->google_analytics_domains = $domains;
        return $this;
    }

    /**
     * Set a metadata field
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addMetadata($key, $value)
    {
        $this->metadata[$key] = $value;
        return $this;
    }

    /**
     * Set all metadata for this message. Will overwrite any current metadata.
     * @param array $metadata associative array
     * @return $this
     */
    public function setMetadata(array $metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }

    /**
     * Add a recipient to this message
     * @param RecipientStruct $recipient
     * @return $this
     */
    public function addRecipient(RecipientStruct $recipient)
    {
        $this->to[] = [
            'email' => $recipient->email,
            'name' => $recipient->name
        ];
        $this->merge_vars[] = [
            'rcpt' => $recipient->email,
            'vars' => $recipient->getMergeVars()
        ];
        $this->recipient_metadata[] = [
            'rcpt' => $recipient->email,
            'vars' => $recipient->getMetadata()
        ];
        return $this;
    }

    /**
     * Add an attachment to this message
     * @param AttachmentSruct $attachment
     * @return $this
     */
    public function addAttachment(AttachmentSruct $attachment)
    {
        $this->attachments[] = (new ObjectProperty())->extract($attachment);
        return $this;
    }

    /**
     * Add an image to be embedded in this message.
     * @param AttachmentSruct $image type must start with 'image/'
     * @return $this
     */
    public function addImage(AttachmentSruct $image)
    {
        $this->images[] = (new ObjectProperty())->extract($image);
        return $this;
    }
}
