<?php require(dirname(__DIR__).'/header.php');?>
    <div class="card mt-3" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title"><?=$article->getName();?></h5>
      <h6 class="card-subtitle mb-2 text-muted"><?=$article->getAuthorId()->getNickName();?></h6>
      <p class="card-text"><?=$article->getText();?></p>
      <a href="<?=dirname($_SERVER['SCRIPT_NAME']);?>/article/edit/<?=$article->getId();?>" class="btn btn-primary">Edit Article</a>
      <a href="<?=dirname($_SERVER['SCRIPT_NAME']);?>/article/delete/<?=$article->getId();?>" class="btn btn-warning">Delete Article</a>
    </div>
  </div>

  <div class="mt-3">
    <h3>Comments:</h3>
    <?php foreach ($comments as $comment): ?>
      <div class="card mt-3">
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted">Author: <?= $comment->getAuthorId()->getNickName(); ?></h6>
          <p class="card-text"><?= $comment->getText(); ?></p>
          <a href="<?= dirname($_SERVER['SCRIPT_NAME']); ?>/article/<?= $article->getId(); ?>/comments/edit/<?= $comment->getId(); ?>" class="btn btn-primary">Edit Comments</a>
          <a href="<?= dirname($_SERVER['SCRIPT_NAME']); ?>/article/<?= $article->getId(); ?>/comments/delete/<?= $comment->getId(); ?>" class="btn btn-danger">Delete</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <form action="<?= dirname($_SERVER['SCRIPT_NAME']); ?>/article/<?= $article->getId(); ?>/comments/store" method="POST">
    <div class="form-group">
      <label for="author_id">Choose Author</label>
      <select name="author_id" id="author_id" class="form-control" required>
        <option value="">Select Author</option>
        <?php foreach ($users as $user): ?>
          <option value="<?= $user->getId(); ?>"><?= $user->getNickname(); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <input type="hidden" name="article_id" value="<?= $article->getId(); ?>">
    <div class="form-group">
      <label for="text">Your Comment</label>
      <textarea name="text" id="text" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Comments</button>
  </form>
<?php 
    require(dirname(__DIR__).'/footer.php'); 
?>