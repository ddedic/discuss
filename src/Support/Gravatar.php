<?php

namespace Laravelish\Discuss\Support;

class Gravatar
{
    /**
     * Get Gravatar image by email.
     *
     * @param  string $email
     * @param  int    $size
     * @param  int    $rating [g|pg|r|x]
     * @return string
     */
    public static function image($email, $size = 200, $rating = 'g')
    {
        $id = md5(strtolower(trim($email)));

        $default = config('comments.default_gravatar') ?: 'monsterid';

        return "http://www.gravatar.com/avatar/{$id}/?d={$default}&s={$size}&r=$rating";
    }
}
