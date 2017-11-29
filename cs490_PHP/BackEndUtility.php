<?php
#Jason Rodd
#10-4-17

function ValidateBackendUser($connection, $user, $secret) {
	$isValid = False;
	
	$select = "SELECT username, secret FROM BackendUsers";
	$result = $connection->query($select);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if($row["username"] == $user && $row["secret"] == $secret){
				$isValid = True;
				return $isValid;
			}
		}
	}
	
	
	
	return $isValid;
}

function ask($post){
	$returnString = "";
	
	if(empty($post["question"])){
		$returnString = "Possible Backend Operations:<br>";
		$returnString = $returnString . "ValidateUser<br>";
		$returnString = $returnString . "ValidateMiddleUser<br>";
		
		$returnString = $returnString . "InsertExam<br>";
		$returnString = $returnString . "InsertQuestion<br>";
		$returnString = $returnString . "InsertExamQuestion<br>";
		$returnString = $returnString . "UpdateExam<br>";
		$returnString = $returnString . "UpdateQuestionBank<br>";
		$returnString = $returnString . "DeleteExam<br>";
		$returnString = $returnString . "DeleteQuestion<br>";
		$returnString = $returnString . "DeleteExamQuestion<br>";
		$returnString = $returnString . "DeleteExamQuestionSet<br>";
		$returnString = $returnString . "SelectUsers<br>";
		$returnString = $returnString . "SelectExams<br>";
		$returnString = $returnString . "SelectQuestions<br>";
		$returnString = $returnString . "SelectExamQuestions<br>";
		
		
		$returnString = $returnString . "UpdateStudentGrade<br>";
		$returnString = $returnString . "UpdateStudentExam<br>";
		$returnString = $returnString . "UpdateStudentAnswer<br>";
		$returnString = $returnString . "DeleteAllStudentExamByExamID<br>";
		$returnString = $returnString . "DeleteAllStudentExamByUserName<br>";
		$returnString = $returnString . "DeleteStudentAnswer<br>";
		$returnString = $returnString . "DeleteStudentExam<br>";
		$returnString = $returnString . "DeleteStudentQuestion<br>";
		$returnString = $returnString . "DeleteStudentGrade<br>";
		$returnString = $returnString . "SelectSpecificStudentAnswer<br>";
		$returnString = $returnString . "SelectAllStudentAnswers<br>";
		$returnString = $returnString . "SelectStudentExams<br>";
		$returnString = $returnString . "CheckStudentExamExists<br>";
		$returnString = $returnString . "SelectSpecificStudentGrade<br>";
		$returnString = $returnString . "SelectAllStudentGrades<br>";
		$returnString = $returnString . "SelectStudentFinalGrades<br>";
		$returnString = $returnString . "SelectSpecificStudentQuestion<br>";
		$returnString = $returnString . "SelectAllStudentQuestions<br>";	
		$returnString = $returnString . "InsertStudentQuestion<br>";
		$returnString = $returnString . "InsertStudentGrade<br>";
		$returnString = $returnString . "InsertStudentExam<br>";
		$returnString = $returnString . "InsertStudentAnswer<br>";
		$returnString = $returnString . "GradeQuestion<br>";
		$returnString = $returnString . "SelectSpecificQuestion<br>";
		$returnString = $returnString . "SelectRandomExamQuestion<br>";
		
		$returnString = $returnString . "SelectSpecificStudentComment<br>";
		$returnString = $returnString . "SelectAllStudentComments<br>";
		$returnString = $returnString . "DeleteStudentComment<br>";
		$returnString = $returnString . "InsertStudentComment<br>";
		$returnString = $returnString . "UpdateStudentComment<br>";
		
		$returnString = $returnString . "SelectSpecificProfessorComment<br>";
		$returnString = $returnString . "SelectAllProfessorComments<br>";
		$returnString = $returnString . "DeleteProfessorComment<br>";
		$returnString = $returnString . "InsertProfessorComment<br>";
		$returnString = $returnString . "UpdateProfessorComment<br>";
		
		$returnString = $returnString . "SelectASpecificMultiplier<br>";
		$returnString = $returnString . "SelectAllExamMultipliers<br>";
		$returnString = $returnString . "SelectExamTotalPoints<br>";
		$returnString = $returnString . "DeleteMultiplier<br>";
		$returnString = $returnString . "InsertMultipler<br>";
		$returnString = $returnString . "UpdateMultiplier<br>";
		
		
		$returnString = $returnString . "GetExamState<br>";
		
		$returnString = $returnString . "SelectQuestionsOrdered<br>";
		
		$returnString = $returnString . "SelectSingleExam<br>";
		
		$returnString = $returnString . "SelectQuestionsSearch<br>";
		
		$returnString = $returnString . "SelectAllExamQuestionsDetailed<br>";
		
		$returnString = $returnString . "SelectAllReviewInfo<br>";
		
		$returnString = $returnString . "SelectASpecificStudentGradeParts<br>";
		$returnString = $returnString . "SelectASpecificStudentGradePartsAll<br>";
		
	} else {
		
		switch ($post["question"]) {
			case "SelectASpecificMultiplier":
				$returnString = "SelectASpecificStudentGradeParts: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (examid, questionid)<br>";
				break;
				
			case "SelectAllExamMultipliers":
				$returnString = "SelectAllExamMultipliers: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (examid)<br>";
				break;
				
			case "SelectExamTotalPoints":
				$returnString = "SelectAllExamMultipliers: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (examid)<br>";
				break;
				
			case "DeleteMultiplier":
				$returnString = "DeleteMultiplier: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (examid, questionid)<br>";
				break;
			
			case "InsertMultipler":
				$returnString = "InsertMultipler: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (examid, questionid, multiplier)<br>";
				break;
				
			case "UpdateMultiplier":
				$returnString = "UpdateMultiplier: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (examid, questionid, multiplier)<br>";
				break;
	
			
			
			
			
			case "SelectASpecificStudentGradePartsAll":
				$returnString = "SelectASpecificStudentGradePartsAll: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (username, examid)<br>";
				break;
				
			case "SelectASpecificStudentGradeParts":
				$returnString = "SelectASpecificStudentGradeParts: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (username, examid, qnum)<br>";
				break;
				
			case "SelectAllReviewInfo":
				$returnString = "SelectAllReviewInfo: <br>";
				$returnString = $returnString . "Purpose: <br>";
				$returnString = $returnString . "Requirements: (username, examid)<br>";
				break;
			
			case "SelectQuestionsOrdered":
				$returnString = "SelectQuestionsOrdered: <br>";
				$returnString = $returnString . "Purpose: used to return an order list of the questionbank in either ascending or descending based on a specified colum<br>";
				$returnString = $returnString . "Requirements: Post requires post with (column, ascend) column specifies which column to order by options (questionid, name, category, difficulty) ascend should be 1 if you want ascending order otherwise put 0 for descening<br>";
				break;
			case "ValidateUser":
				$returnString = "ValidateUser: <br>";
				$returnString = $returnString . "Purpose: ValidateUser takes a set (username,secret) pair and checks to see if it is in the Users table<br>";
				$returnString = $returnString . "Requirements: Post must include \"username\" and \"secret\"<br>";
				$returnString = $returnString . "Returns: JSON object including \"username\", \"secret\", \"access\", \"firstname\", \"lastname\", \"validuser\" = true on success<br>";
				$returnString = $returnString . "Returns: JSON object including \"username\", \"secret\", \"validuser\" = false on failure<br>";
				break;
				
			case "ValidateMiddleUser":
				$returnString = "ValidateMiddleUser: <br>";
				$returnString = $returnString . "Purpose: Used to validate a user to use the middle end. Takes a (username, secret) pair and returns either true or false<br>";
				$returnString = $returnString . "Requirments: Post must include \"FrontEndUser\" and \"FrontEndSecret\"<br>";
				$returnString = $returnString . "Returns: JSON object including \"validuser\" true if valid user<br>";
				break;
			case "InsertExam":
				$returnString = "InsertExam: <br>";
				$returnString = $returnString . "Purpose: takes (duedate, questioncount, name, timelimit) and inserts 1 row into the Exams table <br>";
				$returnString = $returnString . "Requirments: post must include (questioncount name state)<br>";
				$returnString = $returnString . "Returns: \"validInsert\" as True if a row was inserted into the table<br>";
				break;
			case "InsertQuestion":
				$returnString = "InsertQuestion: <br>";
				$returnString = $returnString . "Purpose: takes (question, funcname, arguments, testcase, ruleset) and inserts 1 row into QuestionBank table <br>";
				$returnString = $returnString . "Requirments: post must include \"question\",\"funcname\",\"arguments\",\"testcase\",\"ruleset\" <br>";
				$returnString = $returnString . "Returns: \"validInsert\" as True if a row was inserted into the table<br>";
				break;
			case "InsertExamQuestion":
				$returnString = "InsertExamQuestion: <br>";
				$returnString = $returnString . "Purpose: takes a (examid, questionid) and inserts it into ExamQuestions table. This is what makes up the questions of an exam<br>";
				$returnString = $returnString . "Requirments: post must include \"examid\",\"questionid\"<br>";
				$returnString = $returnString . "Returns: \"validInsert\" as True if a row was inserted into the table<br>";
				break;			
			case "UpdateExam":
				$returnString = "UpdateExam: <br>";
				$returnString = $returnString . "Purpose: Allows you to update 1 record in the Exams table based off of its examid<br>";
				$returnString = $returnString . "Requirments: post must include \"examid\"   All other posts \"duedate\",\"questioncount\",\"name\",\"timelimit\" are optional to be updated. MUST have at least 1<br>";
				$returnString = $returnString . "Returns: \"validUpdate\" as True if a row was properly updated <br>";
				break;
			case "UpdateQuestionBank":
				$returnString = "UpdateQuestionBank: <br>";
				$returnString = $returnString . "Purpose: Allows you to update 1 record in the QuestionBank table based off of its questionid<br>";
				$returnString = $returnString . "Requirments: post must include \"questionid\"   All other posts \"question\",\"funcname\",\"arguments\",\"testcase\",\"ruleset\" are optional to be updated. MUST have at least 1 <br>";
				$returnString = $returnString . "Returns: \"validUpdate\" as True if a row was properly updated <br>";
				break;			
			case "DeleteExam":
				$returnString = "DeleteExam: <br>";
				$returnString = $returnString . "Purpose: Deletes 1 exam from the Exams table<br>";
				$returnString = $returnString . "Requirments: post must include \"examid\" which decides which exam to delete <br>";
				$returnString = $returnString . "Returns: \"validDelete\" as True if a row was properly deleted <br>";
				break;			
			case "DeleteQuestion":
				$returnString = "DeleteQuestion: <br>";
				$returnString = $returnString . "Purpose: Deletes 1 question from the QuestionBank <br>";
				$returnString = $returnString . "Requirments: post must include \"questionid\" which decides which question to delete <br>";
				$returnString = $returnString . "Returns: \"validDelete\" as True if a row was properly deleted <br>";
				break;			
			case "DeleteExamQuestion":
				$returnString = "DeleteExamQuestion: <br>";
				$returnString = $returnString . "Purpose: Deletes 1 question from ExamQuestions table<br>";
				$returnString = $returnString . "Requirments: post must include \"questionid\",\"examid\" which decides which question to delete and from which exam<br>";
				$returnString = $returnString . "Returns: \"validDelete\" as True if a row was properly deleted <br>";
				break;			
			case "DeleteExamQuestionSet":
				$returnString = "DeleteExamQuestionSet: <br>";
				$returnString = $returnString . "Purpose: Used to delete the set of all questions for an exam. This would be used for example when deleting a exam from the system. <br>";
				$returnString = $returnString . "Requirments: post must include \"examid\" which decides which exam to questions to delete<br>";
				$returnString = $returnString . "Returns: \"validDelete\" as True if a row was properly deleted <br>";
				break;
			case "SelectUsers":
				$returnString = "SelectUsers: <br>";
				$returnString = $returnString . "Purpose: Returns all users in the Users table <br>";
				$returnString = $returnString . "Requirments: no requirements <br>";
				$returnString = $returnString . "Returns: json array of all users <br>";
				break;
			case "SelectExams":
				$returnString = "SelectExams: <br>";
				$returnString = $returnString . "Purpose: Returns all Exams in the Exams table <br>";
				$returnString = $returnString . "Requirments: no requirements <br>";
				$returnString = $returnString . "Returns: json array of all exams <br>";
				break;
			case "SelectQuestions":
				$returnString = "SelectQuestions: <br>";
				$returnString = $returnString . "Purpose: Returns all Questions in the QuestionBank table <br>";
				$returnString = $returnString . "Requirments: no requirements <br>";
				$returnString = $returnString . "Returns: json array of all questions in the database <br>";
				break;
			case "SelectExamQuestions":
				$returnString = "SelectExamQuestions: <br>";
				$returnString = $returnString . "Purpose: Returns all Questions selected for a given Exam<br>";
				$returnString = $returnString . "Requirments: must include post \"examid\" to return a set of all qurstions for that exam <br>";
				$returnString = $returnString . "Returns: json array of all questions associated with a given exam <br>";
				break;	
				
				
			case "InsertStudentQuestion":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: inserts a row into the students questions ( qnum, username, questionid, examid ) which is 1 question of an exam<br>";
				$returnString = $returnString . "Requirments: must include post \"qnum\",\"username\",\"questionid\",\"examid\" qnum= the question number : username = student : questionid = the question : examid is which exam<br>";
				$returnString = $returnString . "Returns: returns \"validInsert\" true if good<br>";
				break;		
			case "InsertStudentGrade":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Inserts a row into the student grade table. This holds the grade for every question grade<br>";
				$returnString = $returnString . "Requirments: post must include ( username, examid,  qnum,  gradepart, gradevalue ) gradepart will be 1,2, or 3 grade value will be the points gotten for that part<br>";
				$returnString = $returnString . "Returns: returns \"validInsert\" true if good<br><br>";
				break;		
			case "InsertStudentExam":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Inserts a row into the student exam table This holds the exams for every student<br>";
				$returnString = $returnString . "Requirments: post must include ( username, examid, startdate, finishdate )<br>";
				$returnString = $returnString . "Returns: returns \"validInsert\" true if good<br><br>";
				break;	
			case "InsertStudentAnswer":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Inserts a row into student answer table which holds the function written for each question<br>";
				$returnString = $returnString . "Requirments: post must include ( qnum, username, questionid, examid, answer ) <br>";
				$returnString = $returnString . "Returns: returns \"validInsert\" true if good<br>";
				break;		

			case "UpdateStudentGrade":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Updates 1 grade row in StudentGrade table. We would call this once for each part of the question we want to change<br>";
				$returnString = $returnString . "Requirments: post must include (gradevalue, examid, username, qnum , gradepart) <br>";
				$returnString = $returnString . "Returns: returns \"validUpdate\" true if good<br>";
				break;	
			case "UpdateStudentExam":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Used to update either the startdate or finish date of a students exam<br>";
				$returnString = $returnString . "Requirments: post must include (username, examid)   ->  Atleast one of these is needed to be updated (startdate, finishdate)<br>";
				$returnString = $returnString . "Returns: returns \"validUpdate\" true if good<br>";
				break;		
			case "UpdateStudentAnswer":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Allows you to change the answer submitted by the student for 1 question<br>";
				$returnString = $returnString . "Requirments: post must include (examid && username && questionid && answer) <br>";
				$returnString = $returnString . "Returns: returns \"validUpdate\" true if good<br>";
				break;		
				
			case "DeleteAllStudentExamByExamID":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: deletes all exams of a specific exam<br>";
				$returnString = $returnString . "Requirments: requires examid<br>";
				$returnString = $returnString . "Returns: validDelete<br>";
				break;	
			case "DeleteAllStudentExamByUserName":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: deletes all exams by a user <br>";
				$returnString = $returnString . "Requirments: requires username<br>";
				$returnString = $returnString . "Returns: validDelete<br>";
				break;	
			case "DeleteStudentAnswer":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: deletes a students answer for a specific question<br>";
				$returnString = $returnString . "Requirments: requires username examid questionid<br>";
				$returnString = $returnString . "Returns: validDelete<br>";
				break;	
			case "DeleteStudentExam":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: deletes an exam for a student<br>";
				$returnString = $returnString . "Requirments: requires username examid<br>";
				$returnString = $returnString . "Returns: validDelete<br>";
				break;	
			case "DeleteStudentQuestion":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: deletes a question for a student <br>";
				$returnString = $returnString . "Requirments: requires username examid qnum<br>";
				$returnString = $returnString . "Returns: validDelete<br>";
				break;	
			case "DeleteStudentGrade":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: deletes a entire grade from the grades table<br>";
				$returnString = $returnString . "Requirments: requires username examid qnum<br>";
				$returnString = $returnString . "Returns: validDelete<br>";
				break;	

			case "SelectSpecificStudentAnswer":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Selects the answer of a given question for a student<br>";
				$returnString = $returnString . "Requirments: username examid questionid<br>";
				$returnString = $returnString . "Returns: <br>";
				break;
			case "SelectAllStudentAnswers":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Selects all answers for an exam for a given student<br>";
				$returnString = $returnString . "Requirments: username examid <br>";
				$returnString = $returnString . "Returns: <br>";
				break;
			case "SelectStudentExams":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: selects a list of exams for a given student<br>";
				$returnString = $returnString . "Requirments: username<br>";
				$returnString = $returnString . "Returns: <br>";
				break;
			case "CheckStudentExamExists":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: returns true or false if the exam for given student exists<br>";
				$returnString = $returnString . "Requirments: username examid<br>";
				$returnString = $returnString . "Returns: <br>";
				break;
			case "SelectSpecificStudentGrade":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Aggregates the 3 parts of a students grade for a specific question and returns it<br>";
				$returnString = $returnString . "Requirments: username examid qnum<br>";
				$returnString = $returnString . "Returns: <br>";
				break;
			case "SelectAllStudentGrades":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Aggregates the 3 parts of a students grade for all questions of a given exam<br>";
				$returnString = $returnString . "Requirments: username examid<br>";
				$returnString = $returnString . "Returns: <br>";
				break;
			case "SelectStudentFinalGrades":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Returns the final grade for a given exam for a given student<br>";
				$returnString = $returnString . "Requirments: username examid<br>";
				$returnString = $returnString . "Returns: <br>";
				break;
			case "SelectSpecificStudentQuestion":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Select a single question for a given student I.E qnum = 1  qnum=2 etc<br>";
				$returnString = $returnString . "Requirments: username examid qnum<br>";
				$returnString = $returnString . "Returns: <br>";
				break;
			case "SelectAllStudentQuestions":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Selects all questions assigned to a student for a given exam<br>";
				$returnString = $returnString . "Requirments: username examid<br>";
				$returnString = $returnString . "Returns: <br>";
				break;
				
			case "GradeQuestion":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Returns the grades for the 3 parts of the answer and the auto generated comments for them<br>";
				$returnString = $returnString . "Requirments: post must include (funcname, arguments, testcase, ruleset, answer)<br>";
				$returnString = $returnString . "Returns: json object with 6 components gradepar1, 2, and 3   also gradepar1_comments ,gradepar2_comments,gradepar3_comments<br>";
				break;
				
			case "SelectSpecificQuestion":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: Rreturns a funcname, arguments, testcases, and rulesets for a given question<br>";
				$returnString = $returnString . "Requirments: post must include (questionid)<br>";
				$returnString = $returnString . "Returns: json object with components Rreturns a funcname, arguments, testcase, and ruleset<br>";
				break;
				
			case "SelectRandomQuestion":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: return a random question from ExamQuestions thats not already in the StudentWuestions table for a given student/exam<br>";
				$returnString = $returnString . "Requirments: post must include (username, examid)<br>";
				$returnString = $returnString . "Returns: json object<br>";
				break;
				
				
			case "SelectSpecificStudentComment":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: select a specific comment for 1 question for 1 student<br>";
				$returnString = $returnString . "Requirments: post must include (username, examid, qnum) <br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
			
			case "SelectAllStudentComments":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose:  sellect all comments for a student for a specific exam<br>";
				$returnString = $returnString . "Requirments: post requires (username, examid)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
			
			case "DeleteStudentComment":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: delete a specific comment for 1 question for 1 student<br>";
				$returnString = $returnString . "Requirments: post must include (username, examid, qnum)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
				
			case "InsertStudentComment":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: inserts a comment for a student for a specific exam and question<br>";
				$returnString = $returnString . "Requirments: post must include (username, examid, qnum, comment)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
				
			case "UpdateStudentComment":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: updates a comment for a student for a specific exam and question <br>";
				$returnString = $returnString . "Requirments: post must include (username, examid, qnum, comment)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
				
				

			case "SelectSpecificProfessorComment":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: select a specific professor comment for 1 question for 1 student<br>";
				$returnString = $returnString . "Requirments: post must include (username, examid, qnum) <br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
			
			case "SelectAllProfessorComments":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose:  sellect all professor comments for a student for a specific exam<br>";
				$returnString = $returnString . "Requirments: post requires (username, examid)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
			
			case "DeleteProfessorComment":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: delete a specific professor  comment for 1 question for 1 student<br>";
				$returnString = $returnString . "Requirments: post must include (username, examid, qnum)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
				
			case "InsertProfessorComment":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: inserts a professor comment for a student for a specific exam and question<br>";
				$returnString = $returnString . "Requirments: post must include (username, examid, qnum, comment)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;	
				
			case "UpdateProfessorComment":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: updates a professor  comment for a student for a specific exam and question <br>";
				$returnString = $returnString . "Requirments: post must include (username, examid, qnum, comment)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;					
				
			case "SelectSingleExam":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: returns the information of a single exam based off of a examid<br>";
				$returnString = $returnString . "Requirments: post with (examid)<br>";
				$returnString = $returnString . "Returns: exam information<br>";
				break;
			
			case "SelectQuestionsSearch":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: returns a search into question bank<br>";
				$returnString = $returnString . "Requirments:  post requires (column, search)<br>";
				$returnString = $returnString . "Returns: questions that match your search<br>";
				break;				
				
			case "GetExamState":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: gets the state of a specific exam<br>";
				$returnString = $returnString . "Requirments:  post must include (examid)<br>";
				$returnString = $returnString . "Returns: <br>";
				break;	

			case "SelectAllExamQuestionsDetailed":
				$returnString = ": <br>";
				$returnString = $returnString . "Purpose: details of all exam questions<br>";
				$returnString = $returnString . "Requirments:  post must include (examid)<br>";
				$returnString = $returnString . "Returns: stuff<br>";
				break;	
	
			
			default:
				$returnString = "Unknown Question";
				break;
		}
		
	}
	
	return $returnString;
}



?>