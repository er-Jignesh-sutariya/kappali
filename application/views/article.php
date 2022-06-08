<br class="point-br"><br class="point-br"><br class="point-br">
<svg class="svg-class" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#6ab845" fill-opacity="1" d="M0,160L80,160C160,160,320,160,480,149.3C640,139,800,117,960,133.3C1120,149,1280,203,1360,229.3L1440,256L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
<div class="container">
<div class="mob-nav-head">
	<a href="<?= base_url() ?>"><i class="fas fa-arrow-left"></i></a><p><b>Article</b></p>
</div>
<div class="opened-article">
	<div class="article-header text-center">
		<?= img(['src' => $article['image']]) ?>
	</div><br>
	<div class="opened-article-title">
		<h4><b><?= $article['title'] ?></b></h4>
	</div>
	<div class="article-date">
		<p><?= date('d M Y', strtotime($article['created'])) ?></p>
	</div><br>
	<div class="article-body">
		<?= $article['details'] ?>
	</div>
</div><br><br>
</div>