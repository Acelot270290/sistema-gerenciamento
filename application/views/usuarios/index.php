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
            <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
         </ol>
      </nav>
      <?php if($message = $this->session->flashdata('erro')){ ?>
      <div class="row">
         <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message ?></strong> 
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
         </div>
      </div>
      <?php } ?>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <a title="Cadastrar Novo Usuário" href="#" class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp;Novo</a>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Login</th>
                        <th>Ativo</th>
                        <th class="text-right no-sort">Ações</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <?php foreach ($usuarios as $user){?>
                        <td><?php echo $user ->id; ?></td>
                        <td><?php echo $user ->username; ?></td>
                        <td><?php echo $user ->email; ?></td>
                        <td><?php echo $user ->active; ?></td>
                        <td class="text-right">
                           <a title="Editar" href="<?php echo base_url('usuarios/edit/' . $user->id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i>&nbsp;Editar</a>
                           <a title="Excluir" href="#" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i>&nbsp;Excluir</a>
                        </td>
                        <?php } ?>
                     </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
