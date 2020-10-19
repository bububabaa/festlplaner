<div class="col">
    <div class="card">
        <?= $row['titel']?>
        <?php echo '<img height="150" width="200" src="data:image/jpeg;base64,'.base64_encode( $row['produktbild'] ).'"/>'; ?>
    <div class="card-body">
        <?= $row['beschreibung']?>
        <hr>
        <?= $row['preis']?>
    </div>
        <div class="card-footer">
        <a href="" class="btn btn-primary">Details</a>
        <a href="" class="btn btn-success">In den Warenkorb</a>
    </div>
    </div>
    </div>
