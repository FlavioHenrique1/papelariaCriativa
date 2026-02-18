<?php \Classes\ClassLayout::setHeader('Cadastro','Realize seu cadastro em nosso sistema',"Flávio",'cadastro.css');?> 

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">

                    <h4 class="text-center mb-4 fw-bold">
                        Cadastro de Clientes
                    </h4>

                    <div class="retornoCad mb-3"></div>

                    <form name="formCadastro" 
                          id="formCadastro" 
                          action="<?= DIRPAGE.'controllers/controllerCadastro';?>" 
                          method="post">

                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   name="nome" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control form-control-lg" 
                                   name="email" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="date" 
                                   class="form-control form-control-lg" 
                                   name="dataNascimento" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" 
                                   class="form-control form-control-lg" 
                                   name="senha" 
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirmação de Senha</label>
                            <input type="password" 
                                   class="form-control form-control-lg" 
                                   name="senhaConf" 
                                   required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" 
                                    class="btn btn-primary btn-lg rounded-3">
                                Cadastrar
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            Já possui conta?
                            <a href="<?= DIRPAGE.'login';?>" class="fw-semibold">
                                Faça login
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<?php \Classes\ClassLayout::setFooter();?>
