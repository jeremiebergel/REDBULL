<?php

        function debug($variable){
        // affiche une balise pre et print_r
         echo '<pre>' . print_r($variable, true) . '</pre>';
         };

        function str_random($lengh){
            $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
            //
            return substr(str_shuffle(str_repeat($alphabet, $lengh)), 0, $lengh);
        };


        function only_connected_people(){
            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }

            if(!isset($_SESSION['authentification'])){

                $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
                header('Location: login.php');
                exit();
            }

        }