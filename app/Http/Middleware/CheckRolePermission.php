<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user  = Auth::user();
        $route = $request->route()[1]['uses'];

        if ($route) {
            $controller                = class_basename($route);
            list($controller, $action) = explode('@', $controller);
            $replace         = preg_replace('/(?<=\\w)(?=[A-Z])/', "-$1", $controller);
            $cont_name       = strtolower(str_replace('-Controller', '', $replace));
            $warning_message = "Permission failed to access the page!";

            $permission_type = [
                // read
                "index"     => "read-" . $cont_name,
                "edit"      => "read-" . $cont_name,
                "details"   => "read-" . $cont_name,
                "show"      => "read-" . $cont_name,
                "printout"  => "read-" . $cont_name,
                "reports"   => "read-" . $cont_name,

                // create
                "add"       => "create-" . $cont_name,
                "create"    => "create-" . $cont_name,
                "store"     => "create-" . $cont_name,

                // update
                "put"       => "update-" . $cont_name,
                "update"    => "update-" . $cont_name,

                // delete
                "remove"    => "delete-" . $cont_name,
                "delete"    => "delete-" . $cont_name,
                "destroy"   => "delete-" . $cont_name,

                // export import
                "import"    => "import-" . $cont_name,
                "template"  => "import-" . $cont_name,
                "export"    => "export-" . $cont_name,
            ];

            if (!$user->can($permission_type[strtolower($action)])) {
                return response()->json(
                    array(
                        "message" => $warning_message,
                        "action"  => $permission_type[strtolower($action)]
                    ),
                    403
                );
            }
        }

        return $next($request);
    }
}
