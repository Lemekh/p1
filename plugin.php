<?php

// ���������� ����������� �����
require_once 'form.php';
require_once 'matrix.php';

// ���������� ����� �������
class MyPlugin {

    // ����������� �������
    public function __construct() {

        // ������������ �������, ������� ����� ���������� ��� ��������� �������
        register_activation_hook(__FILE__, array($this, 'activate'));

        // ������������ �������, ������� ����� ���������� ��� ����������� �������
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        // ������������ �������, ������� ����� ���������� ��� ������������� �������
        add_action('init', array($this, 'init'));
    }

    // �������, ������� ����������� ��� ��������� �������
    public function activate() {

        // ������� ������� ��� �������� ������ �����
        $this->create_table();
    }

    // �������, ������� ����������� ��� ����������� �������
    public function deactivate() {

        // ������� ������� ��� �������� ������ �����
        $this->delete_table();
    }

    // �������, ������� ����������� ��� ������������� �������
    public function init() {

        // ��������� ���������� ������� submit ��� �����
        add_action('submit_my_form', array($this, 'submit_form'));
    }

    // �������, ������� ������������ ������� submit ��� �����
    public function submit_form() {

        // �������� ������ �� �����
        $data = $_POST['data'];

        // ��������� ������ � �������
        $this->save_data($data);

        // ������������ ������������� �������
        $matrix = $this->calculate_matrix($data);

        // ������� ������������� �������
        echo $matrix;
    }

    // ������� ��� �������� �������
    private function create_table() {

        // ������� ������� � ������ `my_plugin_data`
        $sql = "CREATE TABLE `my_plugin_data` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `data` text NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        // ��������� ������ � ���� ������
        dbDelta($sql);
    }

    // ������� ��� �������� �������
    private function delete_table() {

        // ������� ������� � ������ `my_plugin_data`
        $sql = "DROP TABLE IF EXISTS `my_plugin_data`;";

        // ��������� ������ � ���� ������
        dbDelta($sql);
    }

    // ������� ��� ���������� ������ � �������
    private function save_data($data) {

        // �������� ������� ���� � �����
        $created_at = date('Y-m-d H:i:s');

        // ��������� ������ � ���� ������ ��� ���������� ������
        $sql = "INSERT INTO `my_plugin_data` (data, created_at) VALUES ('{$data}', '{$created_at}');";

        // ��������� ������ � ���� ������
        mysqli_query($GLOBALS['wpdb'], $sql);
    }

    // ������� ��� ������� ������������� �������
    private function calculate_matrix($data) {

        // ����������� ������ �� ����� � ������
        $data = json_decode($data, true);

        // �������� ������ ������������ �������� �� ������� �������
        $max_values = $this->get_max_values($data);

        // ������������ ������������� �������
        $matrix = array();
        for ($i = 0; $i < 3; $i++)