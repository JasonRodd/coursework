/*
 * p2lex.cpp
 *
 *  Created on: Feb 12, 2016
 *      Author: gerardryan
 */

#include <map>
using namespace std;

#include "p2lex.h"

// copy constructor
Token::Token(const Token& src)
{
	ttype = src.ttype;
	tlexeme = src.tlexeme;
}

// assignment op
const Token&
Token::operator=(const Token& rhs)
{
	ttype = rhs.ttype;
	tlexeme = rhs.tlexeme;
	return *this;
}

// handy table of string names for token types
static map<Token::TokenType,string> names = {
		{ Token::VAR, "var" },		// an identifier
		{ Token::SCONST, "sconst" },		// a string enclosed in ""
		{ Token::ICONST, "iconst" },		// an integer constant
		{ Token::PLUSOP, "plusop" },		// the + operator
		{ Token::MINUSOP, "minusop" },	// the - operator
		{ Token::STAROP, "starop" },		// the * operator
		{ Token::EQOP, "eqop" },		// the assignment op
		{ Token::PRINTKW, "printkw" },		// print
		{ Token::INTKW, "intkw" },			// int
		{ Token::STRKW, "strkw" },			// string
		{ Token::LPAREN, "lparen" },		// left parenthesis
		{ Token::RPAREN, "rparen" },		// right parenthesis
		{ Token::SC, "sc" },		// the semicolon
		{ Token::ERR, "err" },		// some error condition was reached
		{ Token::DONE,	"done" },	// end of file
};

// handy table to control if lexeme is printed
static map<Token::TokenType,bool> printlexeme = {
		{ Token::VAR, true },		// an identifier
		{ Token::SCONST, false },
		{ Token::ICONST, true },		// an integer constant
		{ Token::PLUSOP, false },		// the + operator
		{ Token::MINUSOP, false },	// the - operator
		{ Token::STAROP, false },		// the * operator
		{ Token::EQOP, false },		// the assignment op
		{ Token::PRINTKW, false },		// print
		{ Token::INTKW, false },			// int
		{ Token::STRKW, false },			// string
		{ Token::LPAREN, false },		// left parenthesis
		{ Token::RPAREN, false },		// right parenthesis
		{ Token::SC, false },		// the semicolon
		{ Token::ERR, true },		// some error condition was reached
		{ Token::DONE, false},	// end of file
};

ostream&
operator<<(ostream& out, const Token& t)
{
	out << names[t.getType()];
	if( printlexeme[t.getType()] )
		out << "(" << t.getLexeme() << ")";
	return out;
}
