//============================================================================
// Name        : project2.cpp
// Author      : Jason Rodd
// Version     :
// Copyright   : You could use it I guess, if you want, but it will cost $9.99 per use after that.. plus tax. $9.99 is a rough estimate prices may vary depending on state, month and time of day.
// Description : project 2
//============================================================================

#include <iostream>
#include <fstream>
#include <map>
#include <string>
#include  "p2lex.h"


using namespace std;

bool isVerboseMode = false;
bool isFileInput = false;
char *inFile = "";

bool done = false;

bool error = false;
Token *errorToken;

bool morethenone = false;

istream *myStream = 0;
ifstream f;

map<Token::TokenType,int> tokenMap;
map<string,int> lexemeMap;

void Lexical();


int main(int argc, char *argv[]) {


	if(argc == 1){

	} else if(argc == 2){
		string arg = argv[1];
		if(arg == "-v"){
			isVerboseMode = true;
		} else {
			isFileInput = true;
			inFile = argv[1];
		}
	} else if(argc == 3){
		string arg1 = argv[1];
		isVerboseMode = true;
		isFileInput = true;
		if(arg1 == "-v"){
			inFile =  argv[2];
		} else {
			inFile =  argv[1];
		}
	} else {
		cout << "To many command line arguments" << endl;
		done = true;
	}


	if(!isFileInput){
		myStream = &cin;
	} else {

		try {
			f.open(inFile);
		} catch (std::ios_base::failure &fail) {

		}

		if(f.is_open()){
			myStream = &f;
		}
	}

	while(!done){
		Lexical();
	}

	f.close();


	if(!error){

	if(tokenMap.size() >= 1){
		cout << "Token counts:" << endl;
	}

	map<Token::TokenType,int>::iterator i;
	for(i = tokenMap.begin(); i != tokenMap.end(); i++){
		if(i->first == Token::VAR){
			cout << "var" << ":" << i->second << endl;
		}
		if(i->first == Token::SCONST){
			cout << "sconst" << ":" << i->second << endl;
		}
		if(i->first == Token::ICONST){
			cout << "iconst" << ":" << i->second << endl;
		}
		if(i->first == Token::PLUSOP){
			cout << "plusop" << ":" << i->second << endl;
		}
		if(i->first == Token::MINUSOP){
			cout << "minusop" << ":" << i->second << endl;
		}
		if(i->first == Token::STAROP){
			cout << "starop" << ":" << i->second << endl;
		}
		if(i->first == Token::EQOP){
			cout << "eqop" << ":" << i->second << endl;
		}
		if(i->first == Token::PRINTKW){
			cout << "printkw" << ":" << i->second << endl;
		}
		if(i->first == Token::INTKW){
			cout << "intkw" << ":" << i->second << endl;
		}
		if(i->first == Token::STRKW){
			cout <<  "strkw" << ":" << i->second << endl;
		}
		if(i->first == Token::LPAREN){
			cout << "lparen" << ":" << i->second << endl;
		}
		if(i->first == Token::RPAREN){
			cout << "rparen" << ":" << i->second << endl;
		}
		if(i->first == Token::SC){
			cout << "sc" << ":" << i->second << endl;
		}
	}




	map<string,int>::iterator it;
	for(it = lexemeMap.begin(); it != lexemeMap.end(); it++){
		if(it->second >= 2){
			if(!morethenone){
				cout << "Lexemes that appear more than once:" << endl;
				morethenone = true;
			}
			cout << it->first << " (" << it->second << " times)" << endl;
		}
	}

	} else {
		cout << *errorToken << endl;
	}

	return 0;
}


void Lexical(){
	Token *t;


			t = new Token(getToken(myStream));
			if(isVerboseMode){
				if(t->getType() != Token::DONE){
				cout << *t << endl;
				}
			}



	if(t->getType() != Token::DONE){
		tokenMap[t->getType()]++;
		if(t->getType() == Token::VAR ||t->getType() == Token::ICONST || t->getType() == Token::SCONST){
			lexemeMap[t->getLexeme()]++;
		}
	}

	if(t->getType() == Token::DONE || t->getType() == Token::ERR){
		done = true;
		if(t->getType() == Token::ERR){
			error = true;
			errorToken = new Token(t->getType(),t->getLexeme());
		}
	}


}
