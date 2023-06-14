<?php
class ControllerConst{
    public function getRoutes()
    {
        $routes = [
            "public" => ["home", "categories", "establishments", "establishment"],
            "login" => ["login", "register", "forgotPassword", "code"],
            "private" => ["menu", "logout", "preview", "previewEstablishment"]
        ];
        return $routes;
    }
}