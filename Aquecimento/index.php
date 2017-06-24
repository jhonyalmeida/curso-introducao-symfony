<!DOCTYPE html>
<?php
    require 'Produto.php';

    $categoria = new Categoria('Eletrodoméstico');
    
    $itens = [
        new Produto('X-Mignon', '', 12.50, $categoria),
        new Produto('X-Galinha', '', 11.50, $categoria),
        new Produto('X-Burger', '', 9.50, $categoria),
        new Produto('X-Salada', '', 10, $categoria),
        new Produto('X-Coração', '', 11.50, $categoria),
        new Produto('X-Galinha Plus', '', 12, $categoria),
        new Produto('Salada Simples', '', 5, $categoria),
        new Produto('Fritas Pequena', '', 9, $categoria),
        new Produto('Fritas Grande', '', 12, $categoria)
    ];
    
    $filtro = $_GET['filtro'];
    
    $teste = function($nome) { 
        echo "<h1>$nome</h1>";
    };
    $message = $teste('Jhony');
    
    $resultados = array_filter($itens, function($i) use ($filtro) {
        return !$filtro || strstr(strtolower($i->getNome()), strtolower($filtro));
    });
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Revisão</title>
    </head>
    <body>
        <div>
            <?= $message ?>
        </div>
        <ul>
            <?php foreach($resultados as $item): ?>
                <li> <?= $item->getNome() . ': R$ ' . $item->getPreco() ?> </li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>
