<?php
class AuthModel extends connect
{
    private $user_id;
    private $fullname;
    private $username;
    private $phone;
    private $email;
    private $address;
    private $role;

    public function __construct()
    {
        parent::__construct();
        if (func_num_args() > 0) {
            $params = func_get_args(); // Lấy tất cả tham số dưới dạng mảng

            // Gán giá trị cho các thuộc tính của đối tượng
            $this->user_id = $params[0] ?? null;
            $this->fullname = $params[1] ?? null;
            $this->username = $params[2] ?? null;
            $this->phone = $params[3] ?? null;
            $this->email = $params[4] ?? null;
            $this->address = $params[5] ?? null;
            $this->role = $params[6] ?? null;
        }
    }

    public function getAllMember()
    {
        $sql = "SELECT * FROM users";
        $result = $this->getlist($sql);
        $members = [];
        if ($result) {
            foreach ($result as $row) {
                $member = new AuthModel($row['user_id'], $row['fullname'], $row['username'], $row['phone'], $row['email'], $row['address'], $row['role']);
                array_push($members, $member);
            }
            return $members;
        }
    }
    function getRow()
    {
        $sql = "SELECT COUNT(*) FROM users";
        return $this->getInstance($sql);
    }
    function getMembersByPageAdmin($limit, $offset)
    {
        $sql = "SELECT * FROM users ORDER BY user_id DESC LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $members = [];
        if ($result) {
            foreach ($result as $row) {
                $member = new AuthModel($row['user_id'], $row['fullname'], $row['username'], $row['phone'], $row['email'], $row['address'], $row['role']);
                array_push($members, $member);
            }
            return $members;
        }
    }
    function searchMemberAdmin($field, $keyword, $limit, $offset)
    {
        $sql = "SELECT * FROM users WHERE $field like '%$keyword%' LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $members = [];
        if ($result) {
            foreach ($result as $row) {
                $member = new AuthModel($row['user_id'], $row['fullname'], $row['username'], $row['phone'], $row['email'], $row['address'], $row['role']);
                array_push($members, $member);
            }
            return $members;
        }
    }

    function getInfoUserById($id)
    {
        $sql = "SELECT user_id, fullname, username, phone, email, address FROM users
                WHERE user_id = '$id'";
        return $this->getInstance($sql);
    }

    // Đăng ký người dùng
    public function register($username, $email, $password, $phone, $fullname)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $role = 'customer'; // Mặc định vai trò là khach
            $sql = "INSERT INTO users (username, email, password, phone, fullname, role) VALUES ('$username', '$email', '$hashedPassword', '$phone', '$fullname', '$role')";
            // Gán các tham số vào truy vấn
            $this->exec($sql);

            // Trả về true nếu đăng ký thành công
            return true;
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            error_log('Lỗi đăng ký: ' . $e->getMessage());
            return false;
        }
    }

    // Đăng nhập người dùng
    public function checkLogin($username)
    {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        return $this->getInstance($sql);
    }
    public function updateRememberToken($id, $token)
    {
        $query = "UPDATE users SET remember_token = '$token' WHERE user_id = '$id'";
        $this->exec($query);

    }
    public function getUserByToken($token)
    {
        $sql = "SELECT * FROM users WHERE remember_token = '$token'";
        return $this->getInstance($sql);
    }
    public function checkEmailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch() ? true : false;
    }
    public function checkUserNameExists($username)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);

        return $stmt->fetch() ? true : false;
    }
    public function checkPassword($userId, $password) {
        $sql = "SELECT password FROM users WHERE user_id = $userId";
        $user = $this->getInstance($sql);
        return password_verify($password, $user['password']);
    }
    
    public function updatePassword($userId, $hashedPassword) {
        $sql = "UPDATE users SET password = '$hashedPassword' WHERE user_id = $userId";
        return $this->exec($sql);
    }
    public function updateProfile($userId, $fullname, $email, $phone) {
        $sql = "UPDATE users SET fullname = '$fullname', email = '$email', phone = $phone WHERE user_id = $userId";
        return $this->exec($sql);
    }
    function getUserId()
    {
        return $this->user_id;
    }
    function getUserName(){
        return $this->username;
    }
    function getFullname()
    {
        return $this->fullname;
    }
    function getPhone()
    {
        return $this->phone;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getAddress()
    {
        return $this->address;
    }

    function getRole()
    {
        return $this->role;
    }


}
?>