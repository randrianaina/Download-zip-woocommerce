<script>
/*script qui envoie en AjAX les informations sur la fonction PHP download_zip mis dans l'AJAX WP */
	jQuery(document).ready(function ($) {		
    $('#nom_du_bouton').click(function (e) {
				e.preventDefault();
        $.ajax({
            type: 'POST',
            /*adresse du plugin php ajax dans woocommerce*/
            url: 'https://'+window.location.hostname+'/wp-admin/admin-ajax.php',
					  data: {
              /*action contient le nom de la fonction PHP*/
            	'action': 'download_zip',
          	},
						 success: function(data){
         				console.log(data);
							 	window.location = data;
						 }
        });
    });
});	
</script>
