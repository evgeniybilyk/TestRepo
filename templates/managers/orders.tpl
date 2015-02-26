<table class="table table-bordered">
    <thead>
    <tr>
        <th>Номер</th>
        <th>Тип</th>
        <th>Кол. окон</th>
        <th>Цена</th>
        <th>Описание</th>
        <th>Дата заказа</th>
    </tr>
    </thead>
    {foreach from=$allOrderRooms key=key item=item}
        <tr>
            <td>{$item["num_room"]}</td>
            <td>{$item["type"]}</td>
            <td>{$item["col_windows"]}</td>
            <td>{$item["price"]}</td>
            <td>{$item["descr"]}</td>
            <td>{$item["date_order"]}</td>
        </tr>
    {/foreach}
</table>