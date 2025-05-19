<?php
//***********************************************
//               CLASS BLOG
//***********************************************
include_once("class.CompBDD.php");

class Blog{
	//Constructeur
	function Blog(){
		
	}
	
	//Méthodes
	//Constitution des derniers article du blog
	function lesDerniersArticlesBlog(){
		$req = new CompBDD();
		$mysql = $req->lesDerniersArticlesBlogMYSQL();
		while($result = mysql_fetch_array($mysql)){
			echo "<li><a href=\"".HTTP_BLOG."article-".$result['id_cat']."-".$result['id_article'].".php\" title=\"".$result['titre_article']."\">".$result['titre_article']."</a></li>";
		}
	}
	
	//Lister les catégories du Blog
function getCategoriesBlog() {
    $req = new CompBDD();
    $result = $req->getCategoriesBlogMYSQL(); // Should return a mysqli_result

    if ($result) {
        while ($res = $result->fetch_object()) {
            echo '<li>- <a href="' . HTTP_BLOG . 'categorie-' . $res->id_cat . '.php" title="' . htmlspecialchars($res->cat) . '">' . htmlspecialchars($res->cat) . '</a></li>';
        }
    }
}

	
	//Développement du titre des articles d'une catégorie
	function listerTitresArticlesBlog($numeroCategorie){
		$req = new CompBDD();
		$mysql = $req->listerTitresArticlesBlogMYSQL($numeroCategorie);
		while($res = mysql_fetch_object($mysql)){
			echo '<li>- <a href="'.HTTP_BLOG.'article-'.$numeroCategorie.'-'.$res->id_article.'.php" title="'.$res->titre_article.'">'.$res->titre_article.'</a></li>';
		}
	}
	
	//Récupération du dernier article de cette catégorie
	function getDernierArticleBlog($numeroCategorie){
		$req = new CompBDD();
		$mysql = $req->getDernierArticleBlogMYSQL($numeroCategorie);
		$res = mysql_fetch_object($mysql);
		return $res;
	}
	
	//Récupération du listing Flux XML
	function getListingCategoriesXml(){
		$req = new CompBDD();
		$cat0 = "";
		$cat1 = TEXTE_21;
		$cat2 = TEXTE_22;
		$cat3 = TEXTE_23;
		$cat4 = TEXTE_24;
		
		$tab = array($cat0, $cat1, $cat2, $cat3, $cat4);

		$mysql = $req->getCategoriesBlogMYSQL();
		while($res = mysql_fetch_object($mysql)){
			echo "<item>"
				."<title>".$res->cat."</title>"
				."<link>".HTTP_BLOG."categorie-".$res->id_cat.".php</link>"
				."<description>".$tab[$res->id_cat]."</description>"
				."</item>";
		}
	}
	
	//Lire un article du blog
	function getUnArticle($id_article, $id_categorie){
		$req = new CompBDD();
		$mysql = $req->getUnArticleMYSQL($id_article, $id_categorie);
		$res = mysql_fetch_object($mysql);
		return $res;
	}
}
?>
