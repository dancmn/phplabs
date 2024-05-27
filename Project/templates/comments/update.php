<?php require(dirname(__DIR__).'/header.php');?>
<form action="<?= dirname($_SERVER['SCRIPT_NAME']); ?>/article/<?= $article->getId(); ?>/comments/update/<?=$comment->getId();?>" method="POST">
    <div class="form-group">
    <label for="author_id">Choose Author</label>
    <input type="text" class="form-control" readonly id="author_id" name="author_id" value="<?=$comment->getAuthorId()->getNickname();?>">
    </div>
    <input type="hidden" name="article_id" value="<?= $article->getId(); ?>">
    <div class="form-group">
    <label for="text">Your Comment</label>
    <textarea name="text" id="text" class="form-control" required><?=$comment->getText();?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Edit Comments</button>
</form>
<?php require(dirname(__DIR__).'/footer.php');?>