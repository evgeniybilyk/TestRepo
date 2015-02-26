<form action="admin.php?page={$page}&act={$act}" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th colspan="6" align="center">Добавить комнату:</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><label>Номер <input type="text" name="num" value="{$updRoom["num"]}" {if $updRoom["num"] > 0}readonly="readonly"{/if}></label></td>
            <td><label>Фото <input type="file" name="photo"></label></td>
            <td><label>Тип <input type="text" name="type" value="{$updRoom["type"]}"></label></td>
            <td><label>Кол. окон <input type="text" name="col_windows" value="{$updRoom["col_windows"]}"></label></td>
            <td><label>Цена <input type="text" name="price" value="{$updRoom["price"]}"></label></td>
            <td><label>Описание <input type="text" name="descr" value="{$updRoom["descr"]}"></label></td>
        </tr>
        <tr>
            <td colspan="6" align="center"><input type="submit" name="subb" VALUE="Сохранить"></td>
        </tr>
        </tbody>
</form>

<br>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Номер</th>
        <th>Фото</th>
        <th>Тип</th>
        <th>Кол. окон</th>
        <th>Цена</th>
        <th>Описание</th>
        <th>События</th>
    </tr>
    </thead>
    {foreach from=$allRooms key=key item=item}
        <tr>
            <td>{$item["num"]}</td>
            <td><img src="{$CONFIG_UPLOAD_DIR}{$item["photo"]}" alt=""></td>
            <td>{$item["type"]}</td>
            <td>{$item["col_windows"]}</td>
            <td>{$item["price"]}</td>
            <td>{$item["descr"]}</td>
            <td>
                <a href="admin.php?page={$page}&act=upd&num={$item["num"]}">update</a>
                <a href="admin.php?page={$page}&act=del&num={$item["num"]}">delete</a>
            </td>
        </tr>
    {/foreach}
</table>