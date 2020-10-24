<?php

namespace App\Transform;

class TransformUser extends Transform
{

    public function mapperDetail($table)
    {
        $data["user"] = [
                'nama'  => $table->name,
                'username'  => $table->username,
                'email' => $table->email,
                'created_at' => $table->created_at
        ];

        return $data;
    }

}