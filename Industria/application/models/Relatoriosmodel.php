<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatoriosmodel extends CI_Model {

    public function relatorio_itens_produzidos_custo($data_inicio, $data_fim){
        $this->db->select('tmp_custo.codigo');
        $this->db->select('tmp_custo.nome');
        $this->db->select('tmp_custo.quantidade');
        $this->db->select('tmp_custo.custo_atual');
        $this->db->select('sum(tmp_custo.custo_total/tmp_custo.quantidade) as custo_medio,');
        $this->db->select('tmp_custo.custo_total');
        $result = $this->db->get('(select
        i.codigo_item as codigo,
        p.nome as nome,
        p.preco_custo as custo_atual,
        sum(i.quantidade_produzida) as quantidade,
        sum(i.custo_total) as custo_total
        from itensordemproducao i
        join produtos p on p.codigo = i.codigo_item
        join ordemproducao op on i.numero_ordem = op.codigo
        where op.data_finalizacao >= "'.$data_inicio.'"
        and op.data_finalizacao <= "'.$data_fim.'"
        group by 1, 2) as tmp_custo
        group by 1, 2, 3, 4')->result();
        return $result;
    }
   
 }