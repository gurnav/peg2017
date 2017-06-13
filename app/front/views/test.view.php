<?php var_dump($messages); ?>

<?php foreach ($messages as $key => $obj): ?>
    <p><?php echo $obj["content"] ?></p>
    <?php foreach ($obj as $id => $data): ?>
        <p><?php echo $id." => ".$data ?></p>
    <?php endforeach ?>
<?php endforeach ?>
