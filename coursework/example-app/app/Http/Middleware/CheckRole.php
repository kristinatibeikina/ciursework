<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Получить текущего аутентифицированного пользователя
        $user = $request->user();

        // Проверить, имеет ли пользователь одну из заданных ролей
        if ($user && in_array($user->id_role, $roles)) {
            return $next($request);
        }

        // Возвращаем ошибку "Доступ запрещен"
        return response()->json(['error' => 'Доступ запрещен'], 403);
    }
}

