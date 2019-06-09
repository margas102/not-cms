<?php


class index
{
    private $data = [],
            $page_data = [],
            $log,
            $view;
    public $layouts = [];

    public function __construct()
    {
        $this->log = fopen('log.txt', 'a+');
        $this->data = (array)json_decode(file_get_contents('data/url.json'), true);
        $this->view = new View();
        $this->view->setLayout($this->data['layouts']);
    }

    public function route()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $this->getTemplateInfo($_SERVER['REQUEST_URI']);
        if ($uri[1] == 'form' && !empty($uri[2])) {
            if (empty($_POST)) {
                $this->view->set404Page();
            }
            $this->getFormData();
        }
        $this->view->render($this->page_data);
        return true;
    }

    private function getTemplateInfo($uri)
    {
        if (array_key_exists($uri, $this->data['routes'])) {
            $this->page_data = $this->data['routes'][$uri];
        } else {
            $this->view->set404Page();
        }
        return true;
    }

    private function getFormData()
    {
        $to      = 'margasov.mikhail@gmail.com';
        $subject = (isset($_POST['form_name'])) ? $_POST['form_name'] : 'Получена форма с сайта';
        $text = '';
        foreach ($_POST as $key=>$item) {
            $text .= '<p><strong>' . $key . '</strong>' . ' : ' . $item . '</p>';
        }

        //Дано начало для загрузки файлов
        if (!empty($_FILES)) {
            $dir = ROOT . '/uploads/';
            $file = $dir . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
                $text .= '<p><strong>Прикрепленный файл: <a href="http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . basename($_FILES['file']['name']) . '">Ссылка</a></strong></p>';
            } else {
                $text .= "Произошла ошибка загруззки файла";
            }
        }

        $headers = "From: info@tooly.ru" . "\r\n";
        $headers .= "Reply-To: info@tooly.ru". "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        if (mail($to, $subject, $text, $headers)) {
            $this->page_data['file'] = 'success_form.php';
        } else {
            $this->page_data['file'] = 'failed_form.php';
        }
        return true;
    }

}