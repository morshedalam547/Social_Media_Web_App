<?php

if (! function_exists('notifySuccess')) {
    function notifySuccess($message, $duration = 3000)
    {
        notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->duration($duration)
            ->success($message);
    }
}

if (! function_exists('notifyWarning')) {
    function notifyWarning($message, $duration = 3000)
    {
        notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->duration($duration)
            ->warning($message); // এখানে warning() ব্যবহার করা হলো
    }
}

if (! function_exists('notifyError')) {
    function notifyError($message, $duration = 3000)
    {
        notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->duration($duration)
            ->error($message);
    }
}
