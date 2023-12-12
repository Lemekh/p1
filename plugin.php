<?php

// Подключаем необходимые файлы
require_once 'form.php';
require_once 'matrix.php';

// Определяем класс плагина
class MyPlugin {

    // Конструктор плагина
    public function __construct() {

        // Регистрируем функцию, которая будет вызываться при активации плагина
        register_activation_hook(__FILE__, array($this, 'activate'));

        // Регистрируем функцию, которая будет вызываться при деактивации плагина
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        // Регистрируем функцию, которая будет вызываться при инициализации плагина
        add_action('init', array($this, 'init'));
    }

    // Функция, которая выполняется при активации плагина
    public function activate() {

        // Создаем таблицу для хранения данных формы
        $this->create_table();
    }

    // Функция, которая выполняется при деактивации плагина
    public function deactivate() {

        // Удаляем таблицу для хранения данных формы
        $this->delete_table();
    }

    // Функция, которая выполняется при инициализации плагина
    public function init() {

        // Добавляем обработчик события submit для формы
        add_action('submit_my_form', array($this, 'submit_form'));
    }

    // Функция, которая обрабатывает событие submit для формы
    public function submit_form() {

        // Получаем данные из формы
        $data = $_POST['data'];

        // Сохраняем данные в таблицу
        $this->save_data($data);

        // Рассчитываем нормированную матрицу
        $matrix = $this->calculate_matrix($data);

        // Выводим нормированную матрицу
        echo $matrix;
    }

    // Функция для создания таблицы
    private function create_table() {

        // Создаем таблицу с именем `my_plugin_data`
        $sql = "CREATE TABLE `my_plugin_data` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `data` text NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        // Выполняем запрос к базе данных
        dbDelta($sql);
    }

    // Функция для удаления таблицы
    private function delete_table() {

        // Удаляем таблицу с именем `my_plugin_data`
        $sql = "DROP TABLE IF EXISTS `my_plugin_data`;";

        // Выполняем запрос к базе данных
        dbDelta($sql);
    }

    // Функция для сохранения данных в таблицу
    private function save_data($data) {

        // Получаем текущую дату и время
        $created_at = date('Y-m-d H:i:s');

        // Выполняем запрос к базе данных для сохранения данных
        $sql = "INSERT INTO `my_plugin_data` (data, created_at) VALUES ('{$data}', '{$created_at}');";

        // Выполняем запрос к базе данных
        mysqli_query($GLOBALS['wpdb'], $sql);
    }

    // Функция для расчета нормированной матрицы
    private function calculate_matrix($data) {

        // Преобразуем данные из формы в массив
        $data = json_decode($data, true);

        // Получаем массив максимальных значений по каждому столбцу
        $max_values = $this->get_max_values($data);

        // Рассчитываем нормированную матрицу
        $matrix = array();
        for ($i = 0; $i < 3; $i++)