<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;

class Features extends Component
{
    #[Locked]
    public $taskConditionsTabs = [
        [
            'title' => 'Username Authorization Bearer Token',
            'content' => 'Added a <strong class="text-gray-800 dark:text-gray-200">middleware</strong> to the Authorization Bearer Token to check if contains the username of registered user in base64 format. Check out the middeware on <i class="text-gray-800 dark:text-gray-200">app/Http/Middleware/UsernameOnAuthHeader.php</i>',
            'icon' => 'check',
        ],
        [
            'title' => 'Application GUI',
            'content' => 'Contains beautiful and responsive GUI for the application. It is built using Tailwind CSS and Livewire',
            'icon' => 'check',
        ],
        [
            'title' => 'Migation and Seeder',
            'content' => 'Contain database migration and seeder for all of the database tables. Check out the migration and seeder on <i class="text-gray-800 dark:text-gray-200">database/migrations/*</i> and <i class="text-gray-800 dark:text-gray-200">database/seeders/DatabaseSeeder.php</i>',
            'icon' => 'check',
        ],
        [
            'title' => 'Laravel Livewire',
            'content' => 'Using latest Laravel Livewire for building application UI components.',
            'icon' => 'check',
        ],
        [
            'title' => 'Docker Compose',
            'content' => 'Using <strong class="text-gray-800 dark:text-gray-200">Docker Compose</strong> for running the application in a containerized environment. Check out the <i class="text-gray-800 dark:text-gray-200">docker-compose.yml</i> file on the root of the project.',
            'icon' => 'check',
        ],
        [
            'title' => 'User Wallet',
            'content' => 'Contain function used to update Customer Wallet Asynchronously and without overlapping each other. Check out the <strong class="text-gray-800 dark:text-gray-200">controller</strong> on <i class="text-gray-800 dark:text-gray-200">app/Http/Controllers/TransactionController.php</i> or on the <i class="text-gray-800 dark:text-gray-200">app/Livewire/Dashboard.php</i> for livewire implementation via <strong class="text-gray-800 dark:text-gray-200">server action</strong>.',
            'icon' => 'check',
        ],
        [
            'title' => 'Response and Request Parameters',
            'content' => 'JSON request and response parameters is build based on the requirements. Check out the controller on <i class="text-gray-800 dark:text-gray-200">app/Http/Controllers/TransactionController.php</i>',
            'icon' => 'check',
        ]
    ];
    public $todosTabs = [
        [
            'title' => 'Test the project to maximum coverage',
            'content' => 'Test the project to maximum coverage using Pest and Laravel Dusk.',
            'icon' => 'uncheck',
        ],
        [
            'title' => 'Deploy the project',
            'content' => 'Deploy the project to a <strong class="text-gray-800 dark:text-gray-200">production environment</strong> via AWS cloud services.',
            'icon' => 'uncheck',
        ],
        [
            'title' => 'CI/CD pipeline',
            'content' => 'Create a CI/CD pipeline for the project using Github Actions.',
            'icon' => 'uncheck',
        ],
    ];
    public $otherFeatures = [
        [
            'title' => 'Authentication',
            'content' => 'Using <strong class="text-gray-800 dark:text-gray-200">Laravel Breeze</strong> for user authentication. <strong class="text-gray-800 dark:text-gray-200">Middleware</strong> is added to check if the user is authenticated or not.',
        ],
        [
            'title' => 'UI Dark Mode',
            'content' => 'Added a dark mode feature for the application. The user can toggle between light and dark mode via a button on user dropdown.',
        ],
        [
            'title' => 'Models Authorization',
            'content' => 'Added <strong class="text-gray-800 dark:text-gray-200">Policies</strong> for all models in the application, for ensuring no user can make unauthorized request. Check out the policies on <i class="text-gray-800 dark:text-gray-200">app/Policies/*</i>',
        ],
        [
            'title' => 'Email Notification',
            'content' => 'Added email notification system for user authentication and more. Please add your email credentials on <i class="text-gray-800 dark:text-gray-200">.env</i> like file to use the email notification.',
        ]
    ];

    public function render()
    {
        return view('livewire.pages.features');
    }
}
