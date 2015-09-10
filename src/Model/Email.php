<?php

namespace Eoko\Mandrill\Model;

/**
 * @codeCoverageIgnore
 */
class Email
{

    protected $from = [];

    protected $to = [];

    protected $htmlTemplate = '';

    protected $textTemplate = '';

    protected $vars = [];

    /**
     * @return array
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param array $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param array $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getHtmlTemplate()
    {
        return $this->htmlTemplate;
    }

    /**
     * @param string $htmlTemplate
     * @return $this
     */
    public function setHtmlTemplate($htmlTemplate)
    {
        $this->htmlTemplate = $htmlTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getTextTemplate()
    {
        if ($this->textTemplate) {
            return $this->textTemplate;
        }
        return $this->getHtmlTemplate();
    }

    /**
     * @param string $textTemplate
     * @return $this
     */
    public function setTextTemplate($textTemplate)
    {
        $this->textTemplate = $textTemplate;
        return $this;
    }

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * @param array $vars
     * @return $this
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
        return $this;
    }
}
