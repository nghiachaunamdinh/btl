
<?php
//Protection proxy
interface ReadFile {
    public function readFile();
}
 
// Class User
class User implements ReadFile {
    private $name;
    private $role = "1";
     
    public function __construct($name){
        $this->name = $name;
    }
  
    public function readFile() {
        return "1";
    }
 
}
 
// Class UserProxy
class UserProxy implements ReadFile {
    private $name;
    private $role;
    private $user;
     
    public function __construct($name, $role){
        $this->name = $name;
        $this->role = $role;
    }
     
    public function readFile() {
        if(strtolower($this->role)=="1"){
            $this->user = new User($this->name);
            return $this->user->readFile();
        }
        return "0";
    }
}
function MaChucVu($MaHDB)
 {
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', ''); 
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $connect->query("select * FROM NhanVien where MaNV='".$MaHDB."'");
   while($row = $result->fetch()) {
    $sum=$row['MaCV'];
   }
   return $sum;
}
function ketqua($MaHDB){
	$t=MaChucVu($MaHDB);
    $user1 = new UserProxy('tt',$t); 
    return  $user1->readFile();
}
?>