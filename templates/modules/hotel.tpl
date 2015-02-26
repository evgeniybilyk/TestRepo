<table class="table table-bordered">
    <tr>
        <th>Номер</th>
        <th>Фото</th>
        <th>Тип</th>
        <th>Кол. окон</th>
        <th>Цена</th>
        <th>Описание</th>
        <th colspan="2">Бронирование</th>
    </tr>
    {foreach from=$allRooms key=key item=item}
        <tr>
            <td>{$item["num"]}</td>
            <td><img src="{$CONFIG_UPLOAD_DIR}{$item["photo"]}" alt=""></td>
            <td>{$item["type"]}</td>
            <td>{$item["col_windows"]}</td>
            <td>{$item["price"]}</td>
            <td>{$item["descr"]}</td>
            <td>
                <input id="date_order_{$item["num"]}" class="datepicker" type="text" name="date_order">
            </td>
            <td>
                <input type="button" value="Забронировать" onclick="checkOrder({$item["num"]})">
            </td>
        </tr>
    {/foreach}
</table>

<script>

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});

function checkOrder(num_room)
{
    var date_order = $('#date_order_'+num_room).val();
    if(date_order != '') {
        $.post( "ajax/checkRoom.php", { num_room: num_room, date_order: date_order }, function( data ) {
            if(data == "success") {
                alert("Номер " + num_room + " успешно забронирован на " + date_order + " число");
            } else if(data == "reserved") {
                alert("Номер " + num_room + " УЖЕ ЗАНЯТ на " + date_order + " число");
            } else {
                alert(data);
            }
        });
    } else {
        alert('Выберите дату бронирования номера ' + num_room);
    }
}
</script>