<?php
class Friend extends CI_Model{
	function getFriendsForUser()
    {
        $sql = "select u.alias 'user_alias', u.id 'user_id', u2.alias 'friend_alias', u2.id 'friend_id' from users u join friends f on f.user_id = u.id join users u2 on u2.id = f.friend_id where user_id = ?";
        $vals = [$this->session->userdata['currentUser']['id']];
        return $this->db->query($sql, $vals)->result_array(); 
	}
    function getFriendsForOthers()
    {
        // $sql = "SELECT * FROM travel_plans WHERE created_by != ?";
        // $sql = "select distinct part.trip_id, plans.created_by, u2.name 'creator',u.id 'particpantID', u.name 'participant',plans.description, plans.destination, plans.start_date, plans.end_date from trip_participants part join users u on u.id = part.user_id join travel_plans plans on plans.id = part.trip_id join users u2 on u2.id = plans.created_by where part.trip_id not in (select trip_id from trip_participants where user_id = ?)";
        $sql ="select u.name 'user_alias', u.id 'user_id' from users u where u.id not in (select friend_id from friends where user_id = ?) and u.id <> ?";
        $vals = [intval($this->session->userdata['currentUser']['id']), intval($this->session->userdata['currentUser']['id'])];
        return $this->db->query($sql, $vals)->result_array(); 
    }

	
    function addFriend($id)
    {
        $sql = "insert into friends (user_id, friend_id) values (?,?) ";
        $vals = [$this->session->userdata['currentUser']['id'], $id];
        $this->db->query($sql, $vals);
    
        $sql = "insert into friends (user_id, friend_id) values (?,?) ";
        $vals = [$id, $this->session->userdata['currentUser']['id']];
        $this->db->query($sql, $vals);

    }

    function removeFriend($id)
    {
        $sql = "delete from friends where user_id=? and friend_id=?";
        $vals = [$this->session->userdata['currentUser']['id'], $id];
        $this->db->query($sql, $vals);

        $sql = "delete from friends where user_id=? and friend_id=?";
        $vals = [$id, $this->session->userdata['currentUser']['id']];
        $this->db->query($sql, $vals);

    }
    function getProfile($id)
    {
        $sql = "select alias, name, email from users where id=?";
        $vals = [intval($id)];
        return $this->db->query($sql, $vals)->row_array();
    }
    function getDestinationInfo($tripID){
        $sql = "select distinct plans.id, plans.destination, plans.description, plans.start_date, plans.end_date, u.id 'creator', u.name 'creator_name' from  travel_plans plans join users u on u.id = plans.created_by where plans.id = ?";
        $vals = [$tripID];
        return $this->db->query($sql, $vals)->row_array();
    }
    function getJoiners($tripID) {
        $sql = "select distinct u.name from trip_participants part join travel_plans plans on plans.id = part.trip_id join users u on u.id = part.user_id and u.id <> plans.created_by and plans.id = ? and u.id <> ?";
        $vals = [$tripID, $this->session->userdata['currentUser']['id']];
        return $this->db->query($sql, $vals)->result_array();
    }
    
}
?>
