<?php
    echo password_hash("Dandiwibowo99", PASSWORD_DEFAULT);
?>
<?php
// $childs = array();

// // Fork some process.
// for($i = 0; $i < 10; $i++) {
//     $pid = pcntl_fork();
//     if($pid == -1)
//         die('Could not fork');

//     if ($pid) {
//         echo "parent \n";
//         $childs[] = $pid;
//     } else {
//         // Sleep $i+1 (s). The child process can get this parameters($i).
//         sleep($i+1);
       
//         // The child process needed to end the loop.
//         exit();
//     }
// }

// while(count($childs) > 0) {
//     foreach($childs as $key => $pid) {
//         $res = pcntl_waitpid($pid, $status, WNOHANG);
       
//         // If the process has already exited
//         if($res == -1 || $res > 0)
//             unset($childs[$key]);
//     }
   
//     sleep(1);
// }
?>