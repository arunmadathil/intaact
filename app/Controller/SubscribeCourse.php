<?

namespace App\Controller;

use App\Core\Requests;
use App\Model\Course;
use App\Model\Report;
use App\Model\Student;

class SubscribeCourse extends Controller
{
    public function index(Requests $request)
    {

        $courses =  (new Course)->all(['id', 'course_name']);

        $studensts =  (new Student)->all(['id', 'first_name', 'last_name']);

        return $this->view('course/subscribe', array('courses' => $courses, 'students' => $studensts));
    }

    public function subscribe(Requests $request)
    {
        $subscriptions = [];
        $courses = $request->course;

        foreach ($request->students as $key => $value) {

            $subscriptions[] = ['course' => $courses[$key], 'student' => $value];

        }
        $obj = new Course;
        $obj->storeSubscriptions($subscriptions);

        return $this->redirect('/reports');
    }


    public function reports(Requests $request){
        
        $report = new Report;    
      
        $report->initPagination(5, '/reports',  $request->page ?? 1);  
          
        $sql = "SELECT CONCAT(s.first_name,' ', s.last_name) full_name,c.course_name 
                FROM course_subscribe cs 
                LEFT JOIN students s ON cs.student_id=s.id
                LEFT JOIN courses c ON cs.course_id=c.id 
                ORDER BY s.first_name";        
        
        $reports = $report->dbQuery($sql);

        $pagination = $report->getPagination();  
       

        return $this->view('course/reports', compact('reports', 'pagination'));
    
    }
}
