<!--Шаблон страницы регистрации-->
<?php include __DIR__ . '/../header.php'; ?>

<!--<script src="https://code.jquery.com/jquery-3.6.1.min.js"-->
<!--        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>-->

<div style="text-align: center" class="container">
    <h1>Регистрация</h1>

    <?php if(empty($_SESSION['name'])): ?>
    <form action="/" method="post">
        <table border="0" align="center" class = 'register'>
            <tr >
                <td align="right">Логин</td>
                <td align="left">
                    <input type="text" name="login" class="login" value="<?= $_POST['login'] ?? '' ?>">
                </td>
                <td>
                    <?php if (!empty($loginError)): ?>
                        <div style="background-color: crimson;"><?= $loginError ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td align="right">Пароль</td>
                <td align="left">
                    <input type="password" name="password" class="password" value="<?=$_POST['password'] ?? '' ?>">
                </td>
                <td>
                    <?php if (!empty($passwordError)): ?>
                        <div style="background-color: crimson;"><?= $passwordError ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td align="right">Подтверждение пароля</td>
                <td align="left">
                    <input type="password" name="confirmPassword" class="confirmPassword" value="<?=$_POST['confirmPassword'] ?? '' ?>">
                </td>
                <td>
                    <?php if (!empty($confirmPasswordError)): ?>
                        <div style="background-color: crimson;"><?= $confirmPasswordError ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td align="right">Эл. почта</td>
                <td align="left">
                    <input type="text" name="email" class="email" value="<?= $_POST['email'] ?? '' ?>">
                </td>
                <td>
                    <?php if (!empty($emailError)): ?>
                        <div style="background-color: crimson;"><?= $emailError ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td align="right">Имя</td>
                <td align="left">
                    <input type="text" name="name" class="name" value="<?= $_POST['name'] ?? '' ?>">
                </td>
                <td>
                    <?php if (!empty($nameError)): ?>
                        <div style="background-color: crimson;"><?= $nameError ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <button class="register">Зарегистрироваться</button>
                </td>
            </tr>
        </table>
    </form>

<!--        <script>-->
<!--            $(document).ready(function () {-->
<!--                $('button.register').on('click', function() {-->
<!--                    var loginValue = $('input.login').val();-->
<!--                    var passwordValue = $('input.password').val();-->
<!--                    var confirmPasswordValue = $('input.confirmPassword').val();-->
<!--                    var emailValue = $('input.email').val();-->
<!--                    var nameValue = $('input.name').val();-->
<!---->
<!---->
<!--                    $.ajax({-->
<!--                        method: "POST",-->
<!--                        url: "/",-->
<!--                        data: { login: loginValue,-->
<!--                            password: passwordValue,-->
<!--                            confirmPassword: confirmPasswordValue,-->
<!--                            email: emailValue,-->
<!--                            name: nameValue}-->
<!--                    })-->
<!--                        .done(function( ) {-->
<!--                            alert( "Data Saved: " + msg );-->
<!--                        });-->
<!---->
<!--                    $('input.login').val('');-->
<!--                    $('input.password').val('');-->
<!--                    $('input.confirmPassword').val('');-->
<!--                    $('input.email').val('');-->
<!--                    $('input.name').val('');-->
<!--                })-->
<!--            });-->
<!--        </script>-->

    <?php endif; ?>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
