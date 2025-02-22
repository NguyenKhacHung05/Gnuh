<?php
class AuthController
{
    private $authModel;
    private $authView;
    private $componentView;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->authView = new AuthView();
        $this->componentView = new ComponentView();
    }
    // Hiển thị trang đăng ký
    public function showRegister()
    {
        $this->authView->register();
    }
    // Hiển thị trang đăng nhập
    public function showLogin()
    {
        $this->authView->login();
    }
    // Xử lý đăng ký
    public function checkRegister()
    {
        if (isset($_POST['submit']) && $_POST['submit'] === 'register') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $fullname = $_POST['fullname'];

            $errors = [];
            if (!isset($_POST['accept'])) {
                $errors['accept'] = "You must agree to the terms";
            }

            // 1️⃣ Kiểm tra Username (tối thiểu 3 ký tự, không chứa ký tự đặc biệt)
            if (empty($username) || strlen($username) < 3 || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                $errors['username'] = "Username must be at least 3 characters and contain only letters, numbers, and underscores.";
            }

            if ($this->authModel->checkUserNameExists($username)) {
                $errors['username'] = "Username already exists";
            }

            // 2️⃣ Kiểm tra Password (tối thiểu 6 ký tự, chứa ít nhất 1 số, 1 chữ cái)
            if (strlen($password) < 6 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
                $errors['password'] = "Password must be at least 6 characters and contain both letters and numbers.";
            }

            // 3️⃣ Kiểm tra nhập lại mật khẩu
            if ($password !== $repassword) {
                $errors['repassword'] = "Passwords do not match.";
            }

            // 4️⃣ Kiểm tra Email hợp lệ
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }

            if ($this->authModel->checkEmailExists($email)) {
                $errors['email'] = "Email already exists";
            }

            // 5️⃣ Kiểm tra Số điện thoại (chỉ chứa số, từ 9-11 chữ số)
            if (!preg_match('/^[0-9]{9,11}$/', $phone)) {
                $errors['phone'] = "Phone number must be between 9-11 digits.";
            }

            // 6️⃣ Kiểm tra Fullname (không chứa số hoặc ký tự đặc biệt)
            if (!preg_match('/^[\p{L}\s]+$/u', $fullname)) {
                $errors['fullname'] = "Fullname must contain only letters and spaces.";
            }

            // Nếu có lỗi, hiển thị lại form kèm thông báo
            if (!empty($errors)) {
                $this->authView->register($errors);
                return;
            }

            if ($repassword === $password) {
                if ($this->authModel->register($username, $email, $password, $phone, $fullname)) {
                    $this->authView->login();
                } else {
                    $this->authView->register($errors);
                    return;
                }
            } else {
                $this->authView->register($errors);
                return;
            }
        }
    }
    public function checkLogin()
    {
        if (isset($_POST['submit']) && $_POST['submit'] === 'login') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $keepMeLoggedIn = isset($_POST['keep-login']);

            $errors = [];

            // 1️⃣ Kiểm tra Username & Password có được nhập không
            if (empty($username) || empty($password)) {
                $errors['login'] = "Please enter both username and password.";
                $this->authView->login($errors, $username, $password);
                return;
            }

            $user = $this->authModel->checkLogin($username);
            if (!$user) {
                $errors['username'] = "Username does not exist.";
                $this->authView->login($errors, $username, $password);
                return;
            } elseif (!password_verify($password, $user['password'])) {
                $errors['password'] = "Password is incorrect.";
                $this->authView->login($errors, $username, $password);
                return;
            } else {
                // Lưu thông tin người dùng vào session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                if ($keepMeLoggedIn) {
                    // Tạo token ngẫu nhiên và lưu vào database
                    $token = bin2hex(random_bytes(32));
                    $this->authModel->updateRememberToken($user['user_id'], $token);
                    // Lưu vào cookie (7 ngày)
                    setcookie('remember_me', $token, time() + (7 * 24 * 60 * 60), '/', '', false, true);
                }
                header('location: /gnuh/');
                exit();
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        session_destroy();
        setcookie('remember_me', '', time() - 3600, '/', '', false, true); // Xóa cookie
        header('location: /gnuh/');
        exit();
    }

    function myProfile($errors = null)
    {
        $this->componentView->displaySidebarUser('profile');
        $user = $this->authModel->getInfoUserById($_SESSION['user_id']);
        $this->authView->myProfile($user, $errors);
    }

    function updateProfile()
    {
        if (isset($_POST['submit']) && $_POST['submit'] === 'updateUser') {
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $fullname = $_POST['full-name'];
            $errors = [];
            $errors['fullname'] = $this->invalidFullName($fullname);
            $errors['email'] = $this->invalidEmail($email);
            $errors['phone'] = $this->invalidPhone($phone);
            if (!empty($_POST['new-password'])) {
                $password = $_POST['password'];
                $newPassword = $_POST['new-password'];
                $confirmPassword = $_POST['confirm-password'];
                // Kiểm tra mật khẩu cũ (nếu cần)
                if (!$this->authModel->checkPassword($_SESSION['user_id'], $password)) {
                    $errors['password'] = "Current password is incorrect.";
                }
                $errors['new-password'] = $this->invalidPassword($newPassword);
                $errors['confirm-password'] = $this->invalidConfirmPassword($newPassword, $confirmPassword);
            }
            if (!empty(array_filter($errors))) {
                $this->myProfile($errors);
                exit;
            } else {
                // Nếu không có lỗi, tiến hành cập nhật
                if (!empty($newPassword)) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $this->authModel->updatePassword($_SESSION['user_id'], $hashedPassword);
                }
                $this->authModel->updateProfile($_SESSION['user_id'], $fullname, $email, $phone);
                $this->myProfile(['success' => 'Profile updated successfully.']);
            }
        }
    }
    function invalidFullName($fullname)
    {
        // Kiểm tra rỗng
        if (empty(trim($fullname))) {
            return "Fullname cannot be empty.";
        }

        // Kiểm tra ký tự chỉ gồm chữ và khoảng trắng
        if (!preg_match('/^[\p{L}\s]+$/u', $fullname)) {
            return "Fullname must contain only letters and spaces.";
        }

        // Hợp lệ: không trả về lỗi
        return null;
    }
    function invalidUsername($username)
    {
        // 1️⃣ Kiểm tra rỗng
        if (empty(trim($username))) {
            return "Username cannot be empty.";
        }

        // 2️⃣ Kiểm tra độ dài tối thiểu 3 ký tự
        if (strlen($username) < 3) {
            return "Username must be at least 3 characters.";
        }

        // 3️⃣ Kiểm tra chỉ chứa chữ cái, số và dấu gạch dưới
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            return "Username can only contain letters, numbers, and underscores.";
        }

        // 3️⃣ Kiểm tra UserName đã tồn tại trong cơ sở dữ liệu
        if ($this->authModel->checkUserNameExists($username)) {
            return "UserName already exists.";
        }

        // Hợp lệ: không có lỗi
        return null;
    }
    function invalidPassword($password)
    {
        // 1️⃣ Kiểm tra rỗng
        if (empty(trim($password))) {
            return "Password cannot be empty.";
        }

        // 2️⃣ Kiểm tra độ dài tối thiểu 6 ký tự
        if (strlen($password) < 6) {
            return "Password must be at least 6 characters.";
        }

        // 3️⃣ Kiểm tra chứa ít nhất 1 chữ cái
        if (!preg_match('/[A-Za-z]/', $password)) {
            return "Password must contain at least one letter.";
        }

        // 4️⃣ Kiểm tra chứa ít nhất 1 chữ số
        if (!preg_match('/[0-9]/', $password)) {
            return "Password must contain at least one number.";
        }

        // Hợp lệ: không có lỗi
        return null;
    }
    public function invalidConfirmPassword($password, $confirmPassword)
    {
        if (empty($confirmPassword)) {
            return "Confirm password cannot be empty.";
        }
        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }
        return null; // Hợp lệ
    }
    function invalidPhone($phone)
    {
        // 1️⃣ Kiểm tra rỗng
        if (empty(trim($phone))) {
            return "Phone number cannot be empty.";
        }

        // 2️⃣ Kiểm tra chỉ chứa số và từ 9 đến 11 chữ số
        if (!preg_match('/^[0-9]{9,11}$/', $phone)) {
            return "Phone number must be between 9-11 digits and contain only numbers.";
        }

        // Hợp lệ: không có lỗi
        return null;
    }
    function invalidEmail($email)
    {
        // 1️⃣ Kiểm tra rỗng
        if (empty(trim($email))) {
            return "Email cannot be empty.";
        }

        // 2️⃣ Kiểm tra định dạng email hợp lệ
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }

        // Hợp lệ: không có lỗi
        return null;
    }


}