<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        table {
            border-collapse: collapse;
            border-top: 6px solid gold;
            border-left: 6px solid gold;
        }

        td {
            width: 40px;
            height: 40px;
            border: 1px solid black;
        }

        .black {
            background-color: black;
        }

        .white {
            background-color: white;
        }
    </style>
</head>
<body>

<form method="post">
    <label>Введите размер доски:</label>
    <input type="number" name="size">
    <button type="submit">Показать</button>
</form>

<?php
if (isset($_POST['size'])) {
    $n = intval($_POST['size']);

    echo "<table border='1'>";

    for ($i = 0; $i < $n; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $n; $j++) {
            $color = (($i + $j) % 2 == 0) ? "white" : "black";
            echo "<td class='$color'></td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}
?>

</body>
</html>
