<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Er zijn <strong>foutmeldingen</strong> gevonden:

        <ul>
            <?php foreach ($errors as $melding): ?>
                <li><?php print $melding ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif ?>
