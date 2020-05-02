<?php

function isAllowedViewModule($moduleName = ""){
    $t = &get_instance();
    $moduleName = ($moduleName == "") ? $t->router->fetch_class() : $moduleName;

    $user = get_active_user();
    $user_roles = get_user_roles();

    if(isset($user_roles[$user->user_role_id])){
        $permissions = json_decode($user_roles[$user->user_role_id]);
        if(isset($permissions->$moduleName) && isset($permissions->$moduleName->read)){
            return true;
        }
    }
    return false;
}

function isAllowedAddModule($moduleName = ""){
    $t = &get_instance();
    $moduleName = ($moduleName == "") ? $t->router->fetch_class() : $moduleName;

    $user = get_active_user();
    $user_roles = get_user_roles();

    if(isset($user_roles[$user->user_role_id])){
        $permissions = json_decode($user_roles[$user->user_role_id]);
        if(isset($permissions->$moduleName) && isset($permissions->$moduleName->write)){
            return true;
        }
    }
    return false;
}

function isAllowedUpdateModule($moduleName = ""){
    $t = &get_instance();
    $moduleName = ($moduleName == "") ? $t->router->fetch_class() : $moduleName;

    $user = get_active_user();
    $user_roles = get_user_roles();

    if(isset($user_roles[$user->user_role_id])){
        $permissions = json_decode($user_roles[$user->user_role_id]);
        if(isset($permissions->$moduleName) && isset($permissions->$moduleName->update)){
            return true;
        }
    }
    return false;
}

function isAllowedDeleteModule($moduleName = ""){
    $t = &get_instance();
    $moduleName = ($moduleName == "") ? $t->router->fetch_class() : $moduleName;

    $user = get_active_user();
    $user_roles = get_user_roles();

    if(isset($user_roles[$user->user_role_id])){
        $permissions = json_decode($user_roles[$user->user_role_id]);
        if(isset($permissions->$moduleName) && isset($permissions->$moduleName->delete)){
            return true;
        }
    }
    return false;
}

