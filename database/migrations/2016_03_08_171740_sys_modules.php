<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\sys_module;

class SysModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sys_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_parent')->unsigned();
            $table->string('title',250);
            $table->text('description');
            $table->boolean('active');
            $table->integer('register_by');
            $table->integer('modify_by');
            $table->timestamps();
        });

        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Menús',
            'description'=>'Modulo para creacion de menus',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'1',
            'title'=>'Menú',
            'description'=>'Modulo para creacion de submenu',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Publicaciones',
            'description'=>'Publicaciones',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'3',
            'title'=>'Tipos',
            'description'=>'Tipos',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'3',
            'title'=>'Secciones',
            'description'=>'Secciones',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'3',
            'title'=>'Categorias',
            'description'=>'Categorias',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'3',
            'title'=>'Documentos',
            'description'=>'Publicaciones',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'3',
            'title'=>'Comentarios',
            'description'=>'Comentarios',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);


        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Archivos',
            'description'=>'Archivos',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'9',
            'title'=>'Albums',
            'description'=>'Albums',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'9',
            'title'=>'Directorio',
            'description'=>'Directorio',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Usuarios',
            'description'=>'Usuarios',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);


        sys_module::create([
            'id_parent'=>'12',
            'title'=>'Usuarios',
            'description'=>'Usuarios',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);


        sys_module::create([
            'id_parent'=>'12',
            'title'=>'Roles',
            'description'=>'Roles',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);


        sys_module::create([
            'id_parent'=>'12',
            'title'=>'Módulos',
            'description'=>'Módulos',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'12',
            'title'=>'Configuración',
            'description'=>'Configuración',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);


        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Configuraciónes',
            'description'=>'Configuraciónes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'17',
            'title'=>'Configuraciónes',
            'description'=>'Configuraciónes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Lenguajes',
            'description'=>'Lenguajes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'19',
            'title'=>'Lenguaje',
            'description'=>'Lenguaje',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Reservaciones',
            'description'=>'Configuraciónes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'21',
            'title'=>'Precios',
            'description'=>'Configuraciónes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'21',
            'title'=>'Reservaciones pagadas',
            'description'=>'Configuraciónes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Suscripciones',
            'description'=>'Configuraciónes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'24',
            'title'=>'Suscriptores',
            'description'=>'Configuraciónes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

        sys_module::create([
            'id_parent'=>'0',
            'title'=>'Inicio',
            'description'=>'Configuraciónes',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',
        ]);

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sys_modules');
    }
}
