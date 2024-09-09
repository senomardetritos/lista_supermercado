<?php

class EmailListaCompras
{
    function getTexto($usuario, $lista, $lista_itens)
    {
        $html = '<h3>Olá ' . $usuario['email'] . '</h3>';
        $html .= '<h5>Segue abaixo sua lista de compras realizadas em ';
        $html .= date('d/m/Y', strtotime($lista['created_at']));
        $html .= ' às ';
        $html .= date('H:i', strtotime($lista['created_at']));
        $html .= '</h5>';
        $html .= '<table>';
        $html .= '<tr><th>Item</th><th>Quantidade</th><th>Preço</th><th>Total</th></tr>';
        $total = 0;
        foreach ($lista_itens as $item) {
            $html .= '<tr>';
            $html .= '<td>' . $item['nome'] . '</td>';
            $html .= '<td>' . $item['quantidade'] . '</td>';
            $html .= '<td align="right">R$ ' . $item['preco'] . '</td>';
            $html .= '<td align="right">R$ ' . ($item['quantidade'] * $item['preco']) . '</td>';
            $html .= '</tr>';
            $total += ($item['quantidade'] * $item['preco']);
        }
        $html .= '<tr><th align="left">Total</th><th></th><th></th><th align="right">R$ ' . $total . '</th></tr>';
        $html .= '</table>';
        return $html;
    }
}
