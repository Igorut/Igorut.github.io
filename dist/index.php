<?php require_once 'App.php'; ?>
<html>
<head>
    <meta charset="utf-8">

    <style>
        table {
            font-size: 14px;
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background: #AFCDE7;
            color: white;
            padding: 10px 20px;
        }

        td {
            padding: 10px 20px;
        }

        th, td {
            border-style: solid;
            border-width: 0 1px 1px 0;
            border-color: white;
        }

        td {
            background: #D8E6F3;
        }
    </style>

</head>
<body>


<form action="" method="post">
    <div>
        <?php $buildBtn = new \App\App();
        $buildBtn->checkBuildBtn(); ?>
        <input type="number" name="number_of_builder" placeholder="Количество сотрудников для добавления в базу данных">
        <button name="build">Создать базу данных</button>
    </div>

    <div>
        <?php $responseButton = new \App\App();
        $information = $responseButton->checkGetResponse(); ?>
        <input type="number" name="number_of_staff" placeholder="Количесто сотрудников для вывода">
        <input type="submit" name="get_staff" value="Вывести сотрудников">
    </div>
</form>

<table>
    <tr>
        <th>Инициалы</th>
        <th>Фамилия</th>
        <th>Возраст</th>
        <th>Дата Рождения</th>
        <th>Отдел</th>
        <th>Руководитель отдела</th>
    </tr>
    <?php foreach ($information as $info): ?>
        <tr>
            <td><?php echo $info['initials'] ?></td>
            <td><?php echo $info['surname'] ?></td>
            <td><?php echo $info['age'] ?></td>
            <td><?php echo $info['date_of_birth'] ?></td>
            <td><?php echo $info['department_name'] ?></td>
            <td><?php if ($info['manager_name'] === $info['surname']) {
                    echo 'Является руководителем';
                } elseif (empty($info['manager_name'])) {
                    echo 'Руководителя нет';
                } else {
                    echo $info['manager_name'];
                }
                ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>