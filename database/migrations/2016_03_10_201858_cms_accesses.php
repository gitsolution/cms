<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\cms_access;

class CmsAccesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sysmodule')->unsigned();
            $table->foreign('id_sysmodule')->references('id')->on('sys_modules');
            $table->text('title',250);
            $table->text('description');
            $table->boolean('active');
            $table->integer('register_by');
            $table->integer('modify_by');
            $table->timestamps();
        });

        cms_access::create([
                'id_sysmodule'=>'1',
                'title'=>'{"admin.menus.Modulo de Menú":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

        cms_access::create([
                'id_sysmodule'=>'2',
                'title'=>'{"admin.menu.Crear":false,"admin.menu.Editar":false,"admin.menu.Eliminar":false,"admin.menu.Ordenar":false,"admin.menu.Elementos":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

         cms_access::create([
                'id_sysmodule'=>'3',
                'title'=>'{"admin.menus.Modulo de Publicaciones":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

        cms_access::create([
                'id_sysmodule'=>'4',
                'title'=>'{"admin.tipos.Submodulo de tipos":false,"admin.tipos.Crear":false,"admin.tipos.Editar":false,"admin.tipos.Eliminar":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

         cms_access::create([
                'id_sysmodule'=>'5',
                'title'=>'{"admin.secciones.Submodulo de Secciones":false,"admin.secciones.Crear":false,"admin.secciones.Editar":false,"admin.secciones.Eliminar":false,"admin.secciones.ordenar":false,"admin.secciones.Publicar":false,"admin.secciones.acceso":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

          cms_access::create([
                'id_sysmodule'=>'6',
                'title'=>'{"admin.categorias.Submodulo de Categorias":false,"admin.categorias.Crear":false,"admin.categorias.Editar":false,"admin.categorias.Eliminar":false,"admin.categorias.ordenar":false,"admin.categorias.Publicar":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

           cms_access::create([
                'id_sysmodule'=>'7',
                'title'=>'{"admin.documentos.Submodulo de Documentos":false,"admin.documentos.Crear":false,"admin.documentos.Editar":false,"admin.documentos.Eliminar":false,"admin.documentos.ordenar":false,"admin.documentos.Publicar":false,"admin.documentos.acceso":false}',                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

            cms_access::create([
                'id_sysmodule'=>'8',
                'title'=>'{"admin.comentarios.Submodulo de Comentarios":false,"admin.comentarios.Publicar":false,"admin.comentarios.Eliminar":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

            cms_access::create([
                'id_sysmodule'=>'9',
                'title'=>'{"admin.menus.Modulo de Archivos":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

             cms_access::create([
                'id_sysmodule'=>'10',
                'title'=>'{"admin.albums.Submodulo de Albums":false,"admin.albums.Crear galeria":false,"admin.albums.Subir imagenes":false,"admin.albums.ordenar":false,"admin.albums.Publicar":false,"admin.albums.Colocar al inicio":false,"admin.albums.Editar":false,"admin.albums.Eliminar":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

              cms_access::create([
                'id_sysmodule'=>'11',
                'title'=>'{"admin.directorio.Submodulo de Directorio":false,"admin.directorio.Crear directorio":false,"admin.directorio.Subir archivos":false,"admin.directorio.Ordenar":false,"admin.directorio.Publicar":false,"admin.Colocar al inicio":false,"admin.directorio.Editar":false,"admin.directorio.Eliminar":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

              cms_access::create([
                'id_sysmodule'=>'12',
                'title'=>'{"admin.menus.Modulo de Usuarios":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

               cms_access::create([
                'id_sysmodule'=>'13',
                'title'=>'{"admin.usuarios.Submodulo de Usuarios":false,"admin.usuarios.Crear":false,"admin.usuarios.Editar":false,"admin.usuarios.Asignar roles":false,"admin.usuarios.Asignar permisos especiales":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

                cms_access::create([
                'id_sysmodule'=>'14',
                'title'=>'{"admin.roles.Submodulo de Roles":false,"admin.roles.Crear":false,"admin.roles.Editar":false,"admin.roles.Eliminar":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

                cms_access::create([
                'id_sysmodule'=>'15',
                'title'=>'{"admin.modulos.Asignar permisos":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

                cms_access::create([
                'id_sysmodule'=>'16',
                'title'=>'{"admin.configuracion.Asignar permisos a modulos":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

                cms_access::create([
                'id_sysmodule'=>'17',
                'title'=>'{"admin.menus.Modulo de configuracion de metas":false}',
                    'active'=>'1',
                    'register_by'=>'1',
                    'modify_by'=>'1',
                ]);

                cms_access::create([
                'id_sysmodule'=>'18',
                'title'=>'{"admin.configuraciones.Crear metas":false,"admin.configuraciones.Editar":false,"admin.configuraciones.Eliminar":false}',
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
        Schema::drop('cms_accesses');
    }
}
