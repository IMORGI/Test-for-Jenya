<?php //начало кода PHP

$data = [ //Создал Массив data
    "login" => $_POST['login'], // имя login значение post login
    "name" => $_POST['name'], //всё таким же образом
    "fraction" => $_POST['fraction'], // аналагично первому
];

//Записываем данные в базу данных
$connection = new PDO('mysql:host=localhost;dbname=magic','root',''); // соединение с базой данных
$sql = 'INSERT INTO users (login, name, fraction) VALUES (:login, :name, :fraction)'; //подготовка sql кода, INSERT INTO  добавление данных в таблицу users, данных по меткам
$statement = $connection->prepare($sql); //Prepare подготавливает SQL выражение к выполнению, потом записываем результат в переменную $statement
$result = $statement->execute($data); //Execute выполняет подготовленное утверждениепередаем данные в функцию execute

//Считываем данные из базы данных

$con = mysqli_connect('localhost','root','','magic'); // соединение с базой данных
$sql="SELECT * FROM users"; //подготовка sql кода, выбираем всё из таблицы users
$result = mysqli_query($con,$sql); // записываем в result данные из mysql

echo "<table width='100%' border='1'>  <!--эхо выводит контейнер таблицы с шириной 100% и рамкой-->
<tr> <!--контейнер для создания таблицы-->
<th>ID</th>  <!--создание ячейки таблицы, заголовок-->
<th>Логин</th> <!--всё тоже самое-->
<th>Имя персонажа</th> <!--аналогично-->
<th>Фракция</th> <!--так же как в первом-->
<th>Действия</th> <!--подобно предыдущим-->
</tr>";  //<!--закрытие контейнера-->
while($row = mysqli_fetch_array($result)) { // заполнение таблицы данными
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['login'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['fraction'] . "</td>";
    echo "<td> <input  type='button' class='add' name='add' value='Добавить' '>  <!--На эту кнопку назначить создание новой строки в бд-->
               <input  type='button' class='update' name='update' value='Редактировать' '>  <!--На эту кнопку назначить редактирование существующей строки в бд-->
               <input  type='button' class='delete' name='delete' value='Удалить' onclick='deleteRow(this)'> <!--На эту кнопку назначить удаление строки в бд-->
          </td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con); // закрытие соединения с базой данных

