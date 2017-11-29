//============================================================================
// Name        : project3.cpp
// Author      : Jason Rodd
// Version     :
// Copyright   :
// Description : Hello World in C++, Ansi-style
//============================================================================

#include <iostream>
#include <fstream>
#include  "p2lex.h"
#include "ParseTree.h"
#include <map>
#include <vector>
#include "var.h"
#include "Value.h"
#include<sstream>

map<string,Value> SymbolTable;
std::map<string,Value>::iterator it;

bool EvaluateProgram(ParseTree *tree);

void StatementListNode(ParseTree *tree, bool debug);
void DeclStatementNode(ParseTree *tree, bool debug);
void PrintStatementNode(ParseTree *tree, bool debug);

Value* AssignOpNode(ParseTree *tree, bool debug);
Value* AddOpNode(ParseTree *tree, bool debug);
Value* SubOpNode(ParseTree *tree, bool debug);
Value* MultOpNode(ParseTree *tree, bool debug);

int linenum = 1;
int errorCount = 0;
bool hasErrors = false;

void traverseTree(ParseTree *tree);


using namespace std;

char *inFile = "";

istream *myStream = 0;
ifstream f;

int SConstant = 0;
int IConstant = 0;
int MultiplyOp = 0;
int AddOp = 0;
int SubtractOp = 0;
int AsignOp = 0;
int Variable = 0;

bool missingSC = false;

int main(int argc, char *argv[]) {

	if(argc == 1){
		myStream = &cin;
	} else if(argc == 2){
		inFile = argv[1];

		try {
			f.open(inFile);
		} catch (std::ios_base::failure &fail) {
			cout << "f.open(inFile)  failed" << endl;
		}

		if(f.is_open()){
			myStream = &f;
		} else {
			cout << "error opening file: " << inFile << endl;
		}

	} else {
		cout << "to many command line arguments" << endl;
	}

	extern ParseTree *Program(istream *br);
	ParseTree *result = Program(myStream);

	//traverseTree(result);

	EvaluateProgram(result);

	if(!hasErrors){
		StatementListNode(result,false);
	}

/*	cout << "---------------------------" << endl;
	for (auto it=SymbolTable.begin(); it!=SymbolTable.end(); ++it){
		cout << it->first << " : " << it->second << endl;
	}*/


	if(f.is_open()){
	f.close();
	}

	return 0;
}

bool EvaluateProgram(ParseTree *tree){
	bool debugMode = true;
	StatementListNode(tree,debugMode);
}

void traverseTree(ParseTree *tree){

		cout << "Parent: " << tree->toString() << endl;
		if(tree->getLeft() != NULL){
					cout << tree->getLeft()->toString() << endl;
		}
		if(tree->getRight() != NULL){
					cout << tree->getRight()->toString() << endl;
		}

		cout << "-------------------" << endl;


		if(tree->getLeft() != NULL){
			traverseTree(tree->getLeft());
		}
		if(tree->getRight() != NULL){
			traverseTree(tree->getRight());
		}


}


void StatementListNode(ParseTree *tree, bool mode){
	//cout<< "StatementListNode" << endl;
	if(tree->getLeft() != NULL){
		if(tree->getLeft()->isDeclStatement()){
			DeclStatementNode(tree->getLeft(), mode);
		}
		if(tree->getLeft()->isPrintStatement()){
			PrintStatementNode(tree->getLeft(), mode);
		}
		if(tree->getLeft()->isAssignOp()){
			AssignOpNode(tree->getLeft(), mode);
		}
	}

	if(tree->getRight() != NULL){
		if(tree->getRight()->isStatementList()){
			StatementListNode(tree->getRight(), mode);
		}
		if(tree->getRight()->isDeclStatement()){
			DeclStatementNode(tree->getRight(), mode);
		}
		if(tree->getRight()->isPrintStatement()){
			PrintStatementNode(tree->getRight(), mode);
		}
		if(tree->getRight()->isAssignOp()){
			AssignOpNode(tree->getRight(), mode);
		}
	}

}

void DeclStatementNode(ParseTree *tree, bool mode){
	//cout<< "DeclStatementNode" << endl;
	Value *v;
	Type t = tree->getType();
	if(t == INTEGER){
		//int i = std::stoi(s);
		v = new Value(0);
	} else if(t == STRING){
		v = new Value("");
	}

	SymbolTable[tree->getIdent()]  = *v;
}

void PrintStatementNode(ParseTree *tree, bool mode){
	//cout << "PrintStatementNode" << endl;
	Value* v;

	if(tree->getLeft()->isSconst()){
		if(!mode){
		cout << tree->getLeft()->getSconstant() << endl;
		}
	}
	if(tree->getLeft()->isIconst()){
		if(!mode){
		cout << tree->getLeft()->getIconstant() << endl;
		}
	}

	if(tree->getLeft()->isAssignOp()){
		v = AssignOpNode(tree->getLeft(), mode);
		if(v->getType() != NONE){
			if(!mode){
		if(v->isInt()){
		cout << v->getIvalue() << endl;
		} else {
			cout << v->getSvalue() << endl;
		}
		}
		}
	}
	if(tree->getLeft()->isPlus()){
		v = AddOpNode(tree->getLeft(), mode);
		if(!mode){
		if(v->getType() != NONE){
		if(v->isInt()){
		cout << v->getIvalue() << endl;
		} else {
			cout << v->getSvalue() << endl;
		}
		}
		}
	}
	if(tree->getLeft()->isMinus()){
		v = SubOpNode(tree->getLeft(), mode);
		if(!mode){
		if(v->getType() != NONE){
		if(v->isInt()){
			cout << v->getIvalue() << endl;
		} else {
			cout << v->getSvalue() << endl;
		}
		}
		}
	}
	if(tree->getLeft()->isStar()){
		v = MultOpNode(tree->getLeft(), mode);
		if(!mode){
		if(v->getType() != NONE){
		if(v->isInt()){
			cout << v->getIvalue() << endl;
		} else {
			cout << v->getSvalue() << endl;
		}
		}
		}
	}

	if(tree->getLeft()->isVariable()){
		Value value;
		value = SymbolTable.at(tree->getLeft()->getVarName());
		if(!mode){
		if(value.isInt()){
			cout << value.getIvalue() << endl;
		} else {
			cout << value.getSvalue() << endl;
		}
		}
	}

}

Value* AssignOpNode(ParseTree *tree, bool mode){
	//cout << "AssignOpNode" << endl;
	Value* value;
	string ident = tree->getLeft()->getVarName();
	if(tree->getRight()->isAssignOp()){
		value = AssignOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isPlus()){
		value = AddOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isMinus()){
		value = SubOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isStar()){
		value = MultOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isSconst()){
		string str = tree->getRight()->getSconstant();
		value = new Value(str);
	} else if(tree->getRight()->isIconst()){
		int integer = tree->getRight()->getIconstant();
		value = new Value(integer);
	}

	if(SymbolTable.find(ident) == SymbolTable.end()){
		cout << "Variable " << ident << " used but not defined at line " << tree->getLineNum() << endl;
		hasErrors = true;
	} else {
		Value VarValue = SymbolTable.at(ident);
		if(VarValue.getType() == value->getType()){
			SymbolTable[ident] = *value;
		} else {
			cout << "Type mismatch on operands for assignment at line " << tree->getLineNum() << endl;
			hasErrors = true;
		}
	}




	return value;
}

Value* AddOpNode(ParseTree *tree, bool mode){
	//cout << "AddOpNode" << endl;
	Value* leftValue;
	Value* rightValue;
	Value* Evaluation;

	if(tree->getLeft()->isPlus()){
		leftValue = AddOpNode(tree->getLeft(), mode);
	} else if(tree->getLeft()->isMinus()){
		leftValue = SubOpNode(tree->getLeft(), mode);
	} else if(tree->getLeft()->isStar()){
		leftValue = MultOpNode(tree->getLeft(), mode);
	} else if(tree->getLeft()->isIconst()){
		int i = tree->getLeft()->getIconstant();
		leftValue = new Value(i);
	} else if(tree->getLeft()->isSconst()){
		string str = tree->getLeft()->getSconstant();
		leftValue = new Value(str);
	} else if(tree->getLeft()->isVariable()){
		if(SymbolTable.find(tree->getLeft()->getVarName()) == SymbolTable.end()){
			cout << "Variable " << tree->getLeft()->getVarName() << " used but not defined at line " << tree->getLineNum() << endl;
			hasErrors = true;
		} else {
			Value value = SymbolTable.at(tree->getLeft()->getVarName());
			if(value.isInt()){
				leftValue = new Value(value.getIvalue());
			} else {
				leftValue = new Value(value.getSvalue());
			}
		}
	}

	if(tree->getRight()->isPlus()){
		rightValue = AddOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isMinus()){
		rightValue = SubOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isStar()){
		rightValue = MultOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isIconst()){
		int i = tree->getRight()->getIconstant();
		rightValue = new Value(i);
	} else if(tree->getRight()->isSconst()){
		string str = tree->getRight()->getSconstant();
		rightValue = new Value(str);
	} else if(tree->getRight()->isVariable()){
		if(SymbolTable.find(tree->getRight()->getVarName()) == SymbolTable.end()){
			cout << "Variable " << tree->getRight()->getVarName() << " used but not defined at line " << tree->getLineNum() << endl;
			hasErrors = true;
		} else {
			Value value = SymbolTable.at(tree->getRight()->getVarName());
			if(value.isInt()){
				rightValue = new Value(value.getIvalue());
			} else {
				rightValue = new Value(value.getSvalue());
			}
		}
	}


	if(leftValue->isInt() && rightValue->isInt()){
		int v1 = leftValue->getIvalue();
		int v2 = rightValue->getIvalue();
		int v3 = v1 + v2;
		Evaluation = new Value(v3);
	}
	if(leftValue->isString() && rightValue->isString()){
		string v1 = leftValue->getSvalue();
		string v2 = rightValue->getSvalue();
		string v3 = v1 + v2;
		Evaluation = new Value(v3);
	}

	if(  (leftValue->isString() && rightValue->isInt()) || (leftValue->isInt() && rightValue->isString()) ){
		cout << "Type mismatch on operands for addition at line " << tree->getLineNum() << endl;
		hasErrors = true;
		Evaluation = new Value();
	}

	return Evaluation;
}

Value* SubOpNode(ParseTree *tree, bool mode){
	//cout << "SubOpNode" << endl;
	Value* leftValue;
	Value* rightValue;
	Value* Evaluation;

	if(tree->getLeft()->isPlus()){
		leftValue = AddOpNode(tree->getLeft(), mode);
	} else if(tree->getLeft()->isMinus()){
		leftValue = SubOpNode(tree->getLeft(), mode);
	} else if(tree->getLeft()->isStar()){
		leftValue = MultOpNode(tree->getLeft(), mode);
	} else if(tree->getLeft()->isIconst()){
		int i = tree->getLeft()->getIconstant();
		leftValue = new Value(i);
	} else if(tree->getLeft()->isSconst()){
		string str = tree->getLeft()->getSconstant();
		leftValue = new Value(str);
	} else if(tree->getLeft()->isVariable()){
		if(SymbolTable.find(tree->getLeft()->getVarName()) == SymbolTable.end()){
			cout << "Variable " << tree->getLeft()->getVarName() << " used but not defined at line " << tree->getLineNum() << endl;
			hasErrors = true;
		} else {
			Value value = SymbolTable.at(tree->getLeft()->getVarName());
			if(value.isInt()){
				leftValue = new Value(value.getIvalue());
			} else {
				leftValue = new Value(value.getSvalue());
			}
		}
	}

	if(tree->getRight()->isPlus()){
		rightValue = AddOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isMinus()){
		rightValue = SubOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isStar()){
		rightValue = MultOpNode(tree->getRight(), mode);
	} else if(tree->getRight()->isIconst()){
		int i = tree->getRight()->getIconstant();
		rightValue = new Value(i);
	} else if(tree->getRight()->isSconst()){
		string str = tree->getRight()->getSconstant();
		rightValue = new Value(str);
	} else if(tree->getRight()->isVariable()){
		if(SymbolTable.find(tree->getRight()->getVarName()) == SymbolTable.end()){
			cout << "Variable " << tree->getRight()->getVarName() << " used but not defined at line " << tree->getLineNum() << endl;
			hasErrors = true;
		} else {
			Value value = SymbolTable.at(tree->getRight()->getVarName());
			if(value.isInt()){
				rightValue = new Value(value.getIvalue());
			} else {
				rightValue = new Value(value.getSvalue());
			}
		}
	}


	if(leftValue->isInt() && rightValue->isInt()){
		int v1 = leftValue->getIvalue();
		int v2 = rightValue->getIvalue();
		int v3 = v1 - v2;
		Evaluation = new Value(v3);
	}
	if(leftValue->isString() && rightValue->isString()){
/*		string v1 = leftValue->getSvalue();
		string v2 = rightValue->getSvalue();
		string v3 = v1 - v2;
		Evaluation = new Value(v3);*/
		cout << "Type mismatch on operands for subtraction at line " << tree->getLineNum() << endl;
		hasErrors = true;
		Evaluation = new Value();
	}

	if(  (leftValue->isString() && rightValue->isInt())  || (leftValue->isInt() && rightValue->isString()) ){
		cout << "Type mismatch on operands for subtraction at line " << tree->getLineNum() << endl;
		hasErrors = true;
		Evaluation = new Value();
	}
	return Evaluation;
}

Value* MultOpNode(ParseTree *tree, bool mode){
		//cout << "MultOpNode" << endl;
		Value* leftValue;
		Value* rightValue;
		Value* Evaluation;

		if(tree->getLeft()->isPlus()){
			leftValue = AddOpNode(tree->getLeft(), mode);
		} else if(tree->getLeft()->isMinus()){
			leftValue = SubOpNode(tree->getLeft(), mode);
		} else if(tree->getLeft()->isStar()){
			leftValue = MultOpNode(tree->getLeft(), mode);
		} else if(tree->getLeft()->isIconst()){
			int i = tree->getLeft()->getIconstant();
			leftValue = new Value(i);
		} else if(tree->getLeft()->isSconst()){
			string str = tree->getLeft()->getSconstant();
			leftValue = new Value(str);
		} else if(tree->getLeft()->isVariable()){
			if(SymbolTable.find(tree->getLeft()->getVarName()) == SymbolTable.end()){
				cout << "Variable " << tree->getLeft()->getVarName() << " used but not defined at line " << tree->getLineNum() << endl;
				hasErrors = true;
			} else {
				Value value = SymbolTable.at(tree->getLeft()->getVarName());
				if(value.isInt()){
					leftValue = new Value(value.getIvalue());
				} else {
					leftValue = new Value(value.getSvalue());
				}
			}
		}

		if(tree->getRight()->isPlus()){
			rightValue = AddOpNode(tree->getRight(), mode);
		} else if(tree->getRight()->isMinus()){
			rightValue = SubOpNode(tree->getRight(), mode);
		} else if(tree->getRight()->isStar()){
			rightValue = MultOpNode(tree->getRight(), mode);
		} else if(tree->getRight()->isIconst()){
			int i = tree->getRight()->getIconstant();
			rightValue = new Value(i);
		} else if(tree->getRight()->isSconst()){
			string str = tree->getRight()->getSconstant();
			rightValue = new Value(str);
		} else if(tree->getRight()->isVariable()){
			if(SymbolTable.find(tree->getRight()->getVarName()) == SymbolTable.end()){
				cout << "Variable " << tree->getRight()->getVarName() << " used but not defined at line " << tree->getLineNum() << endl;
				hasErrors = true;
			} else {
				Value value = SymbolTable.at(tree->getRight()->getVarName());
				if(value.isInt()){
					rightValue = new Value(value.getIvalue());
				} else {
					rightValue = new Value(value.getSvalue());
				}
			}
		}


		if(leftValue->isInt() && rightValue->isInt()){
			int v1 = leftValue->getIvalue();
			int v2 = rightValue->getIvalue();
			int v3 = v1 * v2;
			Evaluation = new Value(v3);
		}
		if(leftValue->isString() && rightValue->isString()){
			cout << "Type mismatch on operands for multiplication at line " << tree->getLineNum() << endl;
			hasErrors = true;
			Evaluation = new Value();
		}

		string v3;
		if(  (leftValue->isString() && rightValue->isInt())  || (leftValue->isInt() && rightValue->isString()) ){
			if(leftValue->isString() && rightValue->isInt()){
				string v1 = leftValue->getSvalue();
				int v2 = rightValue->getIvalue();
				for(int i = 0; i < v2; i++){
					v3 += v1;
				}
				Evaluation = new Value(v3);
			} else {
				int v1 = leftValue->getIvalue();
				string v2 = rightValue->getSvalue();
				for(int i = 0; i < v1; i++){
					v3 += v2;
				}
				Evaluation = new Value(v3);
			}
		}


		return Evaluation;
}

