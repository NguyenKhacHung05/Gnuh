<?php 
class ResultView{
    public function show404($message){
        http_response_code(404);
        echo ' <section class="error-section p-0 pt-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="content-404 text-center">
                            <img src="assets/img/404.png" alt="">
                            <h2>Something went wrong</h2>
                            <a href="/gnuh/"><button class="btn1">Go Back Home</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }
    public function show500($message){
        http_response_code(500);
        echo ' <section class="error-section p-0 pt-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="content-404 text-center">
                            <img src="assets/img/404.png" alt="">
                            <h2>500</h2>
                            <a href="/gnuh/"><button class="btn1">Go Back Home</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }
    function displayError($message, $route = '/gnuh/'){
        echo ' <section class="error-section p-0 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content-warning text-center">
                            <img src="assets/img/exclamation.png" alt="">
                            <h5 class="text-nowrap text">'.$message.'</h5>
                            <a href="'.$route.'"><button class="btn1">Go Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }
}
?>