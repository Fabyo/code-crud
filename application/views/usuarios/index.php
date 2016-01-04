<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Novo</button><hr/>

            <table class="table table-striped table-bordered table-hover table-condensed">
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Acesso</th>
                    <th>Opcoes</th>
                </tr>
                <tbody>
                    <?php
                        foreach($results as $user)
                        {
                            echo "<tr>";
                            echo "<td>$user->id</td>";                                
                            echo "<td>$user->name</td>";
                            echo "<td>$user->email</td>";
                            echo "<td>$user->role</td>";
                            echo "<td>";
                            echo anchor('usuarios/editar/'. $user->id, " <button type=\"button\" class=\"btn btn-warning btn-xs\"><i class=\"fa fa-pencil\"></i></button>");
                            echo " <button type=\"button\" data-id=\"$user->id\" class=\"btn btn-danger btn-xs deletar\"><i class=\"fa fa-times\"></i></button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                <tbody>
            </table>
            <div class="col-md-10 text-center">
                <?= $links; ?>
            </div>            
        </div>
    </div>
</div>
