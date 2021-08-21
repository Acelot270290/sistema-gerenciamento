<?php $this->load->view('layout/sidebar'); ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <?php $this->load->view('layout/navbar'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios'); ?>">Usuários</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
        </ol>
      </nav>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a title="Voltar" href="<?php echo base_url('usuarios') ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp;Voltar</a>
        </div>
				<!-- Formulario de enviar as informações de Cadastro -->
        <div class="card-body">
          <form method="POST" name="form_add">
            <div class="form-group row">
              <div class="col-md-4">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" class="form-control" name="first_name" placeholder="Seu nome" value="<?php echo set_value('first_name')?>">
                <?php echo form_error('first_name','<small class="form-text text-danger">','</small>') ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Sobrenome</label>
                <input type="text" class="form-control" name="last_name" placeholder="Seu Sobrenome" value="<?php echo set_value('last_name')?>">
                <?php echo form_error('last_name','<small class="form-text text-danger">','</small>') ?>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Seu email" value="<?php echo set_value('email')?>">
                <?php echo form_error('email','<small class="form-text text-danger">','</small>') ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="exampleInputEmail1">Usuário</label>
                <input type="text" class="form-control" name="username" placeholder="Usuário" value="<?php echo set_value('username')?>">
                <?php echo form_error('username','<small class="form-text text-danger">','</small>') ?>
              </div>
              <div class="col-md-4">
                <label">Ativo</label>
                <select class="form-control" name="active">
                  <option value="0">Não</option>
                  <option value="1">Sim</option>
                </select>
              </div>
              <div class="col-md-4">
                <label">Perfil de Acesso</label>
                <select class="form-control" name="perfil_usuario">
                  <option value="2">Vendedor</option>
                  <option value="1">Adminsitrador</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6 ">
                <label for="exampleInputEmail1">Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Sua Senha" value="">
                <?php echo form_error('password','<small class="form-text text-danger">','</small>') ?>
              </div>
              <div class="col-md-6 ">
                <label for="exampleInputEmail1">Confirme sua Senha</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Sua Senha" value="">
                <?php echo form_error('confirm_password','<small class="form-text text-danger">','</small>') ?>
              </div>
            </div>
				</div>
				<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
      </div>
		</div>
      
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
