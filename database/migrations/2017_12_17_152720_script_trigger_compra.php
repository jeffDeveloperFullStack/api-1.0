<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScriptTriggerCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION COMPRA_CPR_TOTAL_FUNC() RETURNS trigger AS $COMPRA_CPR_TOTAL_FUNC$
            BEGIN
                NEW.CPR_TOTAL = (NEW.CPR_VALOR - NEW.CPR_DESCONTO); 

                RETURN NEW;
            END;
                $COMPRA_CPR_TOTAL_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER COMPRA_CPR_TOTAL_TRG BEFORE UPDATE OR INSERT ON COMPRA
            FOR EACH ROW EXECUTE PROCEDURE COMPRA_CPR_TOTAL_FUNC();

        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION COMPRA_PRODUTO_DELETE_VEP_TOTAL_FUNC() RETURNS trigger AS $COMPRA_PRODUTO_DELETE_VEP_TOTAL_FUNC$
            BEGIN
                UPDATE PRODUTO SET PRO_ESTOQUE  = (PRO_ESTOQUE - OLD.CPP_QTDE) WHERE ID = OLD.ID_PRODUTO; 
                UPDATE COMPRA  SET CPR_VALOR    = (CPR_VALOR - (OLD.CPP_PRECO * OLD.CPP_QTDE)), CPR_DESCONTO = (CPR_DESCONTO - OLD.CPP_DESCONTO) WHERE ID = OLD.ID_COMPRA;
               
                RETURN OLD;
            END;
            $COMPRA_PRODUTO_DELETE_VEP_TOTAL_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER COMPRA_PRODUTO_DELETE_VEP_TOTAL_TRG BEFORE DELETE ON COMPRA_PRODUTO
            FOR EACH ROW EXECUTE PROCEDURE COMPRA_PRODUTO_DELETE_VEP_TOTAL_FUNC();
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
