Here’s a **clean, short, copy-paste cheat sheet** for **Spatie Laravel Permission** 👇
(Assign / check / remove roles & permissions)

---

## ✅ Role shortcuts

### Assign role

```php
$user->assignRole('admin');
```

Multiple:

```php
$user->assignRole(['admin', 'staff']);
```

---

### Remove role

```php
$user->removeRole('admin');
```

---

### Sync roles (replace all existing)

```php
$user->syncRoles(['staff']);
```

---

### Check role

```php
$user->hasRole('admin');          // true / false
$user->hasAnyRole(['admin','staff']);
$user->hasAllRoles(['admin','staff']);
```

---

### Get user roles

```php
$user->getRoleNames();
```

---

## ✅ Permission shortcuts

### Give permission to user

```php
$user->givePermissionTo('edit post');
```

Multiple:

```php
$user->givePermissionTo(['edit post', 'delete post']);
```

---

### Remove permission from user

```php
$user->revokePermissionTo('edit post');
```

---

### Sync permissions (replace all)

```php
$user->syncPermissions(['edit post']);
```

---

### Check permission

```php
$user->can('edit post');
```

---

## ✅ Role ↔ Permission shortcuts

### Give permission to role

```php
$role->givePermissionTo('edit post');
```

---

### Remove permission from role

```php
$role->revokePermissionTo('edit post');
```

---

### Sync role permissions

```php
$role->syncPermissions(['edit post', 'view post']);
```

---

## ✅ Create role / permission (one-liners)

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Role::firstOrCreate(['name' => 'admin']);
Permission::firstOrCreate(['name' => 'edit post']);
```

---

## ✅ Middleware shortcuts (VERY IMPORTANT)

### Role middleware

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // admin routes
});
```

---

### Permission middleware

```php
Route::middleware(['auth', 'permission:edit post'])->group(function () {
    // permission-based routes
});
```

---

## 🧠 Best Practice (Remember)

✔ Assign **permissions to roles**
✔ Assign **roles to users**
❌ Don’t assign permissions directly to users unless necessary

---

## 🔥 Ultra-short memory version

```php
$user->assignRole('admin');
$user->removeRole('admin');
$user->hasRole('admin');

$user->givePermissionTo('edit');
$user->revokePermissionTo('edit');
$user->can('edit');

$role->givePermissionTo('edit');
$role->syncPermissions(['edit']);
```

---

If you want:

* 🔁 Auto redirect by role after login
* 🧩 RBAC with Jetstream + custom login
* 📦 Seeder for roles & permissions
* 🛡️ Admin / Staff / User dashboards

Just tell me 👍
