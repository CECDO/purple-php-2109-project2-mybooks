<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)

return [
    '' => ['BookController', 'dashboard',],
    'books' => ['BookController', 'searchbar', ['title']],
    'book' => ['BookController', 'book', ['id']],
    'book/delete' => ['BookController', 'deleteBook', ['id']],
    'book/add' => ['BookController', 'addBook'],
    'author/add' => ['BookController', 'addAuthor'],
    'editor/add' => ['BookController', 'addEditor'],
    'category/add' => ['BookController', 'addCategory'],
    'location/add' => ['BookController', 'addLocation'],
];
