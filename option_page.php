<?php

if ( ! defined( 'ABSPATH' ) ) exit ( 'Nein nein nein!' ); // Exit bei direktem Zugriff

	$options= PYC_my_options();
	if(isset($_POST['image_save_msg']))
	{
		if(array_key_exists('link',$_POST)) $options['link']=intval($_POST['link']);
		else $options['link']=0;
		if(array_key_exists('select',$_POST)) $options['select']=intval($_POST['select']);
		else $options['select']=0;
		if(array_key_exists('saveimg',$_POST)) $options['saveimg']=intval($_POST['saveimg']);
		else $options['saveimg']=0;
		if(array_key_exists('CTRLA',$_POST)) $options['CTRLA']=intval($_POST['CTRLA']);
		else $options['CTRLA']=0;
		if(array_key_exists('CTRLC',$_POST)) $options['CTRLC']=intval($_POST['CTRLC']);
		else $options['CTRLC']=0;
		if(array_key_exists('CTRLU',$_POST)) $options['CTRLU']=intval($_POST['CTRLU']);
		else $options['CTRLU']=0;
		if(array_key_exists('CTRLV',$_POST)) $options['CTRLV']=intval($_POST['CTRLV']);
		else $options['CTRLV']=0;
		if(array_key_exists('CTRLS',$_POST)) $options['CTRLS']=intval($_POST['CTRLS']);
		else $options['CTRLS']=0;
		if(array_key_exists('cmenu',$_POST)) $options['cmenu']=intval($_POST['cmenu']);
		else $options['cmenu']=0;
		if(array_key_exists('CTRLINPUT',$_POST)) $options['CTRLINPUT']=intval($_POST['CTRLINPUT']);
		else $options['CTRLINPUT']=0;		
		if(array_key_exists('image_save_msg',$_POST)) $options['image_save_msg']=$_POST['image_save_msg'];
		else $options['image_save_msg']='';
		if(array_key_exists('anzahl',$_POST)) $options['anzahl']=$_POST['anzahl'];
		else $options['anzahl']='';
		if(array_key_exists('ihrname',$_POST)) $options['ihrname']=$_POST['ihrname'];
		else $options['ihrname']='';
		if(array_key_exists('no_menu_msg',$_POST)) $options['no_menu_msg']=$_POST['no_menu_msg'];
		else $options['no_menu_msg']='';
		PYC_update_my_options($options);
		$saved_options="Ihre Einstellungen wurden erfolgreich gesichert!";
		PYC_option_msg($saved_options);
	}	
	$options= PYC_my_options();
?>

<style type="text/css">
    .onoffswitch {position: relative; width: 45px; -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;}
    .onoffswitch-checkbox {display: none;}
    .onoffswitch-label {display: block; overflow: hidden; cursor: pointer; border: 2px solid #999999; border-radius: 10px;}
    .onoffswitch-inner {display: block; width: 200%; margin-left: -100%; transition: margin 0.3s ease-in 0s;}
    .onoffswitch-inner:before, .onoffswitch-inner:after {display: block; float: left; width: 50%; height: 13px; padding: 0; line-height: 13px; font-size: 10px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold; box-sizing: border-box;}
    .onoffswitch-inner:before {content: "AN"; padding-left: 6px; background-color: #79CC35; color: #FFFFFF;}
    .onoffswitch-inner:after {content: "AUS"; padding-right: 6px; background-color: #EEEEEE; color: #999999; text-align: right;}
    .onoffswitch-switch {display: block; width: 9px; margin: 2px; background: #FFFFFF; position: absolute; top: 0; bottom: 0; right: 28px; border: 2px solid #999999; border-radius: 10px; transition: all 0.3s ease-in 0s;}
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {margin-left: 0;}
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {right: 0px;}
    input[type="checkbox"], input[type="radio"] {display:none;}
    table {width: 100%;}
    td {width: 50%;}
</style>


<!-- OPTIONS PAGE-->

<div class="wrap">
	<div id="pyc-header">
    <a href="http://www.protectyourcontent.de/" target="_blank">Hilfe</a>
    <a href="http://www.protectyourcontent.de/" target="_blank">Forum</a>
	</div>
    <h2>Protect Your Content</h2>
    <?php 
    /*
    if (!isset($dismissed['rate'])) { ?>
    <div class="pyc-notice">
        Falls Ihnen das Plugin gefällt: <a href="kommt noch" target="_blank">würden Sie es bewerten</a>?
        (es benötigt nur wenig Zeit und einen Accont auf WordPress.org, sollte doch jeder WordPress - Betreiber haben ;) Vielen Dank, SEO-Küche Internet Marketing GmbH & Co. KG!
        <div class="pyc-dismiss"><a href="<?php echo wp_nonce_url($_SERVER['REQUEST_URI'] . '&dismiss=rate')?>">Ausblenden?</a></div>
        <div style="clear: both"></div>
    </div>
    <?php } 
    */
    ?>
    <div id="poststuff">
    	<div id="post-body" class="metabox-holder columns-2">
    		<!-- Content -->
    		<div id="post-body-content">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">                        
	                <div class="postbox">
	                    <h3 class="hndle">Einstellungen:</h3>
	                    <div class="inside">
						<form id='options_frm' method="POST">
	<b>Text</b>
							<hr/>
							<table>
								<tbody>
									<tr>
										<td style="float: right;">
											<div class="onoffswitch">
											<input type="checkbox" name="select" class="onoffswitch-checkbox" id="select" value="1" <?php if($options['select']) echo 'checked'; ?>>
											<label class="onoffswitch-label" for="select">
												<span class="onoffswitch-inner"></span>
											<span class="onoffswitch-switch"></span>
						        			</label>
						    				</div>
						    			</td>
										<td>Das Markieren der Seiteninhalte wird <strong>ab jetzt</strong> unterbunden.</td>
						 			</tr>
									<tr>
										<td style="float: right;">
											<div class="onoffswitch">
						        			<input type="checkbox" name="CTRLA" class="onoffswitch-checkbox" id="CTRLA" value="1" <?php if($options['CTRLA']) echo 'checked'; ?>>
						        			<label class="onoffswitch-label" for="CTRLA">
						            			<span class="onoffswitch-inner"></span>
						            			<span class="onoffswitch-switch"></span>
						        			</label>
						    				</div>
						    			</td>
										<td>Verbiete CMD und CTRL + A (Alles auswählen).</td>
						 			</tr>
									<tr>
										<td style="float: right;">    
											<div class="onoffswitch">
									        <input type="checkbox" name="CTRLC" class="onoffswitch-checkbox" id="CTRLC" value="1" <?php if($options['CTRLC']) echo 'checked'; ?>>
									        <label class="onoffswitch-label" for="CTRLC">
									            <span class="onoffswitch-inner"></span>
									            <span class="onoffswitch-switch"></span>
									        </label>
									    	</div>
									    </td>
										<td>Verbiete CMD und CTRL + C (Kopieren).</td>
									</tr>
									<tr>
										<td style="float: right;">
											<div class="onoffswitch">
									        <input type="checkbox" name="CTRLU" class="onoffswitch-checkbox" id="CTRLU" value="1" <?php if($options['CTRLU']) echo 'checked'; ?>>
											<label class="onoffswitch-label" for="CTRLU">
											<span class="onoffswitch-inner"></span>
											<span class="onoffswitch-switch"></span>
									        </label>
									    	</div>
									    </td>
									 <td>Verbiete CMD und CTRL + U (Quellcodeaufruf).</td>
									 </tr>
									<tr>
										<td style="float: right;">
											<div class="onoffswitch">
									        <input type="checkbox" name="CTRLV" class="onoffswitch-checkbox" id="CTRLV" value="1" <?php if($options['CTRLV']) echo 'checked'; ?>>
									        <label class="onoffswitch-label" for="CTRLV">
									            <span class="onoffswitch-inner"></span>
									            <span class="onoffswitch-switch"></span>
									        </label>
									    	</div>
									    </td>
									    <td>Verbiete CMD und CTRL + V (Einfügen).</td>
									</tr>
									<tr>
										<td style="float: right;">
											<div class="onoffswitch">
									        <input type="checkbox" name="CTRLINPUT" class="onoffswitch-checkbox" id="CTRLINPUT" value="1" <?php if($options['CTRLINPUT']) echo 'checked'; ?>>
									        <label class="onoffswitch-label" for="CTRLINPUT">
									            <span class="onoffswitch-inner"></span>
									            <span class="onoffswitch-switch"></span>
									        </label>
									    	</div>
										</td>
										<td>Erlaube das Kopieren und Einfügen in Textboxen und -feldern.</td>
									</tr>
								</tbody>
							</table>
							<hr/>
							<table>
								<tbody>
									<tr>
										<td style="float: right;">    
											<div class="onoffswitch">
											<input type="checkbox" name="link" class="onoffswitch-checkbox" id="link" value="1" <?php if($options['link']) echo 'checked'; ?>>
											<label class="onoffswitch-label" for="link">
												<span class="onoffswitch-inner"></span>
												<span class="onoffswitch-switch"></span>
											</label>
											</div>
										</td>
							  			<td>Erlaube es meine Inhalte zu kopieren aber einen Link von mir mit!</td>
							 		</tr>
							  	</tbody>
							</table>
							Anzahl der erlaubten Zeichenlänge:

							<input name="anzahl" id="anzahl" type="range" min="0" max="1000" value="<?=$options['anzahl']?>" step="10" onchange="showValue(this.value)" />
							<span id="range"><?php if($options['anzahl']) echo $options['anzahl']; ?></span>
							<script type="text/javascript">
							function showValue(newValue)
							{
							    document.getElementById("range").innerHTML=newValue;
							}
							</script>
							<br/>
							<table>
								<tbody>
									<tr>
										<td>... weiterlesen auf: (IHRE URL) Copyright &copy;</td>
							  			<td><input type="text" width="100px;" name="ihrname" id="ihrname" size="30" value="<?=$options['ihrname']?>"></td>
							 		</tr>
							  	</tbody>
							</table>
							<br/>
							<br/>
	<b>Bilder</b>
							<hr/>

							<table>
								<tbody>
									<tr>
										<td style="float: right;">    
											<div class="onoffswitch">
											<input type="checkbox" name="saveimg" class="onoffswitch-checkbox" id="saveimg" value="1" <?php if($options['saveimg']) echo 'checked'; ?>>
											<label class="onoffswitch-label" for="saveimg">
											    <span class="onoffswitch-inner"></span>
											    <span class="onoffswitch-switch"></span>
											</label>
											</div>
										</td>
							  			<td>Verhinder das Abspeichern von Bildern</td>
							 		</tr>
							 		<tr>
										<td style="float: right;">Ihre Warnmeldung:</td>
							  			<td><input type="text" width="100px;" name="image_save_msg" id="image_save_msg" size="30" value="<?=$options['image_save_msg']?>"></td>
							 		</tr>
								</tbody>
							</table>
							<br/>
	<b>Weiteres</b>
							<hr/>
							<table>
								<tbody>
									<tr style="display:none">
										<td style="float: right;">    
											<div class="onoffswitch">
											    <input type="checkbox" name="CTRLS" class="onoffswitch-checkbox" id="CTRLS" value="1" <?php if($options['CTRLS']) echo 'checked'; ?>>
											    <label class="onoffswitch-label" for="CTRLS">
											        <span class="onoffswitch-inner"></span>
											        <span class="onoffswitch-switch"></span>
											    </label>
											</div>
										</td>
							  			<td>Das Markieren der Seiteninhalte und das Abspeichern der Seite mit CMD oder CTRL + S wird <strong>ab jetzt</strong> unterbunden.</td>
							 		</tr>
							 		<tr>
										<td style="float: right;"> 				
											<div class="onoffswitch">
											    <input type="checkbox" name="cmenu" class="onoffswitch-checkbox" id="cmenu" value="1" <?php if($options['cmenu']) echo 'checked'; ?>>
											    <label class="onoffswitch-label" for="cmenu">
											        <span class="onoffswitch-inner"></span>
											        <span class="onoffswitch-switch"></span>
											    </label>
											</div>
										</td>
							  			<td>Rechtsklick / Context verhindern.</td>
							 		</tr>
							 		 <tr>
										<td>Warnmeldung bei Rechtsklick / Context:</td>
							  			<td><input type="text" width="100px;" name="no_menu_msg" id="no_menu_msg" size="30" value="<?=$options['no_menu_msg']?>"></td>
							 		</tr>
							  	</tbody>
							</table>
							<br/>
							<br/>
							<br/>
							<input  class="button-primary" type="submit" value="  Sichern  " name="Save_Options">
							<script type="text/javascript">
								document.getElementById('link').checked=<?php if($options['link']) echo 'true'; else echo 'false'?>;
								document.getElementById('select').checked=<?php if($options['select']) echo 'true'; else echo 'false'?>;
								document.getElementById('saveimg').checked=<?php if($options['saveimg']) echo 'true'; else echo 'false'?>;
								document.getElementById('CTRLA').checked=<?php if($options['CTRLA']) echo 'true'; else echo 'false'?>;
								document.getElementById('CTRLC').checked=<?php if($options['CTRLC']) echo 'true'; else echo 'false'?>;
								document.getElementById('CTRLU').checked=<?php if($options['CTRLU']) echo 'true'; else echo 'false'?>;
								document.getElementById('CTRLV').checked=<?php if($options['CTRLV']) echo 'true'; else echo 'false'?>;
								document.getElementById('CTRLS').checked=<?php if($options['CTRLS']) echo 'true'; else echo 'false'?>;
								document.getElementById('cmenu').checked=<?php if($options['cmenu']) echo 'true'; else echo 'false'?>;
								document.getElementById('CTRLINPUT').checked=<?php if($options['CTRLINPUT']) echo 'true'; else echo 'false'?>;
							</script>
						</form>
						<br/>
	                    </div><!-- /inside -->
	                </div><!-- /postbox -->
				</div><!-- /normal-sortables -->
    		</div><!-- /post-body-content -->
    		
    		<!-- Sidebar -->
    		<div id="postbox-container-1" class="postbox-container" style="float: right; width: 280px;">
				<div class="postbox">
				    <h3 class="hndle">
				    	<span>Sie wollen im Internet gefunden werden?</span>
				    </h3>
				    <div class="inside">
					    <br>
					    <center><img src="http://www.seo-kueche.de/wp-content/uploads/2013/04/logo1-1.png"></center>
						<p>Wir helfen Ihnen!</p>
					    <p>SEO-Küche – Die Online Marketing Agentur ganz nach Ihrem Geschmack</p>
						<a href="http://www.seo-kueche.de/" class="button" target="_blank">Informieren Sie sich!</a>
				    </div>
				</div>
    		</div>
    	</div><!-- /post-body -->
	</div><!-- /poststuff -->      
</div><!-- /wrap --> 
