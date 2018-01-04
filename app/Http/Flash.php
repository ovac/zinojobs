<?php

namespace App\Http;

/**
 * Display Flash Message
 *
 */
class Flash
{

    protected $title;
    protected $message;
    protected $level;
    protected $flashkey;

    public function create($title, $message, $level, $flashKey = 'flash_message')
    {

        session()->flash($flashKey, [
            'title' => $title,
            'level' => $level,
            'html' => $this->message,
        ]);

    }
    public function info($title, $message)
    {
        $this->create($title, $message, 'info');
    }
    public function success($title, $message)
    {
        $this->create($title, $message, 'success');
    }
    public function error($title, $message)
    {
        $this->create($title, $message, 'error');
    }
    public function overlay($title, $message, $level = 'success', $flashKey = 'flash_message_overlay')
    {
        $this->create($title, $message, $level, $flashKey);
    }

    public function titleAs($title)
    {
        $this->title = $title;
        return $this;
    }

    public function withMessages($messages)
    {

        $message = '';

        foreach ($messages as $error) {
            $message .= "<li>{$error}</li>";
        }

        $this->message = "<ul class='bs text-left'>{$message}</ul>";

        return $this;
    }

    public function withMessage($message)
    {

        $this->message = $message;
        return $this;

    }

    public function createFlash($level, $flashKey = 'flash_message_overlay')
    {
        $this->create(
            $this->title,
            $this->message,
            $level,
            $flashKey);
    }

    public static function make()
    {
        return new self;
    }
}
