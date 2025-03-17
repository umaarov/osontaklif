<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    private $professions = [
        'android' => 'Android',
        'vue' => 'Vue.js',
        'react' => 'React.js',
        'php' => 'PHP',
        'java' => 'Java',
        'python' => 'Python'
    ];

    private $questions = [
        'android' => [
            ['id' => 1, 'question' => 'What is an Activity in Android?', 'chance' => 'High'],
            ['id' => 2, 'question' => 'Explain the Android Activity Lifecycle.', 'chance' => 'Medium']
        ],
        'vue' => [
            ['id' => 1, 'question' => 'What is Vue.js and why is it used?', 'chance' => 'High'],
            ['id' => 2, 'question' => 'What are Vue directives?', 'chance' => 'Medium']
        ],
        'react' => [
            ['id' => 1, 'question' => 'What are React hooks?', 'chance' => 'High'],
            ['id' => 2, 'question' => 'Explain the Virtual DOM in React.', 'chance' => 'Medium']
        ],
        'php' => [
            ['id' => 1, 'question' => 'What is Laravel?', 'chance' => 'High'],
            ['id' => 2, 'question' => 'Explain MVC architecture in PHP.', 'chance' => 'Medium']
        ],
        'java' => [
            ['id' => 1, 'question' => 'What is JVM?', 'chance' => 'High'],
            ['id' => 2, 'question' => 'Difference between JDK, JRE, and JVM.', 'chance' => 'Medium']
        ],
        'python' => [
            ['id' => 1, 'question' => 'What is PEP 8?', 'chance' => 'High'],
            ['id' => 2, 'question' => 'Explain Python’s Global Interpreter Lock (GIL).', 'chance' => 'Medium']
        ],
    ];

    public function home()
    {
        return view('pages.home', ['professions' => $this->professions]);
    }

    public function profession($name)
    {
        if (!isset($this->questions[$name])) {
            abort(404);
        }

        return view('pages.profession', [
            'name' => $this->professions[$name],
            'questions' => $this->questions[$name]
        ]);
    }

    final function mock(): object
    {
        return view('pages.mock');
    }

    final function requirements(): object
    {
        return view('pages.requirements');
    }
}
