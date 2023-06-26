<?php

// Function to retrieve all users
function getAllUsers() {
    $usersData = file_get_contents('users.json');
    $users = json_decode($usersData, true);
    return $users;
}

// Function to retrieve a specific user by ID
function getUserById($userId) {
    $users = getAllUsers();
    foreach ($users as $user) {
        if ($user['user_id'] == $userId) {
            return $user;
        }
    }
    return null;
}

// Function to add a new user
function addUser($userData) {
    $users = getAllUsers();
    $userData['user_id'] = count($users) + 1;
    $users[] = $userData;
    saveUsersData($users);
}

// Function to update an existing user
function updateUser($userId, $newData) {
    $users = getAllUsers();
    foreach ($users as &$user) {
        if ($user['user_id'] == $userId) {
            $user = array_merge($user, $newData);
            saveUsersData($users);
            return true;
        }
    }
    return false;
}

// Function to delete a user
function deleteUser($userId) {
    $users = getAllUsers();
    foreach ($users as $index => $user) {
        if ($user['user_id'] == $userId) {
            array_splice($users, $index, 1);
            saveUsersData($users);
            return true;
        }
    }
    return false;
}

// Function to save users data to file
function saveUsersData($users) {
    $usersData = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents('users.json', $usersData);
}

?>
