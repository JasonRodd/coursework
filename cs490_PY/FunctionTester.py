'''
Created on Oct 20, 2017
@author: Jason Rodd
'''
import sys

class ListStream:
    def __init__(self):
        self.data = []
    def write(self, s):
        self.data.append(s)
    def flush(self):
        pass

class functionTester():
    
    def __init__(self, answer):
        try:
            self.comp = compile(answer, '<string>', 'exec')
            #print(answer)
        except:
            pass
        
        
    def Test(self, args, funcname):
        sys.stdout = x = ListStream()
        try:
            exec(self.comp, globals())
            
            #print(formatedstr)
            #print(formatedstr)
            returnedData = eval(funcname + "(" + args + ")")
            
            sys.stdout = sys.__stdout__
            printedData = x.data
            return returnedData, printedData
        except Exception as e:
            print("--"+str(e)+"--")
            return ""
    
    
