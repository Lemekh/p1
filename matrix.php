<?php

function get_max_values($data) {

    // ������� ������ ������������ �������� �� ������� �������
    $max_values = array();
    for ($i = 0; $i < 3; $i++) {
        $max_values[$i] = array_max($data[$i]);
    }

    return $max_values;
}

function calculate_matrix($data) {

    // ����������� ������ �� ����� � ������
    $data = json_decode($data, true);

    // �������� ������ ������������ �������� �� ������� �������
    $max_values = get_max_values($data);

    // ������������ ������������� �������
    $matrix = array();
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $matrix[$i][$j] = $data[$i][$j] / $max_values[$j];
        }
    }

    return $matrix;
}