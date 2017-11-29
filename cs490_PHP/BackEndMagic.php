<?php 
#Jason Rodd
#10-4-17
include 'Database.php';
include 'BackEndUtility.php';
include 'ValidateUser.php';
include 'InsertExam.php';
include 'InsertQuestion.php';
include 'InsertExamQuestion.php';
include 'UpdateExam.php';
include 'UpdateQuestionBank.php';
include 'DeleteExam.php';
include 'DeleteQuestion.php';
include 'DeleteExamQuestion.php';
include 'DeleteExamQuestionSet.php';
include 'SelectUsers.php';
include 'SelectExams.php';
include 'SelectQuestions.php';
include 'SelectExamQuestions.php';
include 'GradeQuestion.php';


include 'InsertStudentExam.php';
include 'InsertStudentQuestion.php';
include 'InsertStudentAnswer.php';
include 'InsertStudentGrade.php';

include 'UpdateStudentExam.php';
include 'UpdateStudentAnswer.php';
include 'UpdateStudentGrade.php';

include 'DeleteStudentExam.php';
include 'DeleteAllStudentExams.php';
include 'DeleteStudentQuestion.php';
include 'DeleteStudentAnswer.php';
include 'DeleteStudentGrade.php';


include 'SelectStudentExams.php';
include 'SelectStudentQuestions.php';
include 'SelectStudentAnswers.php';
include 'SelectStudentGrades.php';

include 'InsertTestCase.php';
include 'InsertRuleSet.php';
include 'SelectTestCases.php';
include 'SelectRuleSets.php';

include 'DeleteStudentComment.php';
include 'InsertStudentComment.php';
include 'SelectStudentComments.php';
include 'UpdateStudentComment.php';

include 'DeleteProfessorComment.php';
include 'InsertProfessorComment.php';
include 'SelectProfessorComments.php';
include 'UpdateProfessorComment.php';
include 'JoinStatements.php';

include 'InsertMultipliers.php';
include 'UpdateMultipliers.php';
include 'DeleteMultipliers.php';
include 'SelectMultipliers.php';


$myDB = new Database("sql2.njit.edu","jjr42","laureate6","jjr42");
$connection = new mysqli($myDB->get_servername(), $myDB->get_username(), $myDB->get_password(), $myDB->get_dbname());

if ($connection->connect_error) { #check valid database credentials
    echo("Connection failed: " . $connection->connect_error);
} else {
	
	if (empty($_POST)){ #Check if theirs a post
		echo("No Post<br>");
	} else {
		
		if(!ValidateBackendUser($connection, $_POST["BackEndUser"],$_POST["BackEndSecret"])){ #Check if valid user trying to access
			echo("Invalid Backend User<br>");
		} else {
			
			if(empty($_POST["Identity"])){ #Check the post to contain an identity
				echo("no identity<br>");
			} else {
				$returnString = "";
				
				
				switch ($_POST["Identity"]) {
					case "ask":
						$returnString = ask($_POST);
						break;
					case "ValidateUser":
						$returnString = ValidateUseage($connection, $_POST);
						break;
					case "ValidateMiddleUser":
						$isValid = ValidateBackendUser($connection, $_POST['FrontEndUser'],$_POST['FrontEndSecret']);
						$jsonObj->validuser = $isValid;
						$returnString = json_encode($jsonObj);
						break;
					case "InsertExam":
						$returnString = InsertAnExam($connection, $_POST);
						break;
					case "InsertQuestion":
						$returnString = InsertAQuestion($connection, $_POST);
						break;
					case "InsertExamQuestion":
						$returnString = InsertAnExamQuestion($connection, $_POST);
						break;						
					case "UpdateExam":
						$returnString = UpdateAnExam($connection, $_POST);
						break;	
					case "UpdateQuestionBank":
						$returnString = UpdateAQuestion($connection, $_POST);
						break;	
					case "DeleteExam":
						$returnString = DeleteAnExam($connection, $_POST);
						break;
					case "DeleteQuestion":
						$returnString = DeleteAQuestion($connection, $_POST);
						break;	
					case "DeleteExamQuestion":
						$returnString = DeleteAnExamQuestion($connection, $_POST);
						break;	
					case "DeleteExamQuestionSet":
						$returnString = DeleteAnExamQuestionSet($connection, $_POST);
						break;	
					case "SelectUsers":
						$returnString = SelectAllUsers($connection, $_POST);
						break;
					case "SelectExams":
						$returnString = SelectAllExams($connection, $_POST);
						break;
					case "SelectQuestions":
						$returnString = SelectAllQuestions($connection, $_POST);
						break;	
					case "SelectExamQuestions":
						$returnString = SelectAllExamQuestions($connection, $_POST);
						break;
						
					case "InsertStudentQuestion":
						$returnString = InsertAStudentQuestion($connection, $_POST);
						break;		
					case "InsertStudentGrade":
						$returnString = InsertAStudentGrade($connection, $_POST);
						break;		
					case "InsertStudentExam":
						$returnString = InsertAStudentExam($connection, $_POST);
						break;	
					case "InsertStudentAnswer":
						$returnString = InsertAStudentAnswer($connection, $_POST);
						break;	

					case "UpdateStudentGrade":
						$returnString = UpdateAStudentGrade($connection, $_POST);
						break;	
					case "UpdateStudentExam":
						$returnString = UpdateAStudentExam($connection, $_POST);
						break;		
					case "UpdateStudentAnswer":
						$returnString = UpdateAStudentAnswer($connection, $_POST);
						break;		
						
					case "DeleteAllStudentExamByExamID":
						$returnString = DeleteAllOfStudentExamByExamID($connection, $_POST);
						break;	
					case "DeleteAllStudentExamByUserName":
						$returnString = DeleteAllOfStudentExamByUserName($connection, $_POST);
						break;	
					case "DeleteStudentAnswer":
						$returnString = DeleteAStudentAnswer($connection, $_POST);
						break;	
					case "DeleteStudentExam":
						$returnString = DeleteAStudentExam($connection, $_POST);
						break;	
					case "DeleteStudentQuestion":
						$returnString = DeleteAStudentQuestion($connection, $_POST);
						break;	
					case "DeleteStudentGrade":
						$returnString = DeleteAStudentGrade($connection, $_POST);
						break;	

					case "SelectSpecificStudentAnswer":
						$returnString = SelectASpecificStudentAnswer($connection, $_POST);
						break;
					case "SelectAllStudentAnswers":
						$returnString = SelectAllOfStudentAnswers($connection, $_POST);
						break;
					case "SelectStudentExams":
						$returnString = SelectAStudentExams($connection, $_POST);
						break;
					case "CheckStudentExamExists":
						$returnString = StudentExamExists($connection, $_POST);
						break;
					case "SelectSpecificStudentGrade":
						$returnString = SelectASpecificStudentGrade($connection, $_POST);
						break;
					case "SelectAllStudentGrades":
						$returnString = SelectAllOfStudentGrades($connection, $_POST);
						break;
					case "SelectStudentFinalGrades":
						$returnString = SelectAStudentFinalGrades($connection, $_POST);
						break;
					case "SelectSpecificStudentQuestion":
						$returnString = SelectASpecificStudentQuestion($connection, $_POST);
						break;
					case "SelectAllStudentQuestions":
						$returnString = SelectAllOfStudentQuestions($connection, $_POST);
						break;
					
					case "SelectSpecificQuestion":
						$returnString = SelectSpecificQuestion($connection, $_POST);
						break;
						
					case "SelectRandomExamQuestion":
						$returnString = SelectRandomQuestion($connection, $_POST);
						break;	
						
					case "GradeQuestion":
						$returnString = GradeAQuestion($_POST);
						break;
						
						
					case "SelectSpecificStudentComment":
						$returnString = SelectASpecificStudentComment($connection, $_POST);
						break;
					case "SelectAllStudentComments":
						$returnString = SelectAllOfStudentComments($connection, $_POST);
						break;						
					case "DeleteStudentComment":
						$returnString = DeleteAStudentComment($connection, $_POST);
						break;						
					case "InsertStudentComment":
						$returnString = InsertAStudentComment($connection, $_POST);
						break;
					case "UpdateStudentComment":
						$returnString = UpdateAStudentComment($connection, $_POST);
						break;		

					case "SelectSpecificProfessorComment":
						$returnString = SelectASpecificProfessorComment($connection, $_POST);
						break;
					case "SelectAllProfessorComments":
						$returnString = SelectAllOfProfessorComments($connection, $_POST);
						break;						
					case "DeleteProfessorComment":
						$returnString = DeleteAProfessorComment($connection, $_POST);
						break;						
					case "InsertProfessorComment":
						$returnString = InsertAProfessorComment($connection, $_POST);
						break;
					case "UpdateProfessorComment":
						$returnString = UpdateAProfessorComment($connection, $_POST);
						break;	
						

					case "GetExamState":
						$returnString = GetExamState($connection, $_POST);
						break;	


					case "SelectQuestionsOrdered":
						$returnString = SelectQuestionsOrdered($connection, $_POST);
						break;	

					case "SelectSingleExam":
						$returnString = GetSingleExam($connection, $_POST);
						break;	
						
					case "SelectQuestionsSearch":
						$returnString = SelectQuestionsSearch($connection, $_POST);
						break;
						
					case "SelectAllExamQuestionsDetailed":
						$returnString = SelectAllExamQuestionsDetailed($connection, $_POST);
						break;
						
					case "SelectAllReviewInfo":
						$returnString = SelectAllReviewInfo($connection, $_POST);
						break;	
						
					case "SelectASpecificStudentGradeParts":
						$returnString = SelectASpecificStudentGradeParts($connection, $_POST);
						break;	
						
					case "SelectASpecificStudentGradePartsAll":
						$returnString = SelectASpecificStudentGradePartsAll($connection, $_POST);
						break;	
						
					case "InsertMultipler":
						$returnString = InsertAMultiplier($connection, $_POST);
						break;
						
					case "UpdateMultiplier":
						$returnString = UpdateAMultiplier($connection, $_POST);
						break;
						
					case "DeleteMultiplier":
						$returnString = DeleteAMultiplier($connection, $_POST);
						break;
						
					case "SelectASpecificMultiplier":
						$returnString = SelectASpecificMultiplier($connection, $_POST);
						break;
						
					case "SelectAllExamMultipliers":
						$returnString = SelectAllExamMultipliers($connection, $_POST);
						break;
						
					case "SelectExamTotalPoints":
						$returnString = SelectExamTotalPoints($connection, $_POST);
						break;
						
						
					default:
						$returnString = "Unknown Identity";
						break;
				}
				
				echo($returnString . "<br>");
				
			}
			
		}
		
		
	}
	
}

?>