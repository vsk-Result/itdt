<?php

// Главная
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('home'));
});

// Менеджер задач
Breadcrumbs::for('tasks', function ($trail) {
    $trail->push('Главная', route('home'));
    $trail->push('Менеджер задач');
});