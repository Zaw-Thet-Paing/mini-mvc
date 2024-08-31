<?php

class UserController extends Controller {
    public function index() {
        $user = new User();
        $users = $user->all();
        return View::render('users/index', ['users' => $users]);
    }

    public function create() {
        return View::render('users/create');
    }

    public function store() {
        $user = new User();
        $user->create([
            'name'=> request('name'),
            'email'=> request('email')
        ]);
        return Redirect::to('/users');
    }

    public function edit($id)
    {
        $user = new User();
        $user = $user->find(htmlspecialchars($id));
        return View::render('users/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $user = new User();
        $user->update($id, [
            'name'=> request('name'),
            'email'=> request('email')
        ]);

        return Redirect::to('/users');
    }

    public function delete($id)
    {
        $user = new User();
        $user->delete($id);
        return Redirect::to('/users');
    }
}