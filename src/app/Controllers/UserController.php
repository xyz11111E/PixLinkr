<?php

namespace App\Controllers;

use PDO;
use App\Models\User;

class UserController extends Controller
{
    public function all()
    {
        if (!User::loggedIn())
        {
            header("Location: /login");
            exit;
        }

        if (!in_array("admin", $_SESSION["user_roles"]))
        {
            header("Location: /account");
            exit;
        }

        $usersStmt = $this->conn->prepare("SELECT * FROM users;");
        $usersStmt->execute();
        $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
        
        require __DIR__ . "/../Views/users.php";
    }

    public function getById()
    {
        if (!User::loggedIn())
        {
            header("Location: /login");
            exit;
        }

        if (!in_array("admin", $_SESSION["user_roles"]))
        {
            header("Location: /account");
            exit;
        }

        $id = $_GET["id"] ?? null;

        if ($id)
        {
            $userStmt = $this->conn->prepare("SELECT * FROM users WHERE id = :a LIMIT 1;");
            $userStmt->execute([":a" => $id]);
            $user = $userStmt->fetch(PDO::FETCH_ASSOC);

            if ($user)
            {
                $currentUserRolesStmt = $this->conn->prepare("SELECT roles.name as name, user_roles.role_id as role_id, user_roles.user_id as user_id FROM user_roles INNER JOIN roles ON user_roles.role_id = roles.id WHERE user_roles.user_id = :a;");
                $currentUserRolesStmt->execute([":a" => $user["id"]]);
                $currentUserRoles = $currentUserRolesStmt->fetchAll(PDO::FETCH_ASSOC);

                $rolesStmt = $this->conn->prepare("SELECT * FROM roles;");
                $rolesStmt->execute();
                $roles = $rolesStmt->fetchAll(PDO::FETCH_ASSOC);

                require __DIR__ . "/../Views/user.php";
                return;
            }
        }
        
        $this->notFound();
    }

    public function addRolePost()
    {
        if (!User::loggedIn())
        {
            header("Location: /login");
            exit;
        }

        if (!in_array("admin", $_SESSION["user_roles"]))
        {
            header("Location: /account");
            exit;
        }

        header("Content-Type: application/json");

        $userId = $_POST["user_id"];
        $roleId = $_POST["role_id"];

        // --- 1. Check if user/role exist ---
        $userExistsStmt = $this->conn->prepare("SELECT count(id) FROM users WHERE id = :a;");
        $userExistsStmt->execute([":a" => $userId]);
        $userExists = (int) $userExistsStmt->fetchColumn();

        if ($userExists !== 1)
        {
            echo json_encode([
                "error" => "user_does_not_exist"
            ]);
            return;
        }

        // --- 2. Check if user already has this role ---
        $userHasRoleStmt = $this->conn->prepare("SELECT count(user_id) FROM user_roles WHERE user_id = :a AND role_id = :b;");
        $userHasRoleStmt->execute([":a" => $userId, ":b" => $roleId]);
        $userHasRole = (int) $userHasRoleStmt->fetchColumn();

        if ($userHasRole === 1)
        {
            echo json_encode([
                "error" => "user_already_has_role"
            ]);
            return;
        }

        // --- 3. Add role ---
        $addUserRoleStmt = $this->conn->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (:a, :b);");
        $addedUserRole = $addUserRoleStmt->execute([":a" => $userId, ":b" => $roleId]);

        if ($addedUserRole)
        {
            echo json_encode([
                "success" => "user_role_added"
            ]);
            return;
        }

        echo json_encode([
            "error" => "something_went_wrong"
        ]);
    }

    public function delRolePost()
    {
        if (!User::loggedIn())
        {
            header("Location: /login");
            exit;
        }

        if (!in_array("admin", $_SESSION["user_roles"]))
        {
            header("Location: /account");
            exit;
        }

        header("Content-Type: application/json");

        $roleId = $_POST["role_id"];
        $userId = $_POST["user_id"];

        if ($roleId === "1")
        {
            echo json_encode([
                'error' => 'cannot_delete_user_role'
            ]);
            return;
        }

        // --- Delete User Role ---
        $deletedUserRole = $this->conn->prepare("DELETE FROM user_roles WHERE role_id = :a AND user_id = :b;")->execute([":a" => $roleId, ":b" => $userId]);

        if ($deletedUserRole)
        {
            echo json_encode([
                'success' => 'user_role_deleted'
            ]);
            return;
        }
        
        echo json_encode([
            'error' => 'something_went_wrong'
        ]);
    }
}