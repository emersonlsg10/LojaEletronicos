<?php
@$ordem = $_GET["ordem"] ? $_GET["ordem"] : 0;
@$pesq = $_GET["pesq"] ? $_GET["pesq"] : 0;
@$campo = $_GET["campo"] ? $_GET["campo"] : 0;
?>
<h1>Lista de subcategorias</h1>
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

                                <option value="subcategoria">subcategoria</option>           
                                <option value="ativo_subcategoria">Ativo (S ou N)</option>  

                            </select></th>
                <input type="hidden" name="link" value="4"  />
                <th><input type="submit" name="Submit" value="" class="but" /></th>
                </tr>
                </tbody>
            </table>
        </form>

        <p><a href="index.php?link=5">Cadastrar</a></p><br>
        <?php
        if ($pesq != "") {
            $sql1 = "SELECT id_subcategoria FROM subcategorias WHERE $campo LIKE '%$pesq%'";
            $sql2 = "SELECT * FROM categorias a, subcategorias s WHERE"
                    . " a.id_categoria = s.id_categoria AND $campo LIKE '%$pesq%'";
            $complemento = "&pesq=$pesq&campo=$campo";
        } else {
            $sql1 = "SELECT id_subcategoria FROM subcategorias";
            $sql2 = "SELECT * FROM categorias a, subcategorias s WHERE a.id_categoria = s.id_categoria";
            $complemento = "";
        }

        $total = total($sql1);

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
                        <td align="center" class="tdbc">Subcategoria</td>
                        <td align="center" class="tdbc">Categoria</td>
                        <td align="left" class="tdbc">Ativo</td>
                        <td align="center" colspan="2" class="tdbc">Ação</td>
                    </tr>
                    <?php
                    $subcategorias = selecionar($sql2 . " LIMIT $inicio, $lpp");
                    $i=1;
                    foreach ($subcategorias as $subcategoria) {
                         //zebramento na tabela
                        $i++;
                        if($i%2 == 0)
                            $col="coluna1";
                        else
                            $col="coluna2";
                        ?>       
                        <tr class="<?php echo $col?>">
                            <td><?php echo $subcategoria["id_subcategoria"] ?></td>
                            <td><?php echo $subcategoria["subcategoria"] ?></td>
                            <td><?php echo $subcategoria["id_categoria"] ?></td>
                            <td><?php echo $subcategoria["ativo_subcategoria"] ?></td>
                            <td><a href="index.php?link=5&acao=Alterar&id=<?php echo $subcategoria["id_subcategoria"] ?>">Editar</a></td>
                            <td><a href="index.php?link=5&acao=Excluir&id=<?php echo $subcategoria["id_subcategoria"] ?>" class="excluir">Excluir</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>	

            </tbody>
        </table>

        <div class="cx-paginacao">
            <p><?php echo mostraPaginacao("index.php?link=4$complemento", $ordem, $lpp, $total) ?></p>
        </div>

        <p>&nbsp;</p>
        <p>&nbsp;</p>

    </div>
</div>	