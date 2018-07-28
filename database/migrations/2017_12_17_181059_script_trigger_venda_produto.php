<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScriptTriggerVendaProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION VENDA_PRODUTO_VEP_TOTAL_FUNC() RETURNS trigger AS $VENDA_PRODUTO_VEP_TOTAL_FUNC$
            BEGIN
                NEW.VEP_PRECO = (SELECT PRO_PRECO FROM PRODUTO WHERE ID = NEW.ID_PRODUTO); 
                NEW.VEP_TOTAL = ((NEW.VEP_QTDE * NEW.VEP_PRECO) - NEW.VEP_DESCONTO);
                UPDATE PRODUTO SET PRO_ESTOQUE = (PRO_ESTOQUE - NEW.VEP_QTDE) WHERE ID = NEW.ID_PRODUTO; 
        
                RETURN NEW;
            END;
            $VENDA_PRODUTO_VEP_TOTAL_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER VENDA_PRODUTO_VEP_TOTAL_TRG BEFORE INSERT OR UPDATE ON VENDA_PRODUTO
            FOR EACH ROW EXECUTE PROCEDURE VENDA_PRODUTO_VEP_TOTAL_FUNC();
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION VENDA_VDA_VALOR_FUNC() RETURNS trigger AS $VENDA_VDA_VALOR_FUNC$
            BEGIN
                UPDATE VENDA SET VDA_VALOR = (SELECT SUM(VEP_PRECO * VEP_QTDE) FROM VENDA_PRODUTO WHERE ID_VENDA = NEW.ID_VENDA) 
                WHERE ID = NEW.ID_VENDA;

                UPDATE VENDA SET VDA_DESCONTO = (SELECT SUM(VEP_DESCONTO) FROM VENDA_PRODUTO WHERE ID_VENDA = NEW.ID_VENDA) 
                WHERE ID = NEW.ID_VENDA;   

                RETURN NEW;
            END;
            $VENDA_VDA_VALOR_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER COMPRA_CPR_VALOR_TRG AFTER INSERT OR UPDATE ON VENDA_PRODUTO
            FOR EACH ROW EXECUTE PROCEDURE VENDA_VDA_VALOR_FUNC();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
