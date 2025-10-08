<?php

interface Downloadable {
    public function download();
}

class Book {
    public $author;
    public $title;
    public $price;

    public function __construct($author, $title, $price) {
        $this->author = $author;
        $this->title = $title;
        $this->price = $price;
    }
}

class Ebook extends Book implements Downloadable {
    public $fileSize;

    public function __construct($author, $title, $price, $fileSize = null) {
        parent::__construct($author, $title, $price);
        $this->fileSize = $fileSize;
    }

    public function download() {
        echo "Downloading the ebook titled ' {$this->title} ' by {$this->author}.<br>";
    }
}

// Sử dụng
$ebook = new Ebook(" Liêm Phong ", " Kinh dị ", 9.99, "2MB");
$ebook->download();

?>
