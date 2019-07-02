<?php
set_time_limit(0);
date_default_timezone_set('UTC');
require 'vendor/autoload.php';

use App\Lib\MakeImage;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quotebot ID</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/html/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/html/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/html/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/html/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="bg-contact3" style="background-image: url('assets/images/bg-01.jpg');">
        <div class="container-contact3">
            <div class="wrap-contact3">
                <form class="contact3-form validate-form" method="post">
                    <span class="contact3-form-title">
                        Buat Quote
                    </span>
                    <?php
                    if (isset($_POST['quote'])) {
                        if (strlen($_POST['quote']) > 6) {
                            if($_POST['name'] != "" || $_POST['name'] != null){
                                $name = $_POST['name'];
                                $captionText = "Ada quote nih dari ".$name.". Mau ikutan buat quote juga ? klik link di bio, atau bisa akeses link berikut
                                http://codernewbie.id
                                ";
                            } else {
                                $name = "Anonymous";
                                $captionText = "Ingin buat quote juga ? klik link di bio, atau bisa akeses link berikut
                                http://codernewbie.id";
                            }
                            /////// CONFIG ///////
                            $username = 'Usernamenya';
                            $password = 'Passwordnya';
                            $debug = false;
                            $truncatedDebug = false;
                            //////////////////////
                            /////// MEDIA ////////
                            $photoFilename = 'file.jpg';
                            //////////////////////
                            $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
                            try {
                                $ig->login($username, $password);
                            } catch (\Exception $e) {
                                echo 'Something went wrong: ' . $e->getMessage() . "\n";
                                exit(0);
                            }
                            try {


                                $im = new MakeImage;

                                $createImage = $im->create($_POST['quote'], $name);


                                $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($photoFilename);
                                $ig->timeline->uploadPhoto($photo->getFile(), ['caption' => $captionText]);
                                echo "<div class='alert alert-success'>Quote sudah di upload, chek instagram berikut: <a href='https://instagram.com/quotebot.id' target='_blank'>quotebot.id</a></div>";
                            } catch (\Exception $e) {
                                echo 'Something went wrong: ' . $e->getMessage() . "\n";
                            }
                        } else { 
                            echo "<div class='alert alert-danger'>Quote rerlalu pendek, minimal 6 huruf.</div>";
                        }
                    }
                    ?>
                    <div class="wrap-input3 validate-input" data-validate="Message is required">
                        <textarea class="input3" name="quote" placeholder="Quote Kamu" height="10px" required></textarea>
                        <span class="focus-input3"></span>
                    </div>
                    <div class="wrap-input3">
                        <input class="input3" type="text" name="name" placeholder="Nama kamu">
                        <span class="focus-input3"></span>
                    </div>
                    <p>*) Kosongkan nama untuk Anonim</p>

                    <div class="container-contact3-form-btn">
                        <button class="contact3-form-btn">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="assets/html/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/html/bootstrap/js/popper.js"></script>
    <script src="assets/html/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/html/select2/select2.min.js"></script>
    <script>
        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>
    <!--===============================================================================================-->
    <script src="assets/js/main.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

</body>

</html>