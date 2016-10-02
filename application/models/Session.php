<?php
class Session extends CI_Model{
	function getUser($userInfo)
    {
        $sql = "SELECT * FROM users WHERE email = ? and password = ?";
      
        $vals = [$userInfo['email'],md5($userInfo['password'])];
        return $this->db->query($sql, $vals)->row_array(); 
	}

	function addUser($userInfo)
    {
        $sql = "insert into users (name,alias, email, password,dob, created_at,updated_at) values (?,?,?,?,?,now(),now())";
            $vals= [$userInfo['name'],$userInfo['alias'], $userInfo['email'], md5($userInfo['password']), $userInfo['dob']];
            $this->db->query($sql, $vals);
            return $this->db->insert_id();
    }
    
}
?>
