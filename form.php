<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>����� ����� ������</title>
</head>
<body>

<h1>����� ����� ������</h1>

<form action="<?php echo get_site_url(); ?>?page_id=123" method="post">

    <table>
        <tr>
            <td>������ 1</td>
            <td><input type="text" name="data[1][1]" placeholder="�������� 1.1"></td>
            <td><input type="text" name="data[1][2]" placeholder="�������� 1.2"></td>
            <td><input type="text" name="data[1][3]" placeholder="�������� 1.3"></td>
        </tr>
        <tr>
            <td>������ 2</td>
            <td><input type="text" name="data[2][1]" placeholder="�������� 2.1"></td>
            <td><input type="text" name="data[2][2]" placeholder="�������� 2.2"></td>
            <td><input type="text" name="data[2][3]" placeholder="�������� 2.3"></td>
        </tr>
        <tr>
            <td>������ 3</td>
            <td><input type="text" name="data[3][1]" placeholder="�������� 3.1"></td>
            <td><input type="text" name="data[3][2]" placeholder="�������� 3.2"></td>
            <td><input type="text" name="data[3][3]" placeholder="�������� 3.3"></td>
        </tr>
    </table>

    <input type="submit" value="���������">

</form>

</body>
</html>