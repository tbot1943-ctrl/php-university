<?php
$students = [
    ["Абдуллаева", "Айтегин Рустамовна", 19],
    ["Азимов", "Темирлан Эсеналиевич", 19],
    ["Айдарова", "Айдана Максаттовна", 19],
    ["Акбай кызы", "Айзада", 19],
    ["Алиев", "Рафаэль Чынгызович", 19],
    ["Аскарбекова", "Малика Аскарбековна", 19],
    ["Борбуева", "Шекер Калдаровна", 19],
    ["Джапарова", "Алия Джолдошевна", 19],
    ["Кадырбеков", "Фархат Азаматович", 19],
    ["Канатбекова", "Гулдана Канатбековна", 19],
    ["Кубанычбек уулу", "Элмир", 19],
    ["Кубанычбекова", "Элина Кубанычбековна", 19],
    ["Кыдырбеков", "Канимет Урматович", 19],
    ["Мавлянова", "Айдана Баялыевна", 19],
    ["Масалбекова", "Ширин Уланбековна", 19],
    ["Токтошов", "Нурбол Бактыбайович", 19],
    ["Шадыбекова", "Назгүл Жаңыбаевна", 19],
    ["Шарипова", "Жибек Шариповна", 19],
    ["Ысак", "Эмир", 19],
    ["Эдилбекова", "Санирабига", 19],
];

$file = 'data.json';


$json = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

if ($json) {
    foreach ($json as $s) {
        $students[] = [$s['name'], $s['surname'], $s['age']];
    }
}

// удаление
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Удаление
    if (isset($_POST['delete'])) {
        $index = (int)$_POST['delete'];

        if (file_exists($file)) {
            $json = json_decode(file_get_contents($file), true);
            unset($json[$index]);
            $json = array_values($json);

            file_put_contents($file, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }
 // Добавление
    if (!empty($_POST['name']) && !empty($_POST['surname'])) {
        $newStudent = [
            "name" => $_POST['name'],
            "surname" => $_POST['surname'],
            "age" => (int)$_POST['age']
        ];

        $json = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $json[] = $newStudent;

        file_put_contents($file, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    header("Location: index.php");
    exit;
}

// Поиск
$search = $_GET['search'] ?? '';

$filteredStudents = array_filter($students, function ($s) use ($search) {
    return $search === '' || mb_stripos($s[0], $search) !== false;
});
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Студенты ИСТ(б)-1-24</title>
    <style>
        body { font-family: Arial; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        form { margin-bottom: 10px; }
        input { padding: 5px; }
        button { padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>

<h2>Добавить студента</h2>
<form method="post">
    <input type="text" name="name" placeholder="Фамилия" required>
    <input type="text" name="surname" placeholder="Имя Отчество" required>
    <input type="number" name="age" value="19" required>
    <button type="submit">Добавить</button>
</form>

<h2>Поиск</h2>
<form method="get">
    <input type="text" name="search" placeholder="Поиск по фамилии" value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Найти</button>
</form>

<h2>Таблица студентов</h2>
<table>
    <tr>
        <th>Фамилия</th>
        <th>Имя Отчество</th>
        <th>Возраст</th>
        <th>Группа</th>
        <th>Действие</th>
    </tr>

    <?php foreach ($filteredStudents as $index => $student): ?>
        <tr>
            <td><?= htmlspecialchars($student[0]) ?></td>
            <td><?= htmlspecialchars($student[1]) ?></td>
            <td><?= $student[2] ?></td>
            <td>ИСТ(б)-1-24</td>
            <td>
                <?php if ($index >= 20): ?>
                    <form method="post" style="display:inline;">
                        <button name="delete" value="<?= $index - 20 ?>">Удалить</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
