<?php
@$ordem = $_GET["ordem"] ? $_GET["ordem"] : 0;
@$pesq = $_GET["pesq"] ? $_GET["pesq"] : "";
@$campo = $_GET["campo"] ? $_GET["campo"] : "";
?>

<h1>Lista de categorias</h1>
<div class="base-lista">
    <div class="cx-lista">
        <form action="index.php" method="get" name="buscausuario" id="buscausuario">
            <table border="0">
                <tbody>
                    <tr>
                        <th width="16%"><strong>Buscar:</strong></th>
                        <th width="60%"><input type="text" name="pesq" value="<?php echo $pesq ?>"/></th>
                        <th>
                            <select name="campo">
                                 
                                <option value="categoria">Categoria</option>           
                                <option value="ativo_categoria">Ativo (S ou N)</option>  
                                 
                            </select></th>
                <input type="hidden" name="link" value="2"  />
                <th><input type="submit" name="Submit" value="" class="but" /></th>
                </tr>
                </tbody>
            </table>
        </form>


        <h2>Lista de Categorias</h2>
        <a href="index.php?link=3">Cadastrar Categoria </a>
        <p class="limpar">&nbsp;</p>

        <?php
        if ($pesq != "") {
            $sql1 = "SELECT id_categoria FROM categorias WHERE $campo LIKE '%$pesq%'";
            $sql2 = "SELECT * FROM categorias WHERE $campo LIKE '%$pesq%'";
            $complemento = "&pesq=$pesq&campo=$campo";
        } else {
            $sql1 = "SELECT id_categoria FROM categorias";
            $sql2 = "SELECT * FROM categorias";
            $complemento = "";
        }
        
        $total = total($sql1);
        echo "Total: " . $total . "<br>";
        
        //Linhas por página
        $lpp = 4;
        $inicio = $ordem * $lpp;
       
        if ($total <= 0) {
            echo "Não existem dados cadastrados";
        } else {
            ?>
            <table width="100%" border="0" cellpadding="2" cellspacing="2">
                <tbody>
                    <tr>
                        <td align="center" class="tdbc">id</td>
                        <td align="center" class="tdbc">Nome da categoria</td>
                        <td align="left" class="tdbc">Ativo</td>
                        <td align="center" colspan="2" class="tdbc">Ação</td>
                    </tr>
                    <?php
                    $categorias = selecionar($sql2." LIMIT $inicio, $lpp");
                    
                    $i=1;
                    foreach ($categorias as $categoria) {
                        //zebramento na tabela
                        $i++;
                        if($i%2 == 0)
                            $col="coluna1";
                        else
                            $col="coluna2";
                        ?>
                        <tr class="<?php echo $col?>">
                            <td><?php echo $categoria["id_categoria"] ?></td>
                            <td><?php echo $categoria["categoria"] ?></td>
                            <td><?php echo $categoria["ativo_categoria"] ?></td>
                            <td align="center"><a href="index.php?link=3&acao=Alterar&id=<?php echo $categoria["id_categoria"] ?>">Editar</a></td>
                            <td align="center"><a href="index.php?link=3&acao=Excluir&id=<?php echo $categoria["id_categoria"] ?>" class="excluir">Excluir</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>

            </tbody>
        </table>

        <div class="cx-paginacao">
           <?php echo mostraPaginacao("index.php?link=2$complemento", $ordem, $lpp, $total) ?>
        </div>

        <p>&nbsp;</p>
        <p>&nbsp;</p>

    </div>
</div>