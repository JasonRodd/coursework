'''
Created on Oct 19, 2017
@author: Jason Rodd
'''
from __future__ import division
import ast
import json  
import sys
import TreeWalker
import FunctionTester



errors = []

try:
    funcname = sys.argv[1] 
    arguments = sys.argv[2] 
    testcases = sys.argv[3] 
    testcases = testcases.rstrip("\n")
    rulesets = sys.argv[4]
    rulesets = rulesets.rstrip("\n")
    answer = sys.argv[5]
    multiplier = float(sys.argv[6])
except Exception as e:
    errors.append("1: " + str(e))


gradePart1 = 0
gradePart2 = 0
gradePart3 = 0    

gradePart1_comments = []
gradePart2_comments = []
gradePart3_comments = []   
    
def checkNaming(funcname, arguments, answer):
    
    try:
        totalpoints = 0
        splitArgs = arguments.split(",")
        totalArgs = len(splitArgs)
        
        astTree = ast.parse(answer)
        Luke = TreeWalker.tree_walker()
        functions = Luke.SearchFor(astTree, ast.FunctionDef)
        
        
        if functions[0].name == funcname:
            totalpoints += 0.5
        else:
            gradePart1_comments.append("Improper name: " + str(totalpoints))
        

        argus = functions[0].args    
        argsFound = 0
        
        userArgs = []
        for arg in argus.args:
            userArgs.append(arg.id)
        
        for argument in splitArgs:
            if argument in userArgs:
                argsFound += 1
            else:
                appenStr = "Argument " + argument + " is missing: -" + str(round(((1.0/totalArgs)/2) * multiplier,2))
                gradePart1_comments.append(appenStr)
                    
            """
            for arg in argus.args:
                if arg.id in splitArgs:
                    argsFound += 1
                else: 
                    appenStr = "Argument " + arg.id + " is bad: -" + str((1/totalArgs)) 
                    gradePart1_comments.append(appenStr)
                    """
                    
        
        percentFound = round(argsFound/totalArgs,2)
        totalpoints += float(percentFound/2.0)
        totalpoints *= multiplier
        return str(totalpoints)
    except Exception  as e:
        errors.append("2: " + str(e))
        gradePart1_comments.append("Did not compile, unable to find function name and arguments: " + str(0.1 * multiplier))
        return '0'
try: 
    gradePart1 = checkNaming(funcname, arguments, answer)
except Exception as e:
    errors.append("3: " + str(e))
    gradePart1 = '0'
    
def checkTestCase(testcases, answer):
    errors.append(answer)
    try:
        fun = FunctionTester.functionTester(answer)
        testcaseList = testcases.split("\n")
        totalTests = len(testcaseList)
        correctTests = 0
        
        astTree = ast.parse(answer)
        Luke = TreeWalker.tree_walker()
        functions = Luke.SearchFor(astTree, ast.FunctionDef)
        funcname = functions[0].name
        
        for testcase in testcaseList:
            testcaseSplit = testcase.split("~")
            

            formatedstr = testcaseSplit[0].replace("|","'")
            errors.append(formatedstr)
            
            returnedValue, printedValue = fun.Test(formatedstr, funcname)
            
            if len(printedValue) != 0:
                errors.append(str(printedValue[0]) + " : " + str(testcaseSplit[1]))
                if str(printedValue[0]) == str(testcaseSplit[1]):
                    correctTests += 1
                else:
                    appenStr = "given arguments " + str(testcaseSplit[0]) + " incorrect print: -" + str(round(((1.0/totalTests)*7) * multiplier,2)) 
                    gradePart2_comments.append(appenStr)
            else:
                errors.append(str(returnedValue) + " : " + str(testcaseSplit[1]))
                if str(returnedValue) == str(testcaseSplit[1]):
                    correctTests += 1
                #elif str(returnedValue) != str(testcaseSplit[1]) or (str(returnedValue) == None and str(testcaseSplit[1]) != None):
                else:
                    appenStr = "given arguments " + str(testcaseSplit[0]) + " incorrect output: -" + str(round(((1.0/totalTests)*7) * multiplier,2)) 
                    gradePart2_comments.append(appenStr)
            
            
        return str((((correctTests/totalTests)*7)*multiplier))
    except Exception as e:
        errors.append("4: " + str(e))
        gradePart2_comments.append("Did not compile, could not check testcases: " + str(0.7 * multiplier))
        return '0'
try:        
    gradePart2 = checkTestCase(testcases, answer)
except Exception as e:
    errors.append("5: " + str(e))
    gradePart2 = '0'

def checkRules(rulesets, answer):
    try:
        rulesList = rulesets.split("\n")
        totalRules = len(rulesList)
        correctRules = 0
        
        astTree = ast.parse(answer)
        Luke = TreeWalker.tree_walker()
        
        for rule in rulesList:
            nodes = rule.split(":")
            
            matchs = Luke.SearchFor(astTree, getattr(ast, nodes[0]))
            del(nodes[0])
            
           
            
            for node in nodes:
                possibles = []
                for lookNode in matchs:
                    possibles += Luke.SearchFor(lookNode, getattr(ast, node))
                
                matchs = possibles

                
            if len(possibles) > 0:
                    correctRules += 1 
            else:
                appenStr = "The ruleset < " + rule + " > was not found in your code: -" + str(round(((1.0/totalRules)*2) * multiplier,2)) 
                gradePart3_comments.append(appenStr)
                 
            
            """
            matchs = Luke.SearchFor(astTree, getattr(ast, nodes[0]))
            del(nodes[0])
            
            for node in nodes:
                bigList = []
                newList = []
                for l in matchs:
                    newList = Luke.SearchFor(l, getattr(ast, node))
                bigList += newList
            
            if len(bigList) > 0:
                correctRules += 1
            """
            
        percentCorrect = correctRules/totalRules
        return str(((2 * percentCorrect)*multiplier))
    except Exception as e:
        errors.append("6: " + str(e))
        gradePart3_comments.append("Did not compile, could not check ruleset: " + str(0.2 * multiplier))
        return '0'
try:    
    gradePart3 = checkRules(rulesets, answer)
    #print(str(gradePart3))
except Exception as e:
    errors.append("7: " + str(e))
    gradePart3 = '0'

try:
    gradeDict = {'err': errors,'gradePart1': gradePart1,'gradePart2': gradePart2,'gradePart3': gradePart3, 'gradePart1_comments': gradePart1_comments, 'gradePart2_comments': gradePart2_comments, 'gradePart3_comments': gradePart3_comments}
    DictDump = json.dumps(gradeDict)  
    #theJSON= json.loads(DictDump)
    #print(theJSON)
    print(DictDump)
except Exception as e:
    print("8: " + e)
