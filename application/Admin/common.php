<?php



function level($user,$level){
    if($level==-1){
        return true;
    }else{
        $user_level=$user['user_type'];
        if($user_level<$level){
            return true;
        }else{
            return false;
        }
    }
    

};

