
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href= "/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header"><?=$title ?? 'Тестовое задание' ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">

            <?php if(!empty($_SESSION['name'])):?>
                Hello, <?= $_SESSION['name'] ?> | <a href="http://chernyakproject.loc/users/logout">Выйти</a>
            <?php else:?>
                <a href="http://chernyakproject.loc/users/login">Войдите на сайт</a> | <a href="http://chernyakproject.loc">Зарегистрироваться</a>
            <?php endif;?>

        </td>
    </tr>
    <tr>
        <td>