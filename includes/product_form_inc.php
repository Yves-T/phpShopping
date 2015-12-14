
<form action="" method="post">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" class="form-control" name="name" id="name"
                       value="<?php print (isset($data['name']) ? $data['name'] : ''); ?>">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="description">Omschrijving</label>
                <textarea class="form-control" name="description"
                          id="description"><?php print (isset($data['description']) ? $data['description'] : ''); ?></textarea>
                <script>
                    CKEDITOR.replace('description', {
                            filebrowserBrowseUrl: 'lib/Filemanager/index.html',
                            filebrowserWindowWidth: '640',
                            filebrowserWindowHeight: '480'
                        }
                    );
                </script>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Afbeelding</label> <br>
                <input type="text" class="form-control" name="image" id="image"
                       value="<?php print (isset($data['image']) ? $data['image'] : ''); ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="category">Categorie</label>
                <input class="form-control" type="text" name="category" id="category"
                       value="<?php print (isset($data['category']) ? $data['category'] : ''); ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="price">Prijs</label>
                <input class="form-control" type="text" name="price" id="category"
                       value="<?php print (isset($data['price']) ? $data['price'] : ''); ?>">
            </div>
        </div>
    </div>

    <input class="btn btn-default" type="submit" value="<?php print $buttonText; ?>">

</form>
