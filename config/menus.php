<?php

return [
    [
        "name"         => "user",
        "display_name" => "Manage User",
        "controller"   => "UserController",
        "action"       => ["read", "create", "edit", "update", "delete", "reset-password"],
        "parent"       => "settings",
        "usages"       => ["main"]
    ],
    [
        "name"         => "role",
        "display_name" => "Manage Role",
        "controller"   => "RoleController",
        "action"       => ["read", "create", "edit", "update", "delete"],
        "parent"       => "settings",
        "usages"       => ["main"]
    ]
];
