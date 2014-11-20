<?php

class Comment extends ActiveRecord {

    public $id;
    public $author;
    public $text;

    public function __construct($id = null) {
        parent::__construct($id);
    }

}
