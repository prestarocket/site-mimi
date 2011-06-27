<?php

class DDLX_Slider_Free extends Module
{

	public function __construct()
	{
 	 	$this->name = 'DDLX_Slider_Free';
		$this->tab = 'DDLX modules';
 	 	$this->version = '1.1';

	 	parent::__construct();

		$this->page = basename( __FILE__, '.php' );
		$this->displayName = $this->l( 'DDLX Slider Free' );
		$this->description = $this->l( 'Module de chargement d\'images pour Slider DDLX' );
	}


	function install()
	{
		if(!parent::install() OR !$this->registerHook('home')) return false;
		else return true;
	}

	public function uninstall()
	{
		return (parent::uninstall());
	}

	//Config



	function getContent()
	{
		if ( Tools::isSubmit('upload'))$this ->upload();
		$this -> affiche();
	}



/*###################################################################*/
	function upload(){
		//Uploading
		$astrIncomingFiles = array( '1_jpg', '2_jpg', '3_jpg', '4_jpg' );
		$astrFilenames = array( '1.jpg', '2.jpg', '3.jpg', '4.jpg' );
		$auiDimensions = array( array( 1500, 700 ), array( 1500, 700), array( 1500, 700 ), array( 1500, 700) );

		echo '<div class="conf confirm">';

		for ( $i = 0; $i < 4; ++$i )
		{
			$infile = $astrIncomingFiles[ $i ];
			$outfile = $astrFilenames[ $i ];

			if ( $_FILES[ $infile ]['error'] != UPLOAD_ERR_NO_FILE )
			{
				if ( isset($_FILES[ $infile ]['name']) && ($_FILES[ $infile ]['error'] == UPLOAD_ERR_OK) )
				{
					$auiImgSize = getimagesize( $_FILES[ $infile ]['tmp_name'] );
					$auiImgDims = $auiDimensions[ $i ];

					if ( ($auiImgSize[ 0 ] <= $auiImgDims[ 0 ]) && ($auiImgSize[ 1 ] <= $auiImgDims[ 1 ]) )
					{
						if ( move_uploaded_file( $_FILES[ $infile ]['tmp_name'], _PS_ROOT_DIR_.'/modules/DDLX_Slider_Free/images/'.$outfile ) )
						{
							echo "<li> Image ".$outfile." charg&eacute;e avec succ&egrave;s</li>";
						}
						else
						{
							echo "<li> Echec du chargement de l'image ".$outfile.".</li>";
						}
					}
					else
					{
						echo '<li> Les dimensions de l\'image '.$outfile.' sont incorrectes. Fichier : ('.$auiImgSize[0].', '.$auiImgSize[1].') Requis : ('.$auiImgDims[0].', '.$auiImgDims[1].')</li>';
					}
				}
				else
				{
					switch ( $_FILES[ $infile ]['error'] )
					{
						case UPLOAD_ERR_INI_SIZE:
							 $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
							 break;
						case UPLOAD_ERR_FORM_SIZE:
							 $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
							 break;
						case UPLOAD_ERR_PARTIAL:
							 $message = "The uploaded file was only partially uploaded";
							 break;
						case UPLOAD_ERR_NO_FILE:
							 $message = "No file was uploaded";
							 break;
						case UPLOAD_ERR_NO_TMP_DIR:
							 $message = "Missing a temporary folder";
							 break;
						case UPLOAD_ERR_CANT_WRITE:
							 $message = "Failed to write file to disk";
							 break;
						case UPLOAD_ERR_EXTENSION:
							 $message = "File upload stopped by extension";
							 break;

						default:
							 $message = "Unknown upload error";
							 break;
					}

					echo '<li>Erreur lors du chargement du fichier '.$outfile.' : '.$message.'</li>';
				}
			}
			else
			{
				echo '<li>Image "'.$infile.'" inchang&eacute;e.</li>';
			}
		}
		echo '</div><br />';

	}

/*###################################################################*/
	function affiche() //Panneau de gestion 
	{
		echo '
				<FORM method="POST" action="'.$_SERVER['REQUEST_URI'].'" ENCTYPE="multipart/form-data">
					<INPUT type=hidden name=MAX_FILE_SIZE  VALUE=1562144>
					
					<a href="http://shop.ddlx.org" target="_blank"><b> >>> Th&egrave;mes et templates pour prestashop </b></a> 
					
				
					<Br></br>					<Br></br>

                    Ce module vous permet de modifier les images du DDLX Slider.<Br></br><Br></br>
          		<Br></br>
          		
          <hr>
          		La <a href="http://shop.ddlx.org/543-ddlx-alan-slider-11.html" target="_blank"> <b>version pro </b> </a>   de ce module vous permet de :      		<Br></br> 	<Br></br> 
          		
                     <table width="100%"><tr><td>
                     - 4 ou 8 images dans le slide                             <Br>

- Choisir les effets de transition  (27 effets au choix)                            <Br>

- Choisir de la dur&eacute;e d\' affichage des images                                    <Br>

- Rendre les images cliquables avec choix du lien                                    <Br>

</td>

<td>
      
              
              
              Achetez la <a href="http://shop.ddlx.org/543-ddlx-alan-slider-11.html" target="_blank"> <b>version pro : ICI</b> </a>  
    </td></tr></table>    
    
		
          	
          	   		<Br></br>   		<Br></br>
          
                   <hr>

					<b>Image 1<u>.jpg</u></b> Original dimension (530x240)<br/>
					<INPUT type=file name="1_jpg" accept="image/jpeg, image/jpg"><br/><br/>
					 Miniature :<br/><br/>
                     <img src="../modules/DDLX_Slider_Free/images/1.jpg" border="0" width="200" ><br/><br/>
<hr>

					<b>Image 2<u>.jpg</u></b> Original dimension (530x240)<br/>
					<INPUT type=file name="2_jpg" accept="image/jpeg, image/jpg"><br/><br/>
					 Miniature :<br/><br/>
                    <img src="../modules/DDLX_Slider_Free/images/2.jpg" border="0" width="200"><br/><br/>
<hr>
					<b>Image 3<u>.jpg</u></b> Original dimension (530x240)<br/>
					<INPUT type=file name="3_jpg" accept="image/jpeg, image/jpg"><br/><br/>
					 Miniature :<br/><br/>
                    <img src="../modules/DDLX_Slider_Free/images/3.jpg" border="0" width="200"><br/><br/>
<hr>
					<b>Image 4<u>.jpg</u></b> Original dimension (530x240)<br/>
					<INPUT type=file name="4_jpg" accept="image/jpeg, image/jpg"><br/><br/>
					Miniature :<br/><br/>
                    <img src="../modules/DDLX_Slider_Free/images/4.jpg" border="0" width="200"><br/><br/>
	<hr>				
			
					
					<INPUT type=submit name="upload" value="Envoyer">
					
					                                           <hr>
					    
    <p align="center">         <b> DDLX MULTIMEDIA - NOS REALISATIONS RECENTES </b>    </br>
<IFRAME src="http://www.creation-web.ddlx.org/pictureflow/" width=800 height=400 scrolling=no frameborder=0 > </IFRAME></br></br>
</P>  


				</FORM>'

;
				
	}

	function hookHome($params)
	{
		return $this->display(__FILE__, 'ddlxslider.tpl');
	}

}
