
<?php include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'header.php'?>

<div style="text-align: center;">
    <h1>Авторизация</h1>

    <?php if(empty($_SESSION['name'])): ?>
    <form method="post" id="formLogIn">
        <table align="center" class = 'register'>
            <tr>
                <td>Логин</td>
                <td>
                    <input type="text" name="login" class="login"
                           value="<?= $_POST['login'] ?? '' ?>">
                </td>
                <td>
                    <div style="background-color: crimson;">
                        <span id="loginError"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td>
                    <input type="password" name="password" class="password"
                           value="<?= $_POST['password'] ?? '' ?>">
                </td>
                <td>
                    <div style="background-color: crimson;">
                        <span id="passwordError"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" name="Submit" value="Войти" onclick="submitLogInForm()">
                </td>
            </tr>

        </table>
        </form>

    <?php endif;?>
</div>
<?php include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'footer.php'?>