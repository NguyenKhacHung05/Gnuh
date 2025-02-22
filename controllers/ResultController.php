<?php

class ResultController {
    private $resultView;

    public function __construct() {
        $this->resultView = new ResultView();
    }

    // Hiển thị lỗi 404 - Not Found
    public function show404() {
        $this->resultView->show404("Sorry, the page you are looking for does not exist.");
    }

    // Hiển thị lỗi 500 - Internal Server Error
    public function show500() {
        $this->resultView->show500("An internal server error occurred. Please try again later.");
    }
}
