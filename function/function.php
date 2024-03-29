<?php
    session_start();
    require "../connect/connect.php";
    require "../query/query.php";

    function checkUser($username)
    {
        $sql = usernameQuery($username);
        $result = $GLOBALS['conn']->query($sql);
        if ($result->num_rows > 0)
        {
            return true;
        }else
        {
            return false;
        }
    }

    function registerUser($first_name, $last_name, $username, $password, $role)
    {   
        $sql = userRegQuery($first_name, $last_name, $username, $password, $role);
        
        if ($GLOBALS['conn']->query($sql) === TRUE)
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    function verifyPassword($username, $password)
    {
        $sql = passwordQuery($username, $password);
        $result = $GLOBALS['conn']->query($sql);

        while ($row = $result->fetch_assoc())
        {
            if (password_verify($password, $row['password']))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    function setUserDetail($username)
    {
        $sql = getUserQuery($username);
        $result = $GLOBALS['conn']->query($sql);
       
        while($row = $result->fetch_assoc())
        {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['user_role_id'] = $row['user_role_id'];
        }
    }

    function setSignIn($username)
    {
        $sql = signInQuery($username);
        $GLOBALS['conn']->query($sql);
    }

    function addTodo($user_id, $todo_title, $todo_desc){
        $sql = addTodoQuery($user_id, $todo_title, $todo_desc);
        if ($GLOBALS['conn']->query($sql) === true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getUserTodo($user_id)
    {
        $sql = getUserTodoQuery($user_id);
        // die($sql);
        $result = $GLOBALS['conn']->query($sql);
        return $result;
    }

    function getTodo($todo_id)
    {
        $sql = getTodoQuery($todo_id);
        $result = $GLOBALS['conn']->query($sql);
        return $result;
    }

    function editTodo($todo_id, $todo_title, $todo_desc)
    {
        $sql = editTodoQuery($todo_id, $todo_title, $todo_desc);
        if ($GLOBALS['conn']->query($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function adminGetUsers(){
        $sql = getUsers();
        $result = $GLOBALS['conn']->query($sql);
        return $result;
    }

    function getUserDetail($user_id)
    {
        $sql = adminGetUserQuery($user_id);
        $result = $GLOBALS['conn']->query($sql);
        return $result;
    }

    function editUser($user_id, $username, $first_name, $last_name)
    {
        $sql = editUserQuery($user_id, $username, $first_name, $last_name);
        if ($GLOBALS['conn']->query($sql) === true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function deleteUser($id)
    {   
        $deletetodo = "DELETE FROM todo WHERE user_id = $id";
        $GLOBALS['conn']->query($deletetodo);
        $sql = deleteUserQuery($id);
        if ($GLOBALS['conn']->query($sql)=== true)
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    function deleteTodo($id)
    {
        $sql = deleteTodoQuery($id);
        if ($GLOBALS['conn']->query($sql)=== true)
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    function getUserTodoBacklog($user_id)
    {
        $sql = getUserTodoBacklogQuery($user_id);
        // die($sql);
        $result = $GLOBALS['conn']->query($sql);
        return $result;
    }

    function getUserTodoProgress($user_id)
    {
        $sql = getUserTodoProgressQuery($user_id);
        // die($sql);
        $result = $GLOBALS['conn']->query($sql);
        return $result;
    }

    function getUserTodoDone($user_id)
    {
        $sql = getUserTodoDoneQuery($user_id);
        // die($sql);
        $result = $GLOBALS['conn']->query($sql);
        return $result;
    }

    function setTodoProgress($todo_id)
    {
        $sql = setTodoProgressQuery($todo_id);
        if ($GLOBALS['conn']->query($sql) === TRUE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function setTodoDone($todo_id)
    {
        $sql = setTodoDoneQuery($todo_id);
        if ($GLOBALS['conn']->query($sql) === TRUE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function setTodoBacklog($todo_id)
    {
        $sql = setTodoBacklogQuery($todo_id);
        if ($GLOBALS['conn']->query($sql) === TRUE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
?>
