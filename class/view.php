<?php


class View
{
    private $layout = [];

    public function render($data)
    {
        preg_match('/\.[0-9a-z]+$/', $data['file'], $matches);
        if (in_array('.html', $matches)) {
            readfile('views/' . $data['file']);
        } elseif (in_array('.php', $matches)) {
            $vars = [];
            if (isset($data['vars']) && !empty($data['vars'])) {
                $vars = $data['vars'];
            }
            $filename = 'views/' . $data['file'];
            if (file_exists($filename)) {
                $this->setTemplate($filename, $vars);
            } else {
                $this->set404Page();
            }
        }

    }

    public function set404Page()
    {
        header("HTTP/1.0 404 Not Found");
        require('views/404.php');
        exit();
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    private function setTemplate($template, $vars = [])
    {
        extract($vars);
        require('views/layouts/'.$this->layout['header']['file']);
        require($template);
        require('views/layouts/'.$this->layout['footer']['file']);
        clearstatcache();
    }

}