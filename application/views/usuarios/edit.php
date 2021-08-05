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
    </nav>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <a title="Voltar" href="<?php echo base_url('usuarios') ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp;Voltar</a>
      </div>
      <div class="card-body">
        <form>
          <div class="form-group row">

            <div class="col-md-4">
              <label for="exampleInputEmail1">Nome</label>
              <input type="text" class="form-control" name="first_name" placeholder="Seu nome" value="<?php echo $usuario->first_name; ?>">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

            </div>
			<div class="col-md-4">
              <label for="exampleInputEmail1">Sobrenome</label>
              <input type="text" class="form-control" name="last_name" placeholder="Seu Sobrenome" value="<?php echo $usuario->last_name; ?>">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        	</div>
			<div class="col-md-4">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Seu email" value="<?php echo $usuario->email; ?>">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        	</div>
          </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
