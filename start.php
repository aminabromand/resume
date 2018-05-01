<?php
/**
 * Created by PhpStorm.
 * User: amina
 * Date: 29.04.2018
 * Time: 09:56
 */

require ("site-info.php");
require ("site-menu.php");
require ("site-content.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="resume_style.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->



    <script>
        function scrollspy () {
            let i = 0;

            let doc = document.getElementById("demo");
            let mynav = document.getElementById("mynav");
            let linklist = mynav.getElementsByTagName("A");
            let link = "";
            let hashpositions = [];
            let position = [];

            for (i = 0; i < linklist.length; i++) {
                link = linklist[i].href;
                if (link.indexOf("#") > -1) {
                    position[position.length] = document.getElementById(link.split("#")[1]);
                    hashpositions[hashpositions.length] = position[i].offsetTop;
                    // linklist[i].innerHTML = linklist[i].innerHTML + " " + position[i].offsetTop
                    //     + " " + (hashpositions[i] + position[i].clientHeight);
                }
            }
            hashpositions.sort(function(a, b){return a-b});

            return function () {
                let currentposition = window.pageYOffset;
                // doc.innerHTML = currentposition;

                for (i = 0; i < hashpositions.length; i++) {
                    if (currentposition + 10 >= hashpositions[i]) {
                        linklist[i].parentNode.classList.add("active");
                    }
                    else {
                        linklist[i].parentNode.classList.remove("active");
                    }
                    if (currentposition > (hashpositions[i] + position[i].clientHeight)) {
                        linklist[i].parentNode.classList.remove("active");
                    }
                }
            }
        }

        function scrollsmooth_run (event) {
            event.preventDefault();

            let myHash = this.hash;
            let mysection = document.getElementById(this.hash.substring(1));
            let pageYOffset_start = window.pageYOffset;
            let pos_diff = mysection.offsetTop - pageYOffset_start;
            let pos_diff_delta = pos_diff / 100;
            let varCounter = 0;
            let id = setInterval(frame, 5);
            function frame() {
                console.log((mysection.offsetTop - 10) + " < " + window.pageYOffset + " < " + (mysection.offsetTop + 10));
                let test = (mysection.offsetTop - 10) < window.pageYOffset && window.pageYOffset < (mysection.offsetTop + 10);
                console.log("7: " + test);

                if(varCounter <= 110) {
                    varCounter++;
                } else {
                    clearInterval(id);
                }

                if ((mysection.offsetTop - 5) < window.pageYOffset && window.pageYOffset < (mysection.offsetTop + 5)) {
                    clearInterval(id);
                } else {
                    window.scrollTo(window.pageXOffset, window.pageYOffset + pos_diff_delta);
                }
            }
        }

        function scrollsmooth () {
            let linklist = mynav.getElementsByTagName("A");
            for (i = 0; i < linklist.length; i++) {
                linklist[i].onclick = scrollsmooth_run;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            let mybody = document.getElementById("my-body");
            mybody.onscroll = scrollspy();
            scrollsmooth();
        }, false);

    </script>

    <title>Amin&apos;s resume</title>
</head>
<body id="my-body" data-spy="scroll" data-target="#side-menu" data-offset="75">

<div id="container">

    <div id="myrow">

        <div id="side-info" class="my-column">
            <?php echo $siteinfo; ?>
        </div>

        <div id="side-menu" class="my-column">
            <?php echo $sitemenu; ?>
        </div>

        <div id="content" class="my-column">
            <?php echo $sitecontent; ?>
        </div>

    </div>

</div>



</body>
</html>
