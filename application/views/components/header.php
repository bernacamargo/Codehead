
<?php //var_dump($this->session->user); ?>

<header>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #045f96;">
	<a class="navbar-brand" href="<?php echo site_url() ?>"><img class="out" src="<?php echo site_url('assets/images/audax_logo.png') ?>" height="80 "></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	  <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
	  <ul class="navbar-nav ml-auto mr-md-5 pr-md-3">
		<li class="nav-item dropdown">
		  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 50px;">
			<i class="fa fa-user-circle"></i>&ensp; <?= $this->session->user['nome'] ?>
		  </a>
		  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size: 1.1em;">
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" onclick="if(!confirm('Deseja iniciar um novo orçamento?')) return false;" href="<?php echo site_url('orcamento/limpaOrcamento') ?>"><i class="fas fa-plus-square"></i> Novo orçamento</a>
			<a class="dropdown-item" href="<?php echo site_url('orcamentos/') ?>"><i class="fas fa-search"></i> Consulta orçamentos</a>
			<div class="dropdown-divider"></div>
		<?php if($this->session->user['acesso'] != 997): ?>
			<a class="dropdown-item" href="<?php echo site_url('usuarios/cadastrar/') ?>"><i class="fas fa-plus-square"></i> Novo usuário</a>
			<a class="dropdown-item" href="<?php echo site_url('usuarios/') ?>"><i class="fas fa-search"></i> Consulta usuários</a>
            <div class="dropdown-divider"></div>
			<a class="dropdown-item" href="<?php echo site_url('clientes/cadastrar/') ?>"><i class="fas fa-plus-square"></i> Cadastrar clientes</a>
			<a class="dropdown-item" href="<?php echo site_url('clientes/') ?>"><i class="fas fa-search"></i> Consulta clientes</a>			
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="<?php echo site_url('materiais/importar/') ?>"><i class="fas fa-file-import"></i> Importar materiais</a>
			<a class="dropdown-item" href="<?php echo site_url('materiais/cadastrar/') ?>"><i class="fas fa-plus-square"></i> Cadastrar materiais</a>
			<a class="dropdown-item" href="<?php echo site_url('materiais/') ?>"><i class="fas fa-search"></i> Consulta materiais</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="<?php echo site_url('produtos/importar/') ?>"><i class="fas fa-file-import"></i> Importar produtos</a>
			<a class="dropdown-item" href="<?php echo site_url('produtos/cadastrar/') ?>"><i class="fas fa-plus-square"></i> Cadastrar produtos</a>
			<a class="dropdown-item" href="<?php echo site_url('produtos/') ?>"><i class="fas fa-search"></i> Consulta produtos</a>			
			<!-- <div class="dropdown-divider"></div>
			<a class="dropdown-item" href="<?php echo site_url('processos/importar/') ?>"><i class="fas fa-file-import"></i> Importar processos</a>
			<a class="dropdown-item" href="<?php echo site_url('processos/cadastrar/') ?>"><i class="fas fa-plus-square"></i> Cadastrar processos</a>
			<a class="dropdown-item" href="<?php echo site_url('processos/') ?>"><i class="fas fa-search"></i> Consulta processos</a> -->			
		<?php endif; ?>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="<?php echo site_url('login/logout') ?>"><i class="fas fa-power-off"></i>Logout</a>

		  </div>
		</li>
	  </ul>
	</div>
  </nav>

<?php 

if(($template->item('container') == 'orcamento_cliente') or ($template->item('container') == 'orcamento_produtos') or ($template->item('container') == 'orcamento_materiais') or ($template->item('container') == 'orcamento_processos') or ($template->item('container') == 'orcamento_premissas') or ($template->item('container') == 'orcamento_margens')): ?>

	<nav id="smartwizard" class="container-fluid">
		<ul class="nav nav-tabs step-anchor justify-content-center mt-5">
			<li class="<?php if ($template->item('container') == 'orcamento_cliente') echo 'active'; ?>">
				<a class="next_prev" data-url="orcamento/cliente"  href="<?php echo site_url('orcamento/cliente/') ?>">1<br/><br/><br/><small>Cliente</small></a>
			</li>

			<li class="<?php if ($template->item('container') == 'orcamento_premissas') echo 'active'; ?>">
				<a class="next_prev" data-url="orcamento/premissas"  href="<?php echo site_url('orcamento/premissas/') ?>">2<br/><br/><br/><small>Premissas</small></a>
			</li>

			<li class="<?php if ($template->item('container') == 'orcamento_produtos') echo 'active'; ?>">
				<a class="next_prev" data-url="orcamento/produtos"  href="<?php echo site_url('orcamento/produtos/') ?>">3<br/><br/><br/><small>Produto acabado</small></a>
			</li>
			
			<li class="<?php if ($template->item('container') == 'orcamento_materiais') echo 'active'; ?>">
				<a class="next_prev" data-url="orcamento/materiais"  href="<?php echo site_url('orcamento/materiais/') ?>">4<br/><br/><br/><small>Lista de materiais</small></a>
			</li>
			
			<li class="<?php if ($template->item('container') == 'orcamento_processos') echo 'active'; ?>">
				<a class="next_prev" data-url="orcamento/processos"  href="<?php echo site_url('orcamento/processos/') ?>">5<br/><br/><br/><small>Roteiro de processo</small></a>
			</li>
			
			
			<li class="<?php if ($template->item('container') == 'orcamento_margens') echo 'active'; ?>">
				<a class="next_prev" data-url="orcamento/margens"  href="<?php echo site_url('orcamento/margens/') ?>">6<br/><br/><br/><small>Margens</small></a>
			</li>
		</ul>
	</nav>
	
	<div class="col-12 mt-5 pt-5 pb-5 text-center">
		
		<button onclick="if(confirm('Deseja descartar esse orçamento?')) window.location.href='<?php echo site_url('orcamento/limpaOrcamento') ?>'" class="btn btn-danger"><i class="fa fa-redo"></i> Reiniciar o orçamento</button>
	</div>

<?php endif; ?>


</header>

