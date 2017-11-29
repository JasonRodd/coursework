//============================================================================
// Name        : project3.cpp
// Author      : Jason Rodd
// Version     :
// Copyright   : 
// Description : Hello World in C++, Ansi-style
//============================================================================

#include <iostream>
#include <fstream>
#include <stack>
#include  "p2lex.h"
#include "parser.h"
#include "ParseTree.h"
#include <map>
#include <vector>
#include "var.h"


void traverseTree(ParseTree *tree);
void traverseTreeDeclarations(ParseTree *tree);
bool noSC(ParseTree *tree);

void printThings();
void printNotDeclared();

using namespace std;

char *inFile = "";

istream *myStream = 0;
ifstream f;

vector<string> undeclaredVars;
vector<variable*> vars;
vector<int> nullStrings;

bool lexicalError = false;

stack<TokeWLine> lexicalStack;
stack<TokeWLine> *ls;

stack<TokeWLine> buildLexicalStack();
bool isCritical(ParseTree *tree);
bool inVector(vector<string> vec, string s);

int count = 0;

ParseTree myProgram;

map<string,int> counterMap;
map<string,string> variableMap;

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

	lexicalStack = buildLexicalStack();
	ls = &lexicalStack;


	if(!lexicalError){
		myProgram = Program(ls);
	}

	ParseTree *finished;
	finished = &myProgram;

	traverseTree(finished);
	traverseTreeDeclarations(finished);

	missingSC = ls->empty();

	if(!missingSC){

		cout << ls->top().getLine() << ": Expecting a semicolon to end statement" << endl;

	} else {


		map<string,int>::iterator it;
			for(it = counterMap.begin(); it != counterMap.end(); it++){
					if(it->first == "SConstant"){
						SConstant = it->second;
					}
					if(it->first == "IConstant"){
						IConstant = it->second;
					}
					if(it->first == "MultiplyOp"){
						MultiplyOp = it->second;
					}
					if(it->first == "AddOp"){
						AddOp = it->second;
					}
					if(it->first == "SubtractOp"){
						SubtractOp = it->second;
					}
					if(it->first == "AsignOp"){
						AsignOp = it->second;
					}
					if(it->first == "Variable"){
						Variable = it->second;
					}

			}


		printThings();

		printNotDeclared();

		for(int i = 0; i < nullStrings.size(); i++){
			cout << "Null string at line " << nullStrings[i] << endl;
		}


	}

	if(f.is_open()){
	f.close();
	}

	return 0;
}

stack<TokeWLine> buildLexicalStack(){

	Token *toke;
	TokeWLine *T;
	stack<TokeWLine> stackTemp;
	stack<TokeWLine> reversed;

	while(true){
		toke = new Token(getToken(myStream));
		T = new TokeWLine(toke,linenum);

		if(toke->getType() == Token::DONE){
			break;
		} else if(toke->getType() == Token::ERR){
			lexicalError = true;
			break;
		} else if(toke->getType() == Token::VAR){
			variable *v = new variable(toke->getLexeme(),linenum);
			vars.push_back(v);
			stackTemp.push(*T);
		} else if(toke->getType() == Token::SCONST){
			if(toke->getLexeme() == "\"\""){
				nullStrings.push_back(linenum);
			}
			stackTemp.push(*T);
		} else {
			stackTemp.push(*T);
		}
	}

	if(!lexicalError){
		while(!stackTemp.empty()){
			T = new TokeWLine(stackTemp.top());
			stackTemp.pop();
			reversed.push(*T);
		}
	}

	return reversed;
}


void printThings(){
	if(IConstant > 0){
		cout << IConstant << " ICONST, ";
	} else {
		cout << "0 ICONST, ";
	}
	if(SConstant > 0){
		cout << SConstant << " SCONST, ";
	} else {
		cout << "0 SCONST, ";
	}
	if(Variable > 0){
		cout << Variable << " VARIABLES" << endl;
	} else {
		cout << "0 VARIABLES" << endl;
	}



	if(AddOp > 0){
		cout << "Number of add operators: " << AddOp << endl;
	} else {
		cout << "Number of add operators: 0" << endl;
	}

	if(SubtractOp > 0){
		cout << "Number of subtract operators: " << SubtractOp << endl;
	} else {
		cout << "Number of subtract operators: 0" << endl;
	}

	if(MultiplyOp > 0){
		cout << "Number of multiply operators: " << MultiplyOp << endl;
	} else {
		cout << "Number of multiply operators: 0" << endl;
	}

	if(AsignOp > 0){
		cout << "Number of assignment operators: " << AsignOp << endl;
	} else {
		cout << "Number of assignment operators: 0" << endl;
	}
}


void printNotDeclared(){
	for(int i = 0; i<undeclaredVars.size(); i++){
		string undeclared = undeclaredVars[i];
		for(int i = 0; i<vars.size(); i++){
			string currentVar = vars[i]->getVar();
			int line = vars[i]->getLine();
			if(undeclared == currentVar){
				cout << "Variable " << undeclared << " used but not defined at line " << line << endl;
			}
		}
	}

}

void traverseTree(ParseTree *tree){

/*		cout << "Parent: " << tree->toString() << endl;
		if(tree->getLeft() != NULL){
					cout << tree->getLeft()->toString() << endl;
		}
		if(tree->getRight() != NULL){
					cout << tree->getRight()->toString() << endl;
		}*/

		if(isCritical(tree)){
			counterMap[tree->toString()]++;
		}


		if(tree->getLeft() != NULL){
			traverseTree(tree->getLeft());
		}
		if(tree->getRight() != NULL){
			traverseTree(tree->getRight());
		}
}

void traverseTreeDeclarations(ParseTree *tree){

	if(tree->toString() == "DeclStatement"){
		variableMap[tree->getdeclaredVar()]  = "Declared";
	}

	if(tree->toString() == "Variable"){
		if(variableMap.find(tree->getvar()) == variableMap.end()){
			if(!inVector(undeclaredVars,tree->getvar())){
				undeclaredVars.push_back(tree->getvar());
			}
		}
	}

	if(tree->getLeft() != NULL){
		traverseTreeDeclarations(tree->getLeft());
	}
	if(tree->getRight() != NULL){
		traverseTreeDeclarations(tree->getRight());
	}
}

bool inVector(vector<string> vec, string s){
	for(int i = 0; i<vec.size(); i++){
		if(vec[i] == s){
			return true;
		}
	}
	return false;
}


bool isCritical(ParseTree *tree){
	if(tree->toString() == "SConstant"){
		return true;
	}
	if(tree->toString() == "IConstant"){
		return true;
	}
	if(tree->toString() == "MultiplyOp"){
		return true;
	}
	if(tree->toString() == "AddOp"){
		return true;
	}
	if(tree->toString() == "SubtractOp"){
		return true;
	}
	if(tree->toString() == "AsignOp"){
		return true;
	}
	if(tree->toString() == "Variable"){
		return true;
	}
	return false;
}
