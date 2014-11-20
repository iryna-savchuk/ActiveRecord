<?php

class CommentsController {

    private $_model;

    public function __construct() {
        if (!empty($_REQUEST['action'])) {
            switch ($_REQUEST['action']) {
                case 'createComment':
                    if (empty($_REQUEST['author']) || empty($_REQUEST['text'])) {  //checking imput for emptiness
                        $showmessanger = true;
                        break;
                    }
                    $this->_model = new Comment(); //creating new Comment object
                    $this->_model->setAuthor(strip_tags($_REQUEST['author']));
                    $this->_model->setText(strip_tags($_REQUEST['text']));
                    $this->_model->save();   //saving new record in DB
                    break;
            }
        }
        $this->_model = new Comment();
        $commentsArray = $this->_model->getArrayOfAll(); // all comments for display
        require_once 'views/comments_view.php';
    }

}
