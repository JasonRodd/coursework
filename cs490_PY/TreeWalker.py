'''
Created on Sep 27, 2017
@author: Jason Rodd
TreeWalker is a subclass of NodeVisitor located in ast library.
'''

import ast



class tree_walker(ast.NodeVisitor):
    
    def __init__(self):
        pass
        
    def SearchFor(self, starting_node,search_node):
        search_content = [] 
        children = self.getChildren(starting_node)
        
        if isinstance(starting_node, search_node):
            search_content.append(starting_node)
        
        if children != []:
            for child in children:                
                self._SearchFor(child,search_node,search_content)
        
        return search_content 
    
    def _SearchFor(self, starting_node, search_node, search_content):
        children = self.getChildren(starting_node)
        
        if isinstance(starting_node, search_node):
            search_content.append(starting_node)
             
        if children != []:
            for child in children:           
                self._SearchFor(child,search_node,search_content)
        
        return search_content  
    
    def getChildren(self,node):
        childGenerator = ast.iter_fields(node)
        children = []
        for field, value in childGenerator:
            if isinstance(value, list):
                for item in value:
                    if isinstance(item, ast.AST):
                        children.append(item)
            elif isinstance(value, ast.AST):
                children.append(value)
        return children
            
    def printChildren(self,node):
        childGenerator = ast.iter_fields(node)
        for field, value in childGenerator:
            if isinstance(value, list):
                for item in value:
                    if isinstance(item, ast.AST):
                        print(ast.dump(item))
            elif isinstance(value, ast.AST):
                print(ast.dump(value))
        
    def Debug(self,node):
        print(ast.dump(node))

