<?php
interface ReadFile {
    public function readFile();
} 
// Class User
class User implements ReadFile {
    private $name;
    private $role = "1";//kết quả trả về
     
    public function __construct($name){//hàm tạo
        $this->name = $name;
    } 
  
    public function readFile() {
        return "1";//kết quả trả về
    }
 
}
class UserProxy implements ReadFile {// Class UserProxy
    private $name;//tên
    private $role;//kết quả
    private $user;// đối tượng userd
    public function __construct($name, $role){//hàm tạo
        $this->name = $name;
        $this->role = $role;
    }
    public function readFile(){
        if(strtolower($this->role)=="1"){//chuyển đổi ký tự thành ký tự thường
            $this->user = new User($this->name);
            return $this->user->readFile();//trả về 1
        }
        return "0";
    }
}
//trả về mã cv
function MaChucVu($MaHDB){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', ''); 
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $connect->query("select * FROM NhanVien where MaNV='".$MaHDB."'");
   while($row = $result->fetch()) {
    $sum=$row['MaCV'];
   }
   return $sum;
}
//trả về kết quả
function ketqua($MaHDB){
	$t=MaChucVu($MaHDB);
    $user1 = new UserProxy('tt',$t); 
    return  $user1->readFile();
}
?>