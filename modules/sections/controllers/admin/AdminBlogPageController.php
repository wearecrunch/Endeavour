<?php

include_once dirname(__FILE__).'/../../controllers/admin/AdminSectionsController.php';

class AdminBlogPageController extends AdminSectionsController {

    public function __construct()
    {
        $this->bootstrap = TRUE;
        $this->table = 'blogitem';
        $this->className = 'BlogItem';
        $this->lang = TRUE;
        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $this->fields_list = array(
            'title' => array(
                'title' => $this->l('Title'),
            ),
        );

        $this->fieldImageSettings = array(
            'name' => 'image',
            'dir' => 'sections',
            'key' => 'blog',
        );

        parent::__construct();
    }

    public function renderForm()
    {
        if ( ! ($object = $this->loadObject(TRUE)))
            return;

        $id = $object->id_blogitem;

        if ($image = $object->getPath())
        {
            $image_url = ImageManager::thumbnail($image, "blog-{$id}.jpg", 250, $this->imageType, TRUE, TRUE);
            $image_size = file_exists($image) ? filesize($image) / 1000 : FALSE;
        }

        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Form'),
                'icon' => 'icon-cog',
            ),
            'input' => array(
                array(
                    'type' => 'file',
                    'label' => $this->l('Image'),
                    'name' => 'image',
                    'display_image' => TRUE,
                    'image' => isset($image_url) ? $image_url : FALSE,
                    'size' => isset($image_size) ? $image_size : FALSE,
                    'required' => TRUE,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Title'),
                    'name' => 'title',
                    'lang' => TRUE,
                    'required' => TRUE,
                ),
                array(
                    'type' => 'color',
                    'label' => $this->l('Color'),
                    'name' => 'color',
                    'required' => TRUE,
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Content'),
                    'name' => 'content',
                    'id' => 'contents',
                    'autoload_rte' => TRUE,
                    'lang' => TRUE,
                    'required' => TRUE,
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Is bigger?'),
                    'name' => 'is_big',
                    'required' => FALSE,
                    'class' => 't',
                    'is_bool' => TRUE,
                    'values' => array(
                        array(
                            'id' => 'on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ),
                        array(
                            'id' => 'off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ),
                    ),
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
            ),
        );

        return parent::renderForm();
    }

}