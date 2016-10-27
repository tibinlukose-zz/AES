<?php

/* 
 * License under Pirates of mac Valley.
 * Developed by Navas, Sriram and Tibin  * 
 */
function alert($data){
    ?>
<script>
    window.alert("<?php echo $data;?>");
    </script>
    <?php
    
}
function jsRedirect($data){
    ?>
<script>
   location.href="<?php echo $data;?>";
    </script>
    <?php
    
}
$host='localhost';
$user='root';
$db='maceduxx_aes';
$password='';
function findClassIdFromStaffPaper($paperId,$userId){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select classid from staffpaper where userid={$userId} and paper_id={$paperId}";
        //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findBatchFromClassid($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select batch from deptclass where classid={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findPapersInfoFromStaff($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select paper_id,classid from staffpaper where userid={$id}";
        // echo $sql;
        $result=  mysqli_query($db, $sql);
      $result=  mysqli_fetch_all($result);
      return $result;
        
		//return $row['courseName'];
    }
}
function findCourseNameFromPaperId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select courseName from courses where id=(select distinct course_id from papers where paper_id={$id})";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}

function findAllStaffInfoFromPaperId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select * from staffpaper where paper_id={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row;
		//return $row['courseName'];
    }
}
function findNameFromUsername($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select name from users where username='{$id}'";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findValidApplicationNo($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select count(*) as total from admission where appNo='{$id}'";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		if($row[0]==0){
                    return FALSE;
                }else{
                    return true;
                }
		//return $row['courseName'];
    }
}
function findAttendanceAllData($course,$year,$semester){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select * from attendance where course_id='{$course}' and academic_year={$year} and semester={$semester}";
        
       // echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row;
		//return $row['courseName'];
    }
}
function findAllInfoAboutPaper($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select * from papers where paper_id={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row;
		//return $row['courseName'];
    }
}
function findEmailFromUserId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select email from users where userid={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findAdmnFromUserid($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select username from users where userid={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findPhoneFromUserId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select phone from users where userid={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findStaffIdFromClassIdPaperId($classid,$paperid){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select userid from staffpaper where classid={$classid} and paper_id={$paperid}";
        //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findCourseFromClassId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select course_id from deptclass where classid={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findClassIdFromExamId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select class_id from exams where exam_id={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findClassTeacherFromClassId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select staffID from deptclass where classid={$id} and active=1";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findMailFromUserId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select email from users where userid={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findExamIdfromExamName($name){
     if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select exam_id from exams where exam_name='{$name}'";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
    
    
}
function findAllInfoAboutExam($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select * from exams where exam_id={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
            //print_r($row);
        return $row;
                
		//return $row['courseName'];
    }
    
}
function findExamNamefromExamId($id){
     if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select exam_name from exams where exam_id=$id";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
    
    
}
function findExamNamefromId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select exam_name from exams where exam_id={$id}";
       //echo $sql;
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findSemesterFromPaperId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
       //echo $sql;
        $sql="select semester from papers where paper_id={$id}";
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}

function findCourseIdFromPapaerId($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select course_id from papers where paper_id={$id}";
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}

function findCourseName($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select courseName from courses where id={$id}";
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findAllInfoAboutClass($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select * from deptclass where classid={$id}";
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row;
		//return $row['courseName'];
    }
}
function findStudentNameFromUsername($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select name from users where username={$id}";
        if($result=  mysqli_query($db, $sql)){
            
        
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
        }else{
            return "ERROR";
        }
    }
}
function findUsername($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select name from users where userid={$id}";
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}

function findClassName($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select className from deptclass where classid={$id}";
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findPaperName($id){
    if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {
        $sql="select paper_name from papers where paper_id={$id}";
        
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
}
function findSemesterFromClassDept($id){
     if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {   
        
        $sql="select semester from deptclass where classid={$id}";
        
        $result=  mysqli_query($db, $sql);
        $row=  mysqli_fetch_row($result);
		return $row[0];
		//return $row['courseName'];
    }
    
}
function findStaffNamePaper($staff_id,$classid){
     if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {   
        
        $sql="select name from users where userid=(select userid from staffpaper where paper_id={$staff_id} and classid={$classid})";
        ///echo $sql;
        $result=  mysqli_query($db, $sql);
        if($row=  mysqli_fetch_array($result)){
          return $row[0];
        }else{
            return "No Staff assigned for this paper|ERROR";
        }
		
		//return $row['courseName'];
    }
    
}
function findAcademicYearByCourseIdSemester($courseId,$semester){
     if(!($db=mysqli_connect('localhost','root','','maceduxx_aes'))){
        return FALSE;
    }else
    {   
        
        
        $sql="select academic_year from semester_logs where course_id={$courseId} and semester={$semester}";
        //echo $sql;
        $result=  mysqli_query($db, $sql);
        
        if($row=  mysqli_fetch_row($result)){
         // echo "hello";
          if($row[0]!=NULL){
              return $row[0];
             // return 1;
          }
        }else
        {
            return FALSE;
        }
        
		
		//return $row['courseName'];
    }
    
}