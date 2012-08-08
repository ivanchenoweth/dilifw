<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $titulo ?></title>



    <link rel="stylesheet" href="/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
	<script language="javascript"  src="/datetimepicker.js"></script>
</head>
<body>
<div id="art-page-background-glare-wrapper">
    <div id="art-page-background-glare"></div>
</div>
<div id="art-main">
    <div class="cleared reset-box"></div>
    <div class="art-box art-sheet">
        <div class="art-box-body art-sheet-body">
            <div class="art-header">
                <div class="art-headerobject"></div>
                        <div class="art-logo">
                                                 <h1 class="art-logo-name"><a href="./index.html">Onus Asesoría Financiera</a></h1>
                                                                         <h2 class="art-logo-text">Registro de seguimiento de titualres</h2>
                                                </div>
                
            </div>
            <div class="cleared reset-box"></div>
<div class="art-bar art-nav">
<div class="art-nav-outer">
	<ul class="art-hmenu">	
		<li>
			<a href="/" <?php if ($opcionactiva=="Buscar Titulares") echo 'class="active"'; ?>>Buscar Titulares</a>
		</li>	
		<?php if ($titulo != "Buscar Titulares" ) { ?>
		<li>
			<a  <?php if ($opcionactiva=="Gestionar Titulares") echo 'class="active"'; ?>>Gestionar Titulares</a>
		</li>		
		<?php } ?>
		<li>
			<a href="/index/logout">Salir</a>
		</li>	
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>
<div class="art-layout-wrapper">
    <div class="art-content-layout">	
        <div class="art-content-layout-row">
            <div class="art-layout-cell art-content">
                <div class="art-box art-post">
                    <div class="art-box-body art-post-body">
                        <div class="art-post-inner art-article"><h2 class="art-postheader"><?php echo $opcionactiva ?></h2>
							<?php if (@$panel1) {
								require_once(@$panel1);
							}
							?>

<div class="art-content-layout">
<div class="art-content-layout-row">
<div class="art-layout-cell" style="width: 100%;">
<?php if (@$panel2) require_once(@$panel2); ?>
    </div>
   </div>
</div>

		</div>
	<div class="cleared"></div>
</div>

		<div class="cleared"></div>
    </div>

</div>

                          <div class="cleared"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cleared"></div>
						
            <div class="art-footer">
                <div class="art-footer-body">
                            <div class="art-footer-text">
                                <p>Onus Asesoría Financiera Copyright © 2011. Todos los Derechos Reservados.</p>
                                                            </div>
                    <div class="cleared"></div>
                </div>
            </div>
    		<div class="cleared"></div>
        </div>
    </div>
    <div class="cleared"></div>
 <p class="art-page-footer">Onus Web Site</a> Creado por Ivroche.</p>
    <div class="cleared"></div>
</div>

</body>
</html>
