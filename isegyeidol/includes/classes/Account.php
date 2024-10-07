<?php
// 사용자 계정 관리를 위한 Account 클래스 정의
class Account {
    private $con; // 데이터베이스 연결 객체
    private $errorArray; // 오류 메시지를 저장할 배열

    // 생성자: 데이터베이스 연결 객체를 초기화하고 오류 배열을 초기화
    public function __construct($con) {
        $this->con = $con; // 데이터베이스 연결 객체 설정
        $this->errorArray = array(); // 오류 배열 초기화
    }

    // 로그인 메소드: 사용자명과 비밀번호를 입력받아 로그인 처리
    public function login($un, $pw) {
        $pw = md5($pw); // 비밀번호를 MD5로 암호화
        // 사용자명과 비밀번호로 쿼리 실행
        $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");
        // 결과가 1개이면 로그인 성공
        if(mysqli_num_rows($query) == 1) {
            return true;
        } else {
            // 실패 시 오류 메시지 추가
            array_push($this->errorArray, Constants::$loginFailed);
            return false; // 로그인 실패
        }
    }

    // 회원가입 메소드: 사용자 정보를 입력받아 회원가입 처리
    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
        // 사용자 입력값 검증
        $this->validateUsername($un);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);
        // 오류가 없으면 데이터베이스에 사용자 정보 삽입
        if(empty($this->errorArray) == true) {
            $this->insertUserDetails($un, $fn, $ln, $em, $pw); // 사용자 정보 삽입
            echo "
            <script>
            console.log('Sign Up Success'); // 성공 메시지 출력
            </script>
            ";
            return;
        } else {
            // 오류가 있으면 실패 메시지 출력
            echo "
            <script>
            console.log('Sign Up Failed'); // 실패 메시지 출력
            </script>
            ";
            return false; // 회원가입 실패
        }
    }

    // 오류 메시지를 반환하는 메소드
    public function getError($error) {
        // 오류 배열에 해당 오류가 없으면 빈 문자열 반환
        if(!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>"; // 오류 메시지 HTML 형식으로 반환
    }

    // 사용자 정보를 데이터베이스에 삽입하는 메소드
    private function insertUserDetails($un, $fn, $ln, $em, $pw) {
        $encryptedPw = md5($pw); // 비밀번호 암호화
        $profilePic = "source/img/leaf.png"; // 기본 프로필 사진 경로
        $date = 'now()'; // 가입 날짜
        // 데이터베이스에 사용자 정보 삽입 쿼리
        $query = "insert into users(username, firstName, lastName, email, password, signUpDate, profilePic) values
            ('$un', '$fn', '$ln', '$em', '$encryptedPw', $date, '$profilePic')";
        return mysqli_query($this->con, $query); // 쿼리 실행
    }

    // 사용자명 검증 메소드
    private function validateUsername($un) {
        // 사용자명의 길이를 검사
        if(strlen($un) > 25 || strlen($un) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters); // 길이가 잘못된 경우 오류 추가
            return;
        }

        // 사용자명 중복 확인 쿼리 실행
        $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
        // 중복된 사용자명이 있는 경우 오류 추가
        if(mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }
    }

    // 이름 검증 메소드
    private function validateFirstName($fn) {
        // 이름의 길이를 검사
        if(strlen($fn) > 25 || strlen($fn) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters); // 길이가 잘못된 경우 오류 추가
            return;
        }
    }

    // 성 검증 메소드
    private function validateLastName($ln) {
        // 성의 길이를 검사
        if(strlen($ln) > 25 || strlen($ln) < 2) {
            array_push($this->errorArray, Constants::$lastNameCharacters); // 길이가 잘못된 경우 오류 추가
            return;
        }
    }

    // 이메일 검증 메소드
    private function validateEmails($em, $em2) {
        // 두 이메일이 일치하는지 확인
        if($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch); // 불일치 시 오류 추가
            return;
        }

        // 이메일 형식 검증
        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid); // 잘못된 이메일 형식 오류 추가
            return;
        }

        // 이메일 중복 확인 쿼리 실행
        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
        // 중복된 이메일이 있는 경우 오류 추가
        if(mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }

    // 비밀번호 검증 메소드
    private function validatePasswords($pw, $pw2) {
        // 두 비밀번호가 일치하는지 확인
        if($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDoNoMatch); // 불일치 시 오류 추가
            return;
        }

        // 비밀번호가 영숫자가 아닌 경우 오류 추가
        if(preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            return;
        }

        // 비밀번호 길이를 검사
        if(strlen($pw) > 30 || strlen($pw) < 5) {
            array_push($this->errorArray, Constants::$passwordCharacters); // 길이가 잘못된 경우 오류 추가
            return;
        }
    }
}
?>
