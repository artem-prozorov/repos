<?php

if (! function_exists('repo_query')) {
    function repo_query()
    {
        return new \Prozorov\Repositories\Query();
    }
}
