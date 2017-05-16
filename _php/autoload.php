<?php

// autoload all classes
spl_autoload_register(
    function ( $class_name )
    {
        include '../../_classes/' . $class_name . '.php';
    }
);