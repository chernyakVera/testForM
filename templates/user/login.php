<!--Шаблон с полями-формами для авторизации пользователя-->
<?php include __DIR__ . '/../header.php'?>

<!--<script src="https://code.jquery.com/jquery-3.6.1.min.js"-->
<!--        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>-->

<div style="text-align: center;">
    <h1>Авторизация</h1>

    <?php if(empty($_SESSION['name'])): ?>
    <form action="/users/login" method="post">
        <table align="center" class = 'register'>
            <tr>
                <td>Адрес эл.почты</td>
                <td>
                    <input type="text" name="email" class="email"
                           value="<?= $_POST['email'] ?? '' ?>">
                </td>
                <td>
                    <?php if(!empty($emailError)): ?>
                        <div style="background-color: crimson;"><?=$emailError ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td>
                    <input type="password" name="password" class="password"
                           value="<?= $_POST['password'] ?? '' ?>">
                </td>
                <td>
                    <?php if(!empty($passwordError)): ?>
                        <div style="background-color: crimson;"><?=$passwordError ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="logIn">Войти</button>
                </td>
            </tr>

        </table>
        </form>
<!--    <script>-->
<!--        $(document).ready(function () {-->
<!--            $('button.logIn').on('click', function() {-->
<!--                var emailValue = $('input.email').val();-->
<!--                var passwordValue = $('input.password').val();-->
<!---->
<!--                $.ajax({-->
<!--                    method: "POST",-->
<!--                    url: "/users/login",-->
<!--                    data: { email: emailValue, password: passwordValue }-->
<!--                })-->
<!--                    .done(function( msg) {-->
<!--                        let message = JSON.parse(msg);-->
<!--                        alert( "Data Saved: " + message.message );-->
<!--                    });-->
<!---->
<!--                $('input.email').val('');-->
<!--                $('input.password').val('');-->
<!--            })-->
<!--        });-->
<!--    </script>-->

    <?php endif;?>
</div>
<?php include __DIR__ . '/../footer.php'?>