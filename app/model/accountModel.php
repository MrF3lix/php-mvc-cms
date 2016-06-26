<?php

class Model{
    public $data;
    public $articel;
    public $db;

    public function getUserProfile($id){        
        $this->db = new Database();
        $sqlstr = "SELECT * FROM User WHERE id = ".$id;

        $this->db->sqlExec($sqlstr);
        $this->data = $this->db->_results;

        while($row = mysqli_fetch_object($this->data)){
            $userArr[] = array(
                'id' => $row->id,
                'username' => $row->username,
                'name' => $row->name,
                'surname' => $row->surname,
                'email' => $row->email,
                'description' => $row->description,
                'image' => $row->image
            );
        }

        $this->data = $userArr;
        $this->db = NULL;
        
        return $this->data;
    }

    public function getUserFromId($userId)
    {
        $this->db = new Database();
        $sqlstr = "SELECT * FROM User WHERE id = ".$userId;

        $this->db->sqlExec($sqlstr);
        $result = $this->db->_results;

        while($row = mysqli_fetch_object($result)){
            return $row->username;
        }
        return "";
    }
    
    public function getUserImageFromId($userId)
    {
        $this->db = new Database();
        $sqlstr = "SELECT * FROM User WHERE id = ".$userId;

        $this->db->sqlExec($sqlstr);

        $results = $this->db->_results;

        while($row = mysqli_fetch_object($results)){
            return $row->image;
        }
        return "";
    }

    public function getUserArticles($id){
        $this->db = new Database();
        $sqlstr = "SELECT * FROM Article WHERE userId = ".$id;

        $this->db->sqlExec($sqlstr);
        $this->articel = $this->db->_results;

        while($row = mysqli_fetch_object($this->articel)){
            $articleArr[] = array(
                'id' => $row->id,
                'title' => $row->title,
                'content' => $row->content,
                'picture' => $row->picture,
                'dateCreated' => $row->dateCreated,
                'username' => $this->getUserFromId($row->userId),
                'userImage' => $this->getUserImageFromId($row->userId)
            );
        }

        $this->article = $articleArr;
        $this->db = NULL;
        
        return $this->article;
    }
}

?>