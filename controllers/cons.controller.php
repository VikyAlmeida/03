<?php
class ControllerConst{
    public function getRoutes()
    {
        $routes = [
            "public" => ["home"],
            "login" => ["login", "register", "forgotPassword", "code"],
            "private" => ["menu", "logout"]
        ];
        return $routes;
    }
}