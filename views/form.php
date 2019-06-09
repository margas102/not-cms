<form class="form" enctype="multipart/form-data" action="/form/sendform/" method="post">
    <p>
        <label for="name">Имя</label>
        <input id="name" type="text" name="name" data-required="true"/>
    </p>
    <p>
        <label for="surname">Фамилия</label>
        <input id="surname" type="text" name="surname" data-required="true"/>
    </p>
    <p>
        <label for="phone">Номер телефона</label>
        <input id="phone" type="text" name="phone" data-required="true"/>
    </p>
    <p>
        <input type="hidden" name="form_name" value="Базовая форма на сайте">
        <label for="file">Отправить файл</label>
        <input id="file" name="file" type="file"/>
    </p>
    <p>
        <input type="submit" value="Отправить форму">
    </p>
</form>
<script>
    $('.form').submit(function () {     // Тут вместо .form надо поставить свой класс или id (напрмер #form)
        var errors = 0;
        $(this).find('input[data-required]').each(function (i, el) {
            var value = $(el).val();
            if (value === '') {
                $(el).addClass('error');
                errors++;
            } else {
                $(el).removeClass('error');
            }

        });
        if (errors > 0) {
            return false;
        }
    })
</script>

<style>
    .error {
        border-color: red;
    }
</style>