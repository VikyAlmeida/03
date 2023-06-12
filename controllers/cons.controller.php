<?php
class ControllerConst{
    public function getRoutes()
    {
        $routes = [
            "public" => ["home", "categories", "establishments"],
            "login" => ["login", "register", "forgotPassword", "code"],
            "private" => ["menu", "logout"]
        ];
        return $routes;
    }
}