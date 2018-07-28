<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScriptTriggerVendaPagto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION VENDA_PAGTO_VDP_VALOR_FUNC() RETURNS trigger AS $VENDA_PAGTO_VDP_VALOR_FUNC$
            BEGIN
                NEW.VDP_VALOR = (SELECT VDA_TOTAL FROM VENDA WHERE ID = NEW.ID_VENDA); 
        
                RETURN NEW;
            END;
            $VENDA_PAGTO_VDP_VALOR_FUNC$ LANGUAGE plpgsql;

            CREATE TRIGGER VENDA_PAGTO_VDP_VALOR_TRG BEFORE INSERT OR UPDATE ON VENDA_PAGTO
            FOR EACH ROW EXECUTE PROCEDURE VENDA_PAGTO_VDP_VALOR_FUNC();
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
