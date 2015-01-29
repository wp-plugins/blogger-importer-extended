<?php

    class BIETemplate
    {
        const DIR = 'templates';

        public function render($template, $context = array())
        {
            $dir = BIE_DIR . '/' . self::DIR;
            $file = $dir . '/' . $template . '.php';

            if(dirname($file) != $dir) {
                die();
            }

            extract($context);

            include($file);
        }
    }

