<form class="form" enctype="multipart/form-data" action="/form/sendform/" method="post">
    <p>
        <label for="name">Имя</label>
        <input id="name" type="text" name="name"/>
    </p>
    <p>
        <label for="surname">Фамилия</label>
        <input id="surname" type="text" name="surname"/>
    </p>
    <p>
        <label for="phone">Номер телефона</label>
        <input id="phone" type="text" name="phone"/>
    </p>
    <p>
        <input type="hidden" name="MAX_FILE_SIZE" value="300000"/>
        <label for="file">Отправить файл</label>
        <input id="file" name="file" type="file"/>
    </p>
    <p>
        <input type="submit" value="Отправить форму">
    </p>
</form>