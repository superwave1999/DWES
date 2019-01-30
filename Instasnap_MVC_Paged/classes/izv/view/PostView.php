<?php

namespace izv\view;

use izv\model\Model;
use izv\tools\Util;

class PostView extends View {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('twigFolder', 'html_files/');
        $this->getModel()->set('twigFile', 'upload_page.html');
    }

    function render($accion) {
        $data = $this->getModel()->getViewData();
        $loader = new \Twig_Loader_Filesystem($data['twigFolder']);
        $twig = new \Twig_Environment($loader);
        return $twig->render($data['twigFile'], $data);
    }
}