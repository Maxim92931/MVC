<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scraps</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
</head>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">MVC</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/">Авторизация</a></li>
                    <li><a href="reg">Регистрация</a></li>
                    <li class="active"><a href="adminPanel">Админ панель</a></li>
                    <li><a href="logout">Выход</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="users">
        <h2>Пользователи</h2>
        <table border="1px" cellspacing="0">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Description</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo $user['name'] ?></td>
                        <td><?php echo $user['age']; if ($user['age'] > 18) echo ' - совершеннолетний';
                        else echo ' - несовершеннолетний'?></td>
                        <td><?php echo $user['description'] ?></td>
                        <td><?php echo $user['photo'] ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <div class="files">
        <h2>Все файлы</h2>
        <table border="1px" cellspacing="0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $file) : ?>
                    <tr>
                        <td><?php echo $file['id'] ?></td>
                        <td><?php echo $file['name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="addFile">
        <h2>Загрузить файл</h2>
        <form enctype="multipart/form-data">
            <input type="file" id="file" name="file" accept="image/jpeg, image/png">
            <button id="addFile">Загрузить</button>
        </form>
    </div>

    <div class="setAvatar">
        <h2>Установить аватар</h2>
        <select id="chooseUser">
            <?php foreach ($users as $user) : ?>
                <option value="<?php echo $user['id']?>"><?php echo $user['name'] ?></option>
            <?php endforeach; ?>

            <input type="file" id="avatar" name="avatar" accept="image/jpeg, image/png">
            <button id="setAvatar">Установить аватар</button>
        </select>
    </div>

    <div class="createUser">
        <h2>Создать пользователя</h2>

        <form class="form-horizontal" id="createUser">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" name="login" class="form-control" id="inputEmail3" placeholder="Логин">
                    <p class="checkLogin"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Пароль">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">Пароль (Повтор)</label>
                <div class="col-sm-10">
                    <input type="password" name="passwordRetry" class="form-control" id="inputPassword4" placeholder="Пароль">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button id="reg" class="btn btn-default" disabled>Создать</button>
            </div>
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>

