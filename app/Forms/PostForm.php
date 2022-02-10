<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('remember_me', 'checkbox')
            ->add('submit', 'submit');
    }
}
