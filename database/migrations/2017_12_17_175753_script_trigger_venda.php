<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScriptTriggerVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION VENDA_VDA_TOTAL_FUNC() RETURNS trigger AS $VENDA_VDA_TOTAL_FUNC$
            BEGIN
                NEW.VDA_TOTAL = (NEW.VDA_VALOR - NEW.VDA_DESCONTO); 

                RETURN NEW;
            END;
                $VENDA_VDA_TOTAL_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER VENDA_VDA_TOTAL_TRG BEFORE UPDATE OR INSERT ON VENDA
            FOR EACH ROW EXECUTE PROCEDURE VENDA_VDA_TOTAL_FUNC();

        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION VENDA_PRODUTO_DELETE_VEP_TOTAL_FUNC() RETURNS trigger AS $VENDA_PRODUTO_DELETE_VEP_TOTAL_FUNC$
            BEGIN
                UPDATE PRODUTO SET PRO_ESTOQUE  = (PRO_ESTOQUE + OLD.VEP_QTDE) WHERE ID = OLD.ID_PRODUTO; 
                UPDATE VENDA   SET VDA_VALOR    = (VDA_VALOR - (OLD.VEP_PRECO * OLD.VEP_QTDE)), VDA_DESCONTO = (VDA_DESCONTO - OLD.VEP_DESCONTO) WHERE ID = OLD.ID_VENDA;
               
                RETURN OLD;
            END;
            $VENDA_PRODUTO_DELETE_VEP_TOTAL_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER VENDA_PRODUTO_DELETE_VEP_TOTAL_TRG BEFORE DELETE ON VENDA_PRODUTO
            FOR EACH ROW EXECUTE PROCEDURE VENDA_PRODUTO_DELETE_VEP_TOTAL_FUNC();
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
