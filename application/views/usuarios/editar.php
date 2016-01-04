<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <?php
                $data = array(
                    'name'     => '',
                    'email'    => '',
                    'password' => '',
                    'role'     => ''
                );

                $url = '/usuarios/salvar';

                if(isset($user)) {
                    $data = array(
                        'name'     => $user[0]->name,
                        'email'    => $user[0]->email,
                        'password' => '',
                        'role'     => $user[0]->role
                    );

                    $url = '/usuarios/alterar';
                }
            ?>
            <form action="<?= $url?>" method="post">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nome" value="<?= $data['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" value="<?= $data['email'] ?>">
                </div>              
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password">Acesso</label>
                    <select class="form-control">
                        <option value="admin" <?= $data['role'] == 'admin' ? 'selected="selected"' : ''?>>Admin</option>
                        <option value="user" <?= $data['role'] == 'user' ? 'selected="selected"' : ''?>>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>
                <?= anchor('usuarios', " <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i> Cancelar</button>"); ?>
            </form>

        </div>
    </div>
</div>