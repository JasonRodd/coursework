
#include "p2lex.h"
#include <string>

int linenum = 1;


//copy constructor
Token::Token(const Token& toke){
	ttype = toke.ttype;
	tlexeme = toke.tlexeme;
}

//Assignment operator
const Token& Token::operator=(const Token& rhs){
	Token *toke = new Token(rhs.getType(),rhs.getLexeme());


	return *toke;
}


//print operator
ostream& operator<<(ostream& out, const Token& t){
	string VAR = "var";		// an identifier
	string SCONST = "sconst";		// a string enclosed in ""
	string ICONST = "iconst";	// an integer constant
	string PLUSOP = "plusop";		// the + operator
	string MINUSOP = "minusop";	// the - operator
	string STAROP = "starop";		// the * operator
	string EQOP = "eqop";		// the assignment op
	string PRINTKW = "printkw";		// print
	string INTKW = "intkw";			// int
	string STRKW = "strkw";			// string
	string LPAREN = "lparen";		// left parenthesis
	string RPAREN = "rparen";		// right parenthesis
	string SC = "sc";		// the semicolon
	string ERR = "err";		// some error condition was reached
	string DONE = "done";		// end of file

	if(t.getType() == Token::VAR){
		out << VAR << "(" << t.getLexeme() << ")";
	} else if(t.getType() == Token::SCONST){
		out << SCONST << "(" << t.getLexeme() << ")";
	} else if(t.getType() == Token::ICONST){
		out << ICONST << "(" << t.getLexeme() << ")";
	} else if(t.getType() == Token::PLUSOP){
		out << PLUSOP;
	} else if(t.getType() == Token::MINUSOP){
		out << MINUSOP;
	} else if(t.getType() == Token::STAROP){
		out << STAROP;
	} else if(t.getType() == Token::EQOP){
		out << EQOP;
	} else if(t.getType() == Token::PRINTKW){
		out << PRINTKW;
	} else if(t.getType() == Token::INTKW){
		out << INTKW;
	} else if(t.getType() == Token::STRKW){
		out << STRKW;
	} else if(t.getType() == Token::LPAREN){
		out << LPAREN;
	} else if(t.getType() == Token::RPAREN){
		out << RPAREN;
	} else if(t.getType() == Token::SC){
		out << SC;
	} else if(t.getType() == Token::ERR){
		out << ERR << "(" << t.getLexeme() << ")";
	} else if(t.getType() == Token::DONE){
		out << DONE;
	}





	return out;
}





