# Module User

## Users and roles
This module define users and roles in database and the relation between the two.

It replaces laravel default User, so that we can reuse most of the laravel's logic for login/register etc.

defines a Guest role to add permissions to users that aren't logged in.

It defines the logic to reset a password throught the backend.

User is a Bundle and fields can be attached to it.

## Permissions

Roles Guest, Admin, God and Member cannot be deleted.
Roles with users cannot be deleted.

Passwords of God users cannot be changed unless you're a God yourself.

## Events
- `DeletingRole`
- `DeletingUser`
- `UserDeleted`
- `RoleDeleted`