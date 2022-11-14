<!--Шаблон страницы регистрации-->
<?php include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'header.php'; ?>

<div style="text-align: center" class="container">
    <h1>Регистрация</h1>

    <?php if(empty($_SESSION['name'])): ?>
    <form method="post" id="formRegister">
        <table border="0" align="center" class = 'register'>
            <tr >
                <td align="right">Логин</td>
                <td align="left">
                    <input type="text" name="login" class="login" value="<?= $_POST['login'] ?? '' ?>">
                </td>

                <td>
                    <div style="background-color: crimson;" >
                        <span id="loginError"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="right">Пароль</td>
                <td align="left">
                    <input type="password" name="password" class="password" value="<?=$_POST['password'] ?? '' ?>">
                </td>
                <td>
                    <div style="background-color: crimson;" >
                        <span id="passwordError"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="right">Подтверждение пароля</td>
                <td align="left">
                    <input type="password" name="confirmPassword" class="confirmPassword" value="<?=$_POST['confirmPassword'] ?? '' ?>">
                </td>
                <td>
                    <div style="background-color: crimson;" >
                        <span id="confirmPasswordError"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="right">Эл. почта</td>
                <td align="left">
                    <input type="text" name="email" class="email" value="<?= $_POST['email'] ?? '' ?>">
                </td>
                <td>
                    <div style="background-color: crimson;" >
                        <span id="emailError"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="right">Имя</td>
                <td align="left">
                    <input type="text" name="name" class="name" value="<?= $_POST['name'] ?? '' ?>">
                </td>
                <td>
                        <div style="background-color: crimson;" >
                            <span id="nameError"></span>
                        </div>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="button" name="Submit" value="Зерегистрироваться" onclick="submitRegistrationForm()">
                </td>
            </tr>
        </table>
    </form>
    <?php endif; ?>

</div>

<?php include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'footer.php'; ?>
