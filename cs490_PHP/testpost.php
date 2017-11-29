<?php 
#Jason Rodd
#Written 9-14-17
#Used to send test curls to my php script.

#primative post
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertExam', 'questioncount' => '12', 'name' => 'Test Exam 2', 'state' => '1' ];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'questioncount' => '12','state' => '2', 'name' => 'Test Exam 2' , 'examid' => '35' ];
#
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectAllReviewInfo', 'username' => 'jjr42', 'examid' => '126'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectASpecificStudentGradeParts', 'username' => 'jjr42', 'examid' => '126', 'qnum' => '1'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectASpecificStudentGradePartsAll', 'username' => 'ktd6', 'examid' => '129'];


#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertMultipler', 'questionid' => '121', 'examid' => '143', 'multiplier' => '2.2'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateMultiplier', 'questionid' => '121', 'examid' => '143', 'multiplier' => '2.3'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'DeleteMultiplier', 'questionid' => '121', 'examid' => '143'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectASpecificMultiplier', 'questionid' => '121', 'examid' => '143'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectAllExamMultipliers', 'examid' => '143'];
$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectExamTotalPoints', 'examid' => '143'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'DeleteStudentComment', 'username' => 'jjr42', 'examid' => '33', 'qnum' => '1',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertStudentComment', 'username' => 'jjr42', 'examid' => '33', 'qnum' => '2', 'comment' => 'this is a comment 2'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateStudentComment', 'username' => 'jjr42', 'examid' => '333', 'qnum' => '1', 'comment' => 'this is a comment updated'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectSpecificStudentComment', 'username' => 'jjr42', 'examid' => '33', 'qnum' => '1'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectAllStudentComments', 'username' => 'jjr42', 'examid' => '33'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'DeleteProfessorComment', 'username' => 'jjr42', 'examid' => '33', 'qnum' => '1',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertProfessorComment', 'username' => 'jjr42', 'examid' => '33', 'qnum' => '2', 'comment' => 'this is a comment 2'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateProfessorComment', 'username' => 'jjr42', 'examid' => '333', 'qnum' => '2', 'comment' => 'this is a comment updated'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectSpecificProfessorComment', 'username' => 'jjr42', 'examid' => '33', 'qnum' => '2'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectAllProfessorComments', 'username' => 'jjr42', 'examid' => '33'];


#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'ValidateUser', 'username' => 'jjr42', 'secret' => 'test123',];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectAllExamQuestionsDetailed', 'examid' => '50'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'ask', 'question' => 'ValidateMiddleUser'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'GradeQuestion',];

#$tests = "-5:-1\n0:1\n1:1\n5:120";
#$rules = "FunctionDef:If\nFunctionDef:If:Return\nFunctionDef:BinOp";
#$answer = "def factorial(n):\n    if n < 0:\n        return -1\n    elif n == 0:\n        return 2\n    elif n == 1:\n        return 2\n    else:\n        return n * factorial(n-1)\n";
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'GradeQuestion', 'funcname' => 'factorial', 'arguments' => 'n','testcase' => $tests,'ruleset' => $rules, 'answer' => $answer];

#$tests = "5,6:11\n3,4:7";
#$rules = "FunctionDef:Return";
#$answer = "def addTwo(a,b):\n\treturn a+b";
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'GradeQuestion', 'funcname' => 'addTwo', 'arguments' => 'a,b','testcase' => $tests,'ruleset' => $rules, 'answer' => $answer];

#printf("ff   :   ");
#$tests = "thisisasentence,i:2\nthisisnotagoodsenetence,u:0";
#$rules = "FunctionDef:Print";
#$answer = "def LetterCount(sentence,Letter):\n    i = 0\n    for l in sentence:\n        if l == Letter:\n            i += 1\n    print(i)\n ";
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'GradeQuestion', 'funcname' => 'LetterCount', 'arguments' => 'sentence,letter','testcase' => $tests,'ruleset' => $rules, 'answer' => $answer];

#$tests = "'a','b':aba";
#print($tests);
#$rules = "FunctionDef:Return";
#$answer = "def addStrings(a,b):\n    return a + b + a";
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'GradeQuestion', 'funcname' => 'addStrings', 'arguments' => 'a,b','testcase' => $tests,'ruleset' => $rules, 'answer' => $answer];



#printf("1");

#$tests = "5:Odd\n12:Even";
#$rules = "FunctionDef:If\nFunctionDef:Print";
#$answer = "def oddEven(a):\n    if a % 2 == 0:\n        return 1\n    else:\n        return 2\n";

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'GradeQuestion', 'funcname' => 'oddEven', 'arguments' => 'a','testcase' => $tests,'ruleset' => $rules, 'answer' => $answer];


#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectRandomExamQuestion', 'username' => 'jjr42', 'examid' => '21'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectSpecificStudentQuestion', 'username' => 'jjr42', 'examid' => '2','qnum' => '1'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'GradeQuestion', 'username' => 'jjr42', 'examid' => '2','questionid' => '13'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectSpecificQuestion', 'questionid' => '16'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectQuestionsSearch', 'column' => 'category', 'search' => 'A'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectSpecificStudentAnswer','username' => 'jjr42', 'examid' => '2',  'qnum' => '5'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'CheckStudentExamExists','username' => 'jjr42', 'examid' => '2',];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertExam', 'duedate' => '2017-10-28 15:30:00', 'questioncount' => '12', 'name' => 'Test Exam 2', 'timelimit' => '03:20:00' ];

/*
$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertQuestion', 'question' => 'Write a function named foo that takes 2 parameters a and b. Inside the function assign to variable c the sum of a and b, then return c.', 'funcname' => 'foo', 'arguments' => 'a,b', 'testcase' => '2,3:5
2,2:4
203,103:306
5,11:16
4,9:13', 'ruleset' => 'functionDef:Assign:Add
functionDef:Returntestetstdsdhfgsdjfkhgsdjfhgsdjfhgsdfjhsgdfjshdfgsdjhfgdjfhgsdfjhgwueyfgsdjhfnu' ];
*/

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertExamQuestion', 'questionid' => '2', 'examid' => '2',];


#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'questioncount' => '30',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'duedate' => '2017-10-24 15:30:00',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'name' => 'test 123',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'timelimit' => '04:20:00',];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'questioncount' => '29', 'duedate' => '2017-10-23 15:30:00',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'questioncount' => '27', 'name' => 'test 1234',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'questioncount' => '27', 'timelimit' => '03:20:00',];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'duedate' => '2017-10-24 15:30:00','name' => 'test 123',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateExam', 'examid' => '2', 'duedate' => '2017-10-24 15:30:00','timelimit' => '03:20:00','name' => 'test 1234','questioncount' => '30',];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateQuestionBank', 'questionid' => '2','question' => 'write a dam function', 'funcname' => 'badfunction', 'arguments' => 'a,b,c,d', 'testcase' => 'TEST TEST TEST case', 'ruleset' => 'function:test'];

#post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'DeleteExam', 'examid' => '3',];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'DeleteExamQuestion', 'questionid' => '2', 'examid' => '2'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'DeleteExamQuestionSet', 'examid' => '2'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertExamQuestion', 'questionid' => '3', 'examid' => '2',];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectExamQuestions', 'examid' => '2'];

#'duedate' => '2017-10-28 15:30:00', 'questioncount' => '12', 'name' => 'Test Exam 2', 'timelimit' => '03:20:00'
#
#
#
#

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertStudentQuestion', 'username' => 'jjr42', 'qnum' => '1', 'examid' => '2', 'questionid' => '2',];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertStudentAnswer', 'username' => 'jjr42', 'qnum' => '1', 'examid' => '2', 'questionid' => '2', 'answer' => 'test answer'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertStudentGrade', 'username' => 'jjr42', 'qnum' => '1', 'examid' => '2', 'gradepart' => '1', 'gradevalue' => '1'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateStudentGrade', 'username' => 'jjr42', 'qnum' => '1', 'examid' => '2', 'gradepart' => '1', 'gradevalue' => '3'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateStudentAnswer', 'username' => 'jjr42', 'qnum' => '1', 'examid' => '2', 'questionid' => '2', 'answer' => 'test answer changed'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'InsertStudentExam', 'username' => 'jjr42', 'examid' => '2', 'startdate' => '1990-04-12 04:03:02','finishdate' => '1991-04-12 04:03:02'];
#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'UpdateStudentExam', 'username' => 'jjr42', 'examid' => '2', 'startdate' => '1992-04-12 04:03:02','finishdate' => '1993-04-12 04:03:02'];

#$post = ['BackEndUser' => 'jjr42','BackEndSecret' => 'pj42d33','Identity' => 'SelectSpecificStudentAnswer', 'username' => 'jjr42', 'examid' => '2', 'questionid' => '2'];
#if (!empty($_POST)){
	
	#$post = ['user' => $_POST["user"],'secret' => $_POST["secret"],];
	#echo "Incoming Post: <br>";
	#echo $_POST["user"] . " " . $_POST["secret"] . "<br><br>";

$ch = curl_init('http://afsaccess3.njit.edu/~jjr42/cs490/BackEndMagic.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$response = curl_exec($ch);
echo($response);

curl_close($ch);

	
	/*
	echo "JSON object: <br>";
	echo $response;

	echo "<br><br><br>";

	$json_object = json_decode($response, true);

	echo "JSON Parsed:<br>";
	echo "user: " . $json_object['userLogin'] . "<br>";
	echo "pass: " . $json_object['userSecret'] . "<br>";
	echo "valid: " . $json_object['Valid'] . "<br>";
*/
#}
?>
