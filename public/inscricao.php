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
			<?php if ($evento == 1): ?>
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
            <?php endif; ?>
            <?php if ($evento == 2): ?>
            <div class="feturedsection">
                <h1 class="text-center">II Desafio Dubai</h1>
            </div>  
            <div class="featurecontant" style="margin-top: 2%;">
                <div class="row firstrow">   
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 costumcol colborder1 img1colon">
                        <img src="image/events/event_dubai/event_detalhes.jpg" />
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 costumcol colborder1">
                        <div style="margin-left: 25px;">
                            <h3 class="text-center">II Desafio Dubai</h3>
                            <p>
                            <b>Local:</b> Baianópolis - BA <br>
                            <b>Data:</b> 29 de julho 2018 <br>
                            <b>regulamento:</b> <a href="./docs/desafioDubai/regulamento.pdf" target="_blank" > aqui </a> <br>
                            <b>Categorias:</b>
                                <ul>
                                    <li>Masculino Elite: 19 anos acima</li>
									<li>Feminino Elite: 19 acima</li>
									<li>Júnior: Masculino entre 15 a 18 anos</li>
									<li>Sub-30: Masculino entre 23 e 29</li>
									<li>Máster A1: Masculino entre 30 e 34 anos</li>
									<li>Máster A2: Masculino entre 35 e 39 anos</li>
									<li>Máster B1: Masculino entre 40 e 44 anos</li>
									<li>Master B2: Masculino entre 45 e 49 anos</li>
									<li>Máster C1: Masculino entre 50 á 54 anos acima</li>
									<li>Máster C2: Masculino entre 55 anos</li>
									<li>Máster GG: Masculino com 19 anos acima de 100 kg</li>
									<li>Dupla mista: Homens e mulheres com 19 anos acima</li>
									<li>Dupla masculina: Homens com 19 anos acima</li>
									<li>Turismo Masculino: Masculino 15 anos acima</li>
									<li>Turismo Feminino: Feminino 15 anos acima</li>
                                </ul>
                            <br>                            
                            <br>
                            </p>
                            <b>Valor:</b>
                            <p>
								1º lote <b>R$ 85,00</b> até 24/06/2018.<br />
								2º lote <b>R$ 95,00</b> de 25/06/2018 á 25/07/2018.<br />
								3º lote <b>R$ 105,00</b> de 26 á 28/07/2018 até meio dia.<br />
                            </p><br />                            
							<p>
                                <b style="color:#ff3300;">INSCRIÇÕES FINALIZAM EM 22/07/2018</b> <br />
								Informações: (77) 9 9826-3565 <br>
                                e-mail: rubenscotegipe@hotmail.com
							</p>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Fazer Inscrição</button>
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalInscritos">Inscritos por categoria</button>
                        </div>                                  
                    </div>
                </div>
            </div>
            
            <div id="modalInscritos" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="loading-panel">
                        <div class="loading-panel-content">
                            Aguarde...
                        </div>
				    </div>
				    <div class="modal-content">
						<div class="modal-body" style="margin:5px;height: 400px;overflow: scroll;">
							<table class="table">
								<caption>Lista de usuários inscritos</caption>
								<thead>
									<tr>
										<th scope="col">Categoria</th>
										<th scope="col">Nome</th>
										<th scope="col">Situação</th>
										<th scope="col">Cidade</th>
									</tr>
								</thead>
								<tbody class="tbody_inscritos">
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
            
            <?php endif; ?>
            
         
            <!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
                    <div class="loading-panel">
                        <div class="loading-panel-content">
                            Aguarde...
                        </div>
				    </div>
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-body" style="margin:5px; min-height:400px;">
							<div class="wizard">
								<div class="wizard-inner">
									<div class="connecting-line"></div>
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Cadastro">
													<span class="round-tab">
														<i class="glyphicon glyphicon-user"></i>
													</span>
												</a>
											</li>

											<li role="presentation" class="disabled">
												<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Evento">
													<span class="round-tab">
														<i class="glyphicon glyphicon-calendar"></i>
													</span>
												</a>
											</li>
											
											<li role="presentation" class="disabled">
												<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Pagamento">
													<span class="round-tab">
														<i class="glyphicon glyphicon-usd"></i>
													</span>
												</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="tab-content">
									<div class="tab-pane active" role="tabpanel" id="step1">
										<form method="POST" data-async action="./API/cadastro" class="form-horizontal formIscricao" id="form-cadastro">
											<input type="hidden" id="idCadastro" name="id" value="-1">
											<div class="form-group">
												<label class="control-label col-sm-2" for="cpf">CPF:</label>
												<div class="col-sm-3">
													<input type="text" class="form-control cpf" id="cpf" placeholder="000.000.000-00" name="cpf" >
												</div>
											
												<label class="control-label col-sm-3" for="nascimento">Data de Nascimento:</label>
												<div class="col-sm-4">
													<input type="text" class="form-control date" id="nascimento" placeholder="00/00/0000" name="nascimento" disabled>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label col-sm-2" for="nome">Nome:</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="nome" name="nome" disabled>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label col-sm-2" for="email">Email:</label>
												<div class="col-sm-8">
													<input type="email" class="form-control" id="email" placeholder="email@email.com.br" name="email" disabled>
												</div>
											</div>
																			
											<div class="form-group">
												<label class="control-label col-sm-2" for="celular">Celular:</label>
												<div class="col-sm-10">
													<input type="text" class="form-control phone" id="celular" placeholder="(00) 00000-0000" name="celular" disabled>
												</div>
											</div>							
																			
											<div class="form-group">
												<label class="control-label col-sm-2" for="logradouro">Logradouro:</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="logradouro" name="logradouro"  rows="2" disabled>
												</div>
											</div>								
											
											<div class="form-group">
												<label class="control-label col-sm-2" for="bairro">Bairro:</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="bairro" name="bairro" disabled>
												</div>
												
												<label class="control-label col-sm-1" for="cep">CEP:</label>
												<div class="col-sm-4">
													<input type="text" class="form-control cep" id="cep" name="cep" disabled>
												</div>									
											</div>
											
											<div class="form-group">
												<label class="control-label col-sm-2" for="cidade">Cidade:</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="cidade" name="cidade" disabled>
												</div>
											
												<label class="control-label col-sm-1" for="UF">UF:</label>
												<div class="col-sm-3">
													<select  class="form-control" id="UF" name="UF" disabled>
														<option value="BA">BA</option>
														<option value="AC">AC</option>
														<option value="AL">AL</option>
														<option value="AM">AM</option>
														<option value="AP">AP</option>
														<option value="CE">CE</option>
														<option value="DF">DF</option>
														<option value="ES">ES</option>
														<option value="GO">GO</option>
														<option value="MA">MA</option>
														<option value="MG">MG</option>
														<option value="MS">MS</option>
														<option value="MT">MT</option>
														<option value="PA">PA</option>
														<option value="PB">PB</option>
														<option value="PE">PE</option>
														<option value="PI">PI</option>
														<option value="PR">PR</option>
														<option value="RJ">RJ</option>
														<option value="RN">RN</option>
														<option value="RS">RS</option>
														<option value="RO">RO</option>
														<option value="RR">RR</option>
														<option value="SC">SC</option>
														<option value="SE">SE</option>
														<option value="SP">SP</option>
														<option value="TO">TO</option>
													 </select>												
<!--													<input type="text" class="form-control" id="UF" name="UF" disabled>-->
												</div>
											</div>
											
											<div class="form-group">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
												<button type="submit" class="btn btn-primary" form="form-cadastro">Avançar >></button>
											</div>
										</form>
									</div>
									<div class="tab-pane" role="tabpanel" id="step2">
										<form method="POST" data-async action="./API/evento/inscricao" class="form-horizontal formIscricaoCategoria" id="form-cadastroCategoria">
											<div style="min-height:200px;">
												<label for="selectCategoria">Selecionar a categoria desejada:</label>
												<select class="form-control" id="selectCategoria" name="selectCategoria">
												</select>
												<input type="hidden" name="idEvento" id="idEvento_cat">
												<input type="hidden" name="idCadastro" id="idCadastro_cat" >
											</div>
											<ul class="list-inline pull-right">
												<li><button type="button" class="btn btn-default prev-step">Retornar</button></li>
												<li><button type="submit" class="btn btn-primary next-step" form="form-cadastroCategoria">Avançar</button></li>
											</ul>
										</form>
									</div>
									
									<div class="tab-pane" role="tabpanel" id="step3">
										<h3>Forma de pagamento!</h3>
                                        <!--<form method="POST" data-async action="./API/finalizarInscricao" class="form-horizontal formFinalizarIscricao" id="form-finalizarIscricao">-->
                                        <form method="POST" data-async action="./API/moip/boleto" class="form-horizontal formFinalizarIscricao" id="form-finalizarIscricao">
                                            <div id="conteudoFormFinalizarInscricao">
                                                <div id="formaPagamento">
                                                </div>
                                                <input type="hidden" name="idInscricao" id="idInscricao">
                                                <input type="hidden" name="SenderHash" id="SenderHash">
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="btn btn-default prev-step">Retornar</button></li>
                                                    <li><button type="submit" class="btn btn-primary next-step" from="form-finalizarIscricao">Finalizar Inscriçao</button></li>
                                                </ul>
                                            </div>
                                        </form>
									</div>
								</div>
							</div>
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
        
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
        <!--<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>-->

    </body>
</html>
