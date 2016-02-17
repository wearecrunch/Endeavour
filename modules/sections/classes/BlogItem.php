<?php

class BlogItem extends ObjectModel {

    public $id_blogitem;
    public $title;
    public $content;
    public $timestamp;
    public $is_big;
    public $color;

    public static $definition = array(
        'table' => 'blogitem',
        'primary' => 'id_blogitem',
        'multilang' => TRUE,
        'fields' => array(
            'color' => array('type' => self::TYPE_STRING, 'required' => TRUE),
            'title' => array('type' => self::TYPE_STRING, 'lang' => TRUE, 'required' => TRUE),
            'content' => array('type' => self::TYPE_HTML, 'lang' => TRUE, 'required' => TRUE),
            'timestamp' => array('type' => self::TYPE_DATE),
            'is_big' => array('type' => self::TYPE_BOOL),
        ),
    );

    public function __construct($id = NULL, $lang = NULL, $shop = NULL)
    {
        parent::__construct($id, $lang, $shop);

        $this->id = $this->id_blogitem;
        $this->timestamp = ($this->timestamp === NULL ? date('Y-m-d') : $this->timestamp);
    }

    public function getDate()
    {
        $date = DateTime::createFromFormat('Y-m-d', $this->timestamp);
        echo htmlspecialchars($date->format('j F Y'), ENT_QUOTES, "UTF-8");
    }

    public function getPath()
    {
        $path = _PS_IMG_DIR_.'sections'.DIRECTORY_SEPARATOR.'blog-'.$this->id_blogitem.'.jpg';

        if ( ! isset($this->id_blogitem) OR empty($this->id_blogitem) OR ! file_exists($path))
            return NULL;

        return $path;
    }

    public function getURL()
    {
        if ($this->getPath() === NULL)
            return NULL;

        return _PS_IMG_.'sections'.DIRECTORY_SEPARATOR.'blog-'.$this->id_blogitem.'.jpg';
    }

    public static function all($lang = NULL)
    {
        if ($lang === NULL)
        {
            $lang = Context::getContext()->language->id;
        }

        $items = new PrestaShopCollection('BlogItem', $lang);
        $items->orderBy('id_blogitem', 'DESC');

        return $items;
    }

}