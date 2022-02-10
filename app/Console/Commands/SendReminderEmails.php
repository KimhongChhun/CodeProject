<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;

// class SendReminderEmails extends Command
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'reminder:emails';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description = 'Send email notification to user about reminders.';

//     /**
//      * Create a new command instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         parent::__construct();
//     }

//     /**
//      * Execute the console command.
//      *
//      * @return int
//      */
//     public function handle()
//     {
//         //Get all reminders for today 
//         $reminders = Reminder::query()
//         ->with(['lead'])
//         ->where( column: 'reminder_date', now()->format( format:' Y-m-d'))
//         ->where( column:'status',operator:'pending')
//         ->orderBy( column:'user_id')
//         ->get();

//         //get group by user
//         $data = [];
//         foreach ($reminders as reminder){
//             $data[$reminder->user_id][] = $reminder->toArray();
//         }

//         //send email
        
//     }
// }
