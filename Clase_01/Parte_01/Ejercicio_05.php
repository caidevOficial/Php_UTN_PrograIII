<?php
    /**
     * Aplicación Nº 5 (Números en letras)
     * Realizar un programa que en base al valor numérico de 
     * una variable $ num , pueda mostrarse por pantalla, el 
     * nombre del número que tenga dentro escrito con palabras, 
     * para los númerosentre el 20 y el 60.
     * Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.
     *
     * Facundo Falcone
     */

    /**
     * Gets the number in words as a prefix.
     * @param int $number number to obtain the word.
     * @return string The number converted to a word.
     */
    function getPrefix($num){
        $prefix = "";
        switch ($num) {
            case 1:
                $prefix = "diez";
                break;
            case 2:
                $prefix = "veinte";
                break;
            case 3:
                $prefix = "treinta";
                break;
            case 4:
                $prefix = "cuarenta";
                break;
            case 5:
                $prefix = "cincuenta";
                break;
            case 6:
                $prefix = "sesenta";
                break;
        }

        return $prefix;
    }

    /**
     * Gets the number in words as a suffix.
     * @param int $number number to obtain the word.
     * @return string The number converted to a word.
     */
    function getSuffix($original, $amount) {
        $suffix = "";
        $result = $original - $amount*10;
        switch ($result) {
            case 1:
                $suffix = "uno.";
                break;
            case 2:
                $suffix = "dos.";
                break;
            case 3:
                $suffix = "tres.";
                break;
            case 4:
                $suffix = "cuatro.";
                break;
            case 5:
                $suffix = "cinco.";
                break;
            case 6:
                $suffix = "seis.";
                break;
            case 7:
                $suffix = "siete.";
                break;
            case 8:
                $suffix = "ocho.";
                break;
            case 9:
                $suffix = "nueve.";
                break;
        }

        return $suffix;
    }

    /**
     * Gets the value of the number as a string.
     * @param int $number number to obtain the word.
     * @return string The number converted to a word.
     * 
     * @see getPrefix()
     * @see getSuffix()
     */
    function getFullNumberAsString($numberToString, $amount, $prefix) {
        $numberInString = "";
        //TODO: implementar y contemplar los casos entre 21 y 29.
        if ($numberToString % 10 == 0) {
            $numberInString = $prefix;
        } else {
            $suffix = getSuffix($numberToString, $amount);
            if($numberToString > 20 && $numberToString < 30) {
                $prefix = "veinti";
                $numberInString = $prefix.$suffix;
            }else{
                $numberInString = $prefix." y ".$suffix;
            }
        }
        return $numberInString;
    }

    function num2words($num) {
        $original = $num;
        $amount = 0;
        $prefix = "";
        if ($original >= 20 && $original <= 60) {
            while ($num - 10 >= 0) {
                $amount++;
                $num -= 10;
            }
    
            $prefix = getPrefix($amount);
            $numberInString = getFullNumberAsString($original, $amount, $prefix);
            printf("Number: ".$numberInString);
        }
    }

    num2words(26);
?>