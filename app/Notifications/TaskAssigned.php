<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssigned extends Notification
{
    use Queueable;
    
    protected $task;


    /**
     * Create a new notification instance.
     */
    public function __construct($task)
    {
        $this->task = $task;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    
    {
        return (new MailMessage)
                        ->subject('New Task Assigned')
                        ->line('A new task has been assigned to you.')
                        ->action('View Task', url(route('tasks.solve', $this->task->id)))
                        ->line('Lead: ' . $this->task->lead->name) // Add lead's name here
                         ->line('Thank you for using our CRM system!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
   
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'description' => $this->task->description,
            'lead_name' => $this->task->lead->name, // Include lead's name here

        ];
    }
}
