/*
 * getToken.cpp
 *
 *  Created on: Mar 1, 2016
 *      Author: Jason
 */

#include "p2lex.h"
#include <string>
#include <cctype>
#include <iostream>
#include <fstream>

bool isSymbol(char c);
void PushChar(char c);

string lexeme;
Token *toke;
char c;
Token::TokenType theToken;

istream* STREAM;

string START = "START";
string DONE = "DONE";
string ERR = "ERR";

string STRING_CONSTANT = "STRING_CONSTANT";
string INT_CONSTANT = "INT_CONSTANT";
string VARIABLE = "VARIABLE";

string FIRST_CHAR_LETTER = "FIRST_CHAR_LETTER";
string FIRST_CHAR_DIGIT = "FIRST_CHAR_DIGIT";
string FIRST_CHAR_SYMBOL = "FIRST_CHAR_SYMBOL";

string STRING_1 = "STRING_1";
string STRING_2 = "STRING_2";
string STRING_3 = "STRING_3";
string STRING_4 = "STRING_4";
string STRING_5 = "STRING_5";
string STRING_6 = "STRING_6";

string INT_1 = "INT_1";
string INT_2 = "INT_2";
string INT_3 = "INT_3";

string PRINT_1 = "PRINT_1";
string PRINT_2 = "PRINT_2";
string PRINT_3 = "PRINT_3";
string PRINT_4 = "PRINT_4";
string PRINT_5 = "PRINT_5";

string PLUS = "PLUS";
string MINUS = "MINUS";
string STAR = "STAR";
string DIVISION = "DIVISION";
string SEMICOLLEN = "SEMICOLLEN";
string LEFT_PARAM = "LEFT_PARAM";
string RIGHT_PARAM = "RIGHT_PARAM";

string COMMA = "COMMA";

int i = 0;

string currentState;

Token getToken(istream* br){
	currentState = START;
	lexeme = "";
	theToken = Token::DONE;

	while(!br->eof()){

		if(currentState == DONE){
			break;
		}

		if(currentState == ERR){
				theToken = Token::ERR;
				break;
		}


		char c = br->get();

		if((int) c == 10 && currentState == COMMA){
			currentState = START;
			lexeme = "";
		}

		//cout << c << endl;

/*
		if(c == ' ' && currentState == VARIABLE){
			currentState = DONE;
			continue;
		} else if(c == ' ' && currentState != STRING_CONSTANT){
			continue;
		}

		if((int) c == 10 && currentState == STRING_CONSTANT){
			currentState = ERR;
		} else if((int) c == 10 && currentState == COMMA2){
			currentState = START;
			lexeme = "";
			cout << "laughy taffy" << endl;
		} else if((int) c == 10 && currentState == VARIABLE){
			currentState = DONE;
			continue;
		} else if((int) c == 10){
			continue;
		}*/


		if(currentState == START){
			if(isalpha(c)){
				currentState = FIRST_CHAR_LETTER;
			} else if(isdigit(c)){
				currentState = FIRST_CHAR_DIGIT;
			} else if(isSymbol(c)){
				currentState = FIRST_CHAR_SYMBOL;
			}
		}

		//----------------------------------------------------

		if(currentState == FIRST_CHAR_LETTER){
			PushChar(c);
			theToken = Token::VAR;
			if(c == 's'){
				currentState = STRING_1;
			} else if(c == 'i'){
				currentState = INT_1;
			} else if(c == 'p'){
				currentState = PRINT_1;
			} else if(isalpha(c)){
				currentState = VARIABLE;
			}
			continue;
		}

		if(currentState == FIRST_CHAR_DIGIT){
			PushChar(c);
			currentState = INT_CONSTANT;
			theToken = Token::ICONST;
			continue;
		}

		if(currentState == FIRST_CHAR_SYMBOL){
			PushChar(c);
				if(c == '-'){
					theToken = Token::MINUSOP;
					currentState = DONE;
				}else if(c == '+'){
					theToken = Token::PLUSOP;
					currentState = DONE;
				}else if(c == '*'){
					theToken = Token::STAROP;
					currentState = DONE;
				}else if(c == '"'){
					currentState = STRING_CONSTANT;
					theToken = Token::SCONST;
				}else if(c == ';'){
					theToken = Token::SC;
					currentState = DONE;
				}else if(c == '('){
						theToken = Token::LPAREN;
						currentState = DONE;
				}else if(c == ')'){
						theToken = Token::RPAREN;
						currentState = DONE;
				} else if(c == '='){
					theToken = Token::EQOP;
					currentState = DONE;
				} else if(c == '/'){
					if(br->peek() == '/'){
						currentState = COMMA;
					} else {
						currentState = ERR;
					}
				}


			continue;
		}

		//------------------------------------------------------

		if(currentState == STRING_1){
				if(isalnum(c)){
					if(c == 't'){
						currentState = STRING_2;
					} else {
						currentState = VARIABLE;
					}
					PushChar(c);
				} else {
					currentState = DONE;
					br->putback(c);
				}
			continue;
		}
		if(currentState == STRING_2){
			if(isalnum(c)){
				if(c == 'r'){
					currentState = STRING_3;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == STRING_3){
			if(isalnum(c)){
				if(c == 'i'){
					currentState = STRING_4;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == STRING_4){
			if(isalnum(c)){
				if(c == 'n'){
					currentState = STRING_5;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == STRING_5){
			if(isalnum(c)){
				if(c == 'g'){
					theToken = Token::STRKW;
					currentState = STRING_6;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == STRING_6){
			if(isalnum(c)){
				theToken = Token::VAR;
				currentState = VARIABLE;
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}

		//-------------------------------------------------------

		if(currentState == INT_1){
			if(isalnum(c)){
				if(c == 'n'){
					currentState = INT_2;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == INT_2){
			if(isalnum(c)){
				if(c == 't'){
					theToken = Token::INTKW;
					currentState = INT_3;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == INT_3){
			if(isalnum(c)){
				theToken = Token::VAR;
				currentState = VARIABLE;
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}

		//-------------------------------------------------------

		if(currentState == PRINT_1){
			if(isalnum(c)){
				if(c == 'r'){
					currentState = PRINT_2;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == PRINT_2){
			if(isalnum(c)){
				if(c == 'i'){
					currentState = PRINT_3;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == PRINT_3){
			if(isalnum(c)){
				if(c == 'n'){
					currentState = PRINT_4;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == PRINT_4){
			if(isalnum(c)){
				if(c == 't'){
					theToken = Token::PRINTKW;
					currentState = PRINT_5;
				} else {
					currentState = VARIABLE;
				}
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}
		if(currentState == PRINT_5){
			if(isalnum(c)){
				currentState = VARIABLE;
				PushChar(c);
			} else {
				currentState = DONE;
				br->putback(c);
			}
			continue;
		}

		//-------------------------------------------------------

		if(currentState == VARIABLE){
			if(isalnum(c)){
				PushChar(c);
			} else if(c == ' ' || (int) c == 10) {
				currentState = DONE;
			} else {
				currentState = DONE;
				br->putback(c);
			}

			continue;
		}
		if(currentState == STRING_CONSTANT){
			PushChar(c);
			if((int) c == 10){
				currentState = ERR;
			}else if(c == '"'){
				currentState = DONE;
			}
			continue;
		}

		if(currentState == INT_CONSTANT){
				if(isdigit(c)){
					currentState = INT_CONSTANT;
					PushChar(c);
				} else if(c == ' ' || (int) c == 10){
					currentState = DONE;
				} else {
					currentState = DONE;
					br->putback(c);
				}
			}
			continue;


	}

	toke = new Token(theToken,lexeme);

	return *toke;
}



void PushChar(char c){
	lexeme += c;
}

bool isSymbol(char c){
	return c == '-' || c == '+' || c == '*' || c == '(' || c == ')' || c == ';' || c == '"' || c == '=' || c == '/';
}
