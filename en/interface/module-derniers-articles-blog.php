<?php

include(INCLUDE_CLASS_BLOG);
$blog = new Blog();
?>
<div id="derniers_articles_blog">
	<h2><?php echo DERNIERS_ARTICLES_BLOG; ?></h2>
	<ul>
		<?php
		//------------ Constitution des derniers article du blog ---------------------
		$blog->lesDerniersArticlesBlog();
		?>
	</ul>
</div>