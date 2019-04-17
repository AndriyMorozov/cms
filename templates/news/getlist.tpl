<h2>My table</h2>
<table border="1">
    <? foreach ($list as $key => $row) : ?>
    <tr>
        <td><?=$row['id'] ?></td>
        <td><?=$row['title'] ?></td>
        <td><?=$row['text'] ?></td>
        <td><?=$row['date'] ?></td>
    </tr>
    <? endforeach; ?>
</table>