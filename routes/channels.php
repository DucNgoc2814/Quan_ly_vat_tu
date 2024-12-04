<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('contract-notifications', function ($user) {
    return $user->role_id === 1;
});
Broadcast::channel('contract-created', function ($user) {
    return $user->role_id === 1;
    // return true;
});
Broadcast::channel('contract-status', function ($user) {
    return true;
});

Broadcast::channel('chat', function ($user) {
    // return in_array($user->role_id, [1, 2, 3]);
    return true;
});
