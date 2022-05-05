<?php if(! empty($article->errors)): ?>
    <ul>
        <?php foreach($article->errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" id="form-article">
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" name="title" id="title" type="text" placeholder="Article title" value= '<?= htmlspecialchars($article->title); ?>' >
    </div>
    <div class="form-group">
        <label for="content[]">Content</label>
        <textarea class="form-control" name="content" rows="4" cols="40" id="content" placeholder="Article content">
            <?= htmlspecialchars($article->content); ?>
        </textarea>
    </div>
    <div class="form-group">
        <label for="published_at">Publication date and time</label>
        <input class="form-control" name="published_at" id="published_at" value='<?= htmlspecialchars($article->published_at); ?>'>
    </div>
    <fieldset>
        <legend>Categories</legend>
            <?php foreach ($categories as $category) :?>
                <div class="form-check">
                    <label class="form-check-label" for="<?=$category['id']?>"><?=htmlspecialchars($category['name'])?></label>
                    <input class="form-check-input" type="checkbox" name="category[]" id="<?=$category['id']?>" value="<?=$category['id']?>" 
                    <?php if(in_array($category['id'], $category_ids)): ?> checked <?php endif; ?>
                    >
                </div>
            <?php endforeach; ?>
    </fieldset>
    <button class="btn">Save</button>
</form>