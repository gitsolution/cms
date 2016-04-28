<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use DB;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */

   
    public function boot(GateContract $gate)
    {
        /******************obtener roles*********************/
        

        /****************** Reglas para acceso de usuarios con roles ******************************/
        $gate->define('verificar-rol',function($User)
        {            
            $b=False;
            $roles=DB::table('usr_login_roles')->whereid_login($User->id)->whereactive(1)->get();

            if($roles!=null)
            {
                $b=True;
            }

            if($User->email=="admin@admin")
                {$b=True;}    

         return $b;
        });

        /****************Reglas para admin**********************/
        $gate->define('nuevos-comentarios',function($User)
        {   
            $b=True;
            return $b;
        });

        $gate->define('nuevos-usuario',function($User)
        {            
            /*$permisos='admin.nuevo';
            $json = DB::table('cms_categories')     
            ->select('cms_categories.title', 'cms_categories.hits')    
            ->where('cms_categories.active', '=', 1)->get();*/

            $b=True;
            return $b;
        });

        $gate->define('total-albums',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('graficas',function($User)
        {            
            $b=True;
            return $b;
        });

        /****************Reglas para menu**********************/
        $gate->define('menus.Modulodemenu',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Menús.ModulodeMenú:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}            
            
            return $b;
        });

        $gate->define('menu.Crear',function($User)
        {           
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Menú.Crear:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}            
            
            return $b;
        });

        $gate->define('menu.editar',function($User)
        { 
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Menú.Editar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}            
            return $b;
        });

        $gate->define('menu.eliminar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Menú.Eliminar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('menu.elementos',function($User)
        {    
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Menú.Elementos:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('menu.ordenar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Menú.Ordenar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para publicaciones**********************/

        $gate->define('Publicaciones.ModulodePublicaciones',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Publicaciones.ModulodePublicaciones:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para tipos**********************/
        $gate->define('Tipos.Submodulodetipos',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Tipos.Submodulodetipos:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('admin.Tipos.Crear',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
           
            $ca='admin.Tipos.Crear:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('tipos-editar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
           
            $ca='admin.Tipos.Editar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('tipos-eliminar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
           
            $ca='admin.Tipos.Eliminar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para secciones**********************/
        $gate->define('Secciones.SubmodulodeSecciones',function($User)
        {            
           $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Secciones.SubmodulodeSecciones:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Secciones.Crear',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
           
            $ca='admin.Secciones.Crear:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Secciones.editar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
           
            $ca=',admin.Secciones.Editar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Secciones.eliminar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);

            $ca='admin.Secciones.Eliminar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Secciones.ordenar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);

            $ca='admin.Secciones.ordenar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Secciones.acceso',function($User)
        {    
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);

            $ca='admin.Secciones.acceso:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Secciones.publicar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);

            $ca='admin.Secciones.Publicar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para categorias**********************/
        $gate->define('Categorias.SubmodulodeCategorias',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Categorias.SubmodulodeCategorias:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Categorias.Crear',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Categorias.Crear:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Categorias.Editar',function($User)
        {            
           $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca=',admin.Categorias.Editar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Categorias.Eliminar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);

            $ca=',admin.Categorias.Eliminar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Categorias.ordenar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Categorias.ordenar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Categorias.acceso',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Categorias.acceso:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Categorias.Publicar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Categorias.Publicar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para documentos**********************/
        $gate->define('Documentos.SubmodulodeDocumentos',function($User)
        {            
             $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Documentos.SubmodulodeDocumentos:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Documentos.Crear',function($User)
        {            
           $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Documentos.Crear:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Documentos.Editar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Documentos.Editar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Documentos.Eliminar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Documentos.Eliminar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Documentos.ordenar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Documentos.ordenar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Documentos.acceso',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Documentos.acceso:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Documentos.Publicar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Documentos.Publicar:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para comentarios**********************/
        $gate->define('Comentarios.SubmodulodeComentarios',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);            
            $ca='admin.Comentarios.SubmodulodeComentarios:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Comentarios.Publicar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Comentarios.Publicar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Comentarios.Eliminar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            
            $ca='admin.Comentarios.Eliminar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para archivos**********************/
        $gate->define('archivos',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Archivos.ModulodeArchivos:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para albums**********************/
        $gate->define('Albums.SubmodulodeAlbums',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);    
            $ca='admin.Albums.SubmodulodeAlbums:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Albums.Creargaleria',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Albums.Creargaleria:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Albums.Subirimagenes',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Albums.Subirimagenes:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Albums.ordenar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Albums.ordenar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Albums.Publicar',function($User)
        {            
             $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Albums.Publicar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Albums.Colocaralinicio',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Albums.Colocaralinicio:true';

            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Albums.Editar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Albums.Editar:true';

            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Albums.Eliminar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);

            $ca='admin.Albums.Eliminar:true';

            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('albums-imagenes',function($User)
        {            
            $b=True;
            return $b;
        });

         /****************Reglas para directorio**********************/
        $gate->define('Directorio.SubmodulodeDirectorio',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Directorio.SubmodulodeDirectorio:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('directorio.Nuevo',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Albums.Eliminar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('directorio-editar',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('directorio-eliminar',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('directorio-inicio',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('directorio-publicado',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('directorio-orden',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('directorio-archivo',function($User)
        {            
            $b=True;
            return $b;
        });

        /****************Reglas para usuario**********************/
        $gate->define('Usuarios.ModulodeUsuarios',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Usuarios.ModulodeUsuarios:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Usuarios.SubmodulodeUsuarios',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Usuarios.SubmodulodeUsuarios:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Usuarios.Crear',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Usuarios.Crear:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Usuarios.Editar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Usuarios.Editar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Usuarios.Asignarroles',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Usuarios.Asignarroles:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Usuarios.Asignarpermisosespeciales',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Usuarios.Asignarpermisosespeciales:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        /****************Reglas para roles**********************/
        $gate->define('Roles.SubmodulodeRoles',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Roles.SubmodulodeRoles:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Roles.Crear',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Roles.Crear:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Roles.Editar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);

            $ca='admin.Roles.Editar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Roles.Eliminar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Roles.Eliminar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('roles-activo',function($User)
        {            
            $b=True;
            return $b;
        });

        /****************Reglas para modulos**********************/
        $gate->define('Módulos.Asignarpermisos',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Módulos.Asignarpermisos:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('modulos-nuevo',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('modulos-editar',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('modulos-eliminar',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('modulos-especiales',function($User)
        {            
            $b=True;
            return $b;
        });

        $gate->define('modulos-submenus',function($User)
        {            
            $b=True;
            return $b;
        });

        /****************Reglas para configuracion permisos**********************/
        $gate->define('Configuración.Asignarpermisosamodulos',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Configuración.Asignarpermisosamodulos:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });
        
        /****************Reglas para configuracion**********************/
        $gate->define('Configuraciónes.Modulodeconfiguraciondemetas',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Configuraciónes.Modulodeconfiguraciondemetas:true';
            $resultado = strpos($p, $ca);
           

            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;
        });

        $gate->define('Configuraciónes.Crearmetas',function($User)
        {            
             $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Configuraciónes.Crearmetas:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;    
        });

        $gate->define('Configuraciónes.Editar',function($User)
        {            
          $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Configuraciónes.Editar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;    
        });

        $gate->define('Configuraciónes.Eliminar',function($User)
        {            
            $permisoC="";
          $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login($User->id)
            ->whereactive(1)->get();
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null){
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            $ca='admin.Configuraciónes.Eliminar:true';
            $resultado = strpos($p, $ca);
            if($resultado==null){$b=False;}
            else{$b=True;}if($User->email=="admin@admin"){$b=true;}  
            return $b;    
        });
    }
}
