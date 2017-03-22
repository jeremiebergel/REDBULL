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