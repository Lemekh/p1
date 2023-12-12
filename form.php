<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма ввода данных</title>
</head>
<body>

<h1>Форма ввода данных</h1>

<form action="<?php echo get_site_url(); ?>?page_id=123" method="post">

    <table>
        <tr>
            <td>Строка 1</td>
            <td><input type="text" name="data[1][1]" placeholder="Значение 1.1"></td>
            <td><input type="text" name="data[1][2]" placeholder="Значение 1.2"></td>
            <td><input type="text" name="data[1][3]" placeholder="Значение 1.3"></td>
        </tr>
        <tr>
            <td>Строка 2</td>
            <td><input type="text" name="data[2][1]" placeholder="Значение 2.1"></td>
            <td><input type="text" name="data[2][2]" placeholder="Значение 2.2"></td>
            <td><input type="text" name="data[2][3]" placeholder="Значение 2.3"></td>
        </tr>
        <tr>
            <td>Строка 3</td>
            <td><input type="text" name="data[3][1]" placeholder="Значение 3.1"></td>
            <td><input type="text" name="data[3][2]" placeholder="Значение 3.2"></td>
            <td><input type="text" name="data[3][3]" placeholder="Значение 3.3"></td>
        </tr>
    </table>

    <input type="submit" value="Отправить">

</form>

</body>
</html>