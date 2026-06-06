<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Session;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Redirect helper
     */
    protected function redirect(string $url)
    {
        header("Location: " . $url);
        exit;
    }

    public function showLogin()
    {
        return $this->render('auth/login');
    }

    public function showSignup()
    {
        return $this->render('auth/signup');
    }

    public function signup()
    {
        $username = Request::input('username');
        $email = Request::input('email');
        $password = Request::input('password');

        if (!$username || !$email || !$password) {
            Session::flash('error', 'All fields are required.');
            return $this->redirect('/signup');
        }

        $existing = User::query("SELECT * FROM users WHERE email = :email OR username = :username", [
            'email' => $email,
            'username' => $username
        ]);

        if (!empty($existing)) {
            Session::flash('error', 'User already exists.');
            return $this->redirect('/signup');
        }

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password_hash = password_hash($password, PASSWORD_DEFAULT);
        $user->role = 'user';
        $user->save();

        Session::flash('success', 'Registration successful. Please log in.');
        return $this->redirect('/login');
    }

    public function login()
    {
        $email = Request::input('email');
        $password = Request::input('password');

        if (!$email || !$password) {
            Session::flash('error', 'Email and password are required.');
            return $this->redirect('/login');
        }

        $users = User::query("SELECT * FROM users WHERE email = :email LIMIT 1", ['email' => $email]);

        if (empty($users)) {
            Session::flash('error', 'Invalid credentials.');
            return $this->redirect('/login');
        }

        $user = $users[0];

        if (password_verify($password, $user->password_hash)) {
            Session::regenerate();
            Session::set('user_id', $user->id);
            Session::set('user_role', $user->role);
            Session::set('username', $user->username);

            Session::flash('success', 'Logged in successfully.');
            return $this->redirect('/profile');
        }

        Session::flash('error', 'Invalid credentials.');
        return $this->redirect('/login');
    }

    public function logout()
    {
        Session::destroy();
        return $this->redirect('/');
    }
}
