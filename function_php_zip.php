<?php
/*FONCTION PHP QUI CREE UN ZIP* SOUS WOOCOMMERCE*/


/*ajout de la fonction dans admin-ajax.php de woocommerce qui gère les requêtes pour les utilisateurs connectés et non-connectés */
add_action( 'wp_ajax_download_zip', 'download_zip' );
add_action( 'wp_ajax_nopriv_download_zip', 'download_zip' );

/*Fonction*/
function download_zip(){

	$chemin=wp_upload_dir();

	/*URL relatif des fichiers à télécharger*/
	$chemin = $chemin['basedir'].'/wpallimport/files/tech';

	/*liste des fichiers dans le chemin d'accès*/
	$files = scandir($chemin);

	
	/*Nom du zip*/
	$zipname = 'LDT.zip';
	
	/*URL relatif où sera créé le ZIP , ici dans le dossier du theme enfant*/
	$filename = get_stylesheet_directory().'/downloads/'.$zipname;
	$zip = new ZipArchive;
	$zip->open($filename, ZipArchive::CREATE);


	/*Vérifie l'extension de chaque fichier*/
	 for ($i=0;$i<count($files);$i++){
		$ext  = (pathinfo($chemin.'/'.$files[$i])['extension']);
		$filename_ldt = (pathinfo($chemin.'/'.$files[$i])['basename']);
		
		/*ici explode sort un tableau, le premier index sortir le premier mot du nom du fichier*/
		$first_word_filename = explode(" ",$filename_ldt);

		/*Si l'extension est en LDT alors ,sauvegarde les fichier dans le zip*/
		if ($ext === "ldt"){
      
      /*Si le fichier contient le mot INDURO*/
			if ($first_word_filename[0] == "INDURO"){
			$zip->addFile($chemin.'/'.$files[$i], basename($files[$i]));
			}
		}
	 }

	$zip->close();
	
  /*URL absolu où sera télécharger le fichier ZIP qui a été créé*/
	$download_filename = get_stylesheet_directory_uri().'/downloads/'.$zipname;

    echo $download_filename;

    die();
}

?>
