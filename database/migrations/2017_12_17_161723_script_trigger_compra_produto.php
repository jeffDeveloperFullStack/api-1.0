<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScriptTriggerCompraProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION COMPRA_PRODUTO_CPP_TOTAL_FUNC() RETURNS trigger AS $COMPRA_PRODUTO_CPP_TOTAL_FUNC$
            BEGIN
                NEW.CPP_PRECO = (SELECT PRO_CUSTO FROM PRODUTO WHERE ID = NEW.ID_PRODUTO); 
                NEW.CPP_TOTAL = ((NEW.CPP_QTDE * NEW.CPP_PRECO) - NEW.CPP_DESCONTO);
                UPDATE PRODUTO SET PRO_ESTOQUE = (PRO_ESTOQUE + NEW.CPP_QTDE) WHERE ID = NEW.ID_PRODUTO; 
        
                RETURN NEW;
            END;
            $COMPRA_PRODUTO_CPP_TOTAL_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER COMPRA_PRODUTO_CPP_TOTAL_TRG BEFORE INSERT OR UPDATE ON COMPRA_PRODUTO
            FOR EACH ROW EXECUTE PROCEDURE COMPRA_PRODUTO_CPP_TOTAL_FUNC();
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION COMPRA_CPR_VALOR_FUNC() RETURNS trigger AS $COMPRA_CPR_VALOR_FUNC$
            BEGIN
                UPDATE COMPRA  SET CPR_VALOR = (SELECT SUM(CPP_PRECO * CPP_QTDE) FROM COMPRA_PRODUTO WHERE ID_COMPRA = NEW.ID_COMPRA) 
                WHERE ID = NEW.ID_COMPRA; 

                UPDATE COMPRA  SET CPR_DESCONTO = (SELECT SUM(CPP_DESCONTO) FROM COMPRA_PRODUTO WHERE ID_COMPRA = NEW.ID_COMPRA) 
                WHERE ID = NEW.ID_COMPRA;    

                RETURN NEW;
            END;
            $COMPRA_CPR_VALOR_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER COMPRA_CPR_VALOR_TRG AFTER INSERT OR UPDATE ON COMPRA_PRODUTO
            FOR EACH ROW EXECUTE PROCEDURE COMPRA_CPR_VALOR_FUNC();
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
