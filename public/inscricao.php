<?php
	$evento =  filter_input( INPUT_GET, 'evento', FILTER_SANITIZE_URL ) ;
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pedal e Ação</title>
        <meta name="description" content="">
    <!--
    Template 2079 Garage
    http://www.tooplate.com/view/2079-garage
    -->	
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="source/bootstrap-3.3.6-dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="source/font-awesome-4.5.0/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="style/slider.css">
        <link rel="stylesheet" type="text/css" href="style/mystyle.css">
        <link rel="stylesheet" type="text/css" href="style/wirzard.css">
        <script>
			var idEvento = <?php echo $evento ?>
        </script>
    </head>

    <body>
        <!-- Header -->
        <div class="allcontain">            
            <!-- Navbar Up -->
            <nav class="topnavbar navbar-default topnav">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed toggle-costume" data-toggle="collapse" data-target="#upmenu" aria-expanded="false">
                            <span class="sr-only"> Toggle navigaion</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand logo" href="#"><img src="image/logo1.png" alt="logo"></a>
                    </div>	 
                </div>
                <div class="collapse navbar-collapse" id="upmenu">
                    <ul class="nav navbar-nav" id="navbarontop">
                        <li class="active"><a href="index.html">HOME</a></li>
                        <li><a href="sobre.html">Quem Somos</a></li>                        
                        <li><a href="eventos.html">Eventos </a></li>
                        <li><a href="fotos.html"> Fotos </a></li>
                        <li><a href="videos.html">Videos</a></li>
                        <li><a href="contato.html">Contato</a></li>                        
                    </ul>
                </div>
            </nav>
        </div>
        
        <!-- ____________________GRID ______________________________-->
        <div class="allcontain">
            <div class="feturedsection">
                <h1 class="text-center">1º Desafio XCM MTB</h1>                
            </div>  
            <div class="featurecontant" style="margin-top: 2%;">
                <div class="row firstrow">   
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 costumcol colborder1 img1colon">
                        <img src="image/events/event1_detalhes.jpeg" />
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 costumcol colborder1">
                        <div style="margin-left: 25px;">                            
                            <h3 class="text-center">1º Desafio XCM MTB</h3>
                            <p>
                            <b>Local:</b> São Felix do Coribe - BA <br>
                            <b>Data:</b> 28 de Janeiro de 2018 <br>
                            <b>Categorias:</b>
                                <ul>
                                    <li>Elite masculino</li>
                                    <li>Elite feminino</li>
                                    <li>Sub - 30</li>
                                    <li>Junior</li>
                                    <li>Master - A 30 a 34 anos</li>
                                    <li>Master - B 35 a 39 anos</li>
                                    <li>Master - C 40 a 44 anos</li>
                                    <li>Master - D 45 a 49 anos</li>
                                    <li>Master - E 50 a 54 anos</li>
                                    <li>Veterano - 55+ anos</li>
                                    <li>Turismo - A</li>
                                    <li>Turismo - B</li>
                                    <li>Turismo Feminino</li>
                                </ul>
                            <br>
                            Premiação do 1º ao 5º em todas as categorias (Dinheiro, Medalha e troféu) <br>
                            Categoria Turismo Premiação em dinheiro, troféu e medalha para do 1º ao 5º, brindes do 6º ao 10º. <br>
                            15.000,00 em premiação <br>
                            </p>
                            <b>Valor:</b>                            
                            <p>                                
                                1º lote <b>70,00 R$</b> até 31 de dezembro de 2017<br />
                                2º lote <b>80,00 R$</b> a partir de janeiro de 2018.<br />
                            </p><br />
							<p>
                                <b style="color:#ff3300;">INSCRIÇÕES FINALIZAM EM 25/01/2018</b> <br />
								Informações: (77) 9 9141-9900
							</p>
                            <!-- Trigger the modal with a button -->                            
                        </div>                                  
                    </div>
                </div>
            </div>
         
            
            
            
            <!-- ______________________________________________________Bottom Menu ______________________________-->
            <div class="bottommenu">
                <div class="bottomlogo">
                <span class="dotlogo">&bullet;</span><img src="image/collectionlogo1.png" alt="logo1"><span class="dotlogo">&bullet;</span>
                </div>
                <ul class="nav nav-tabs bottomlinks">
                    <li role="presentation" ><a href="sobre.html" role="button">Quem Somos</a></li>                        
                    <li role="presentation" ><a href="eventos.html">Eventos </a></li>
                    <li role="presentation" ><a href="fotos.html"> Fotos </a></li>
                    <li role="presentation" ><a href="videos.html">Videos</a></li>
                    <li role="presentation" ><a href="contato.html">Contato</a></li>
                </ul>
                <p><b>PEDAL &amp; AÇÃO </b><br> vivendo em movimento</p>
                 <img src="image/line.png" alt="line"> <br>
                 <div class="bottomsocial">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                </div>
                    <div class="footer">                        
                        <div class="atisda">
                             Desenvolvido por <a href="https://www.facebook.com/viniciusnmedeiros">Vinicius Nunes </a> 
                        </div>
                    </div>
            </div>
            
        </div>
        

        <script type="text/javascript" src="source/bootstrap-3.3.6-dist/js/jquery.js"></script>
        <script type="text/javascript" src="source/js/isotope.js"></script>
        <script type="text/javascript" src="source/js/myscript.js"></script> 
        <script type="text/javascript" src="source/bootstrap-3.3.6-dist/js/jquery.1.11.js"></script>
        <script type="text/javascript" src="source/bootstrap-3.3.6-dist/js/bootstrap.js"></script>

        <script type="text/javascript" src="source/js/jquery.mask.min.js"></script>
        
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>-->
        <!--<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>-->

    </body>
</html>
