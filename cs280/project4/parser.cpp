/*
 * parser.cpp
 *
 */

#include "p2lex.h"
#include "ParseTree.h"
#include <cstdlib>

ParseTree *Program(istream *);
ParseTree *StmtList(istream *);
ParseTree *Stmt(istream *);
ParseTree *Aop(istream *);
ParseTree *Expr(istream *);
ParseTree *Term(istream *);
ParseTree *Primary(istream *);

void
printError(string err, bool includeLineNum)
{
	extern int errorCount;

	errorCount++;
	if( includeLineNum ) {
		cerr << linenum << ": ";
	}
	cerr << err << endl;
}

ParseTree *
Program(istream *br)
{
	ParseTree *sl = StmtList(br);

	if( sl == 0 ) {
		printError("empty program!");
	}

	return sl;
}

ParseTree *
StmtList(istream *br)
{
	ParseTree *stmt = Stmt(br);
	if( stmt != 0 ) {
		return new StatementList(stmt,
				StmtList(br) );
	}

	return stmt;
}

// int var, string var, print expr, aop
ParseTree *
Stmt(istream *br)
{
	ParseTree *stmt = 0;
	Token t = getToken(br);

	if( t == Token::INTKW || t == Token::STRKW ) {
		Token id = getToken(br);
		if( id != Token::VAR ) {
			printError("Expecting variable name after type name");
			return 0;
		}

		stmt = new DeclStatement(id.getLexeme(),
				t == Token::INTKW ? INTEGER : STRING );
	}
	else if( t == Token::PRINTKW ) {
		ParseTree *exp = Aop(br);
		if( exp == 0 ) {
			printError("Expecting expression after print keyword");
			return 0;
		}

		stmt = new PrintStatement(exp);
	}
	else {
		pushbackToken(t);
		stmt = Aop(br);
		if( stmt == 0 ) {
			return 0;
		}
	}

	// look for semicolon
	t = getToken(br);
	if( t == Token::SC ) {
		return stmt;
	}

	// missing semicolon
	printError("Expecting a semicolon to end statement");
	delete stmt;
	return 0;
}

// Var = Aop | Expr
// Var = Aop | Term {}
// Var = Aop | Primary {} {}
// Var = Aop | SCONST {} {} | ICONST {} {} | VAR {* Term } { +|- Expr } | ( Aop ) {} {}
ParseTree *
Aop(istream *br)
{
	ParseTree *item = Expr(br);

	if( (item == 0) || (item->isVariable() == false) )
			return item;

	Token afterV = getToken(br);
	if( afterV != Token::EQOP ) {
		pushbackToken(afterV);
		return item;
	}

	ParseTree *rhs = Aop(br);
	return new AssignOp(item, rhs);
}

// Term { (+|-) Expr }
ParseTree *
Expr(istream *br)
{
	ParseTree *itemToReturn = Term(br);

	if( itemToReturn == 0 )
		return 0;

	for(;;) {
		Token t = getToken(br);
		if( t != Token::PLUSOP && t != Token::MINUSOP ) {
			pushbackToken(t);
			break;
		}

		ParseTree *term = Term(br);
		if( term == 0 ) {
			printError("Expecting expression after operator");
			return 0;
		}

		if( t == Token::PLUSOP ) {
			itemToReturn = new AddOp(itemToReturn, term);
		}
		else {
			itemToReturn = new SubtractOp(itemToReturn, term);
		}
	}

	return itemToReturn;
}

// Primary { * Term }
ParseTree *
Term(istream *br)
{
	ParseTree *itemToReturn = Primary(br);

	if( itemToReturn == 0 )
		return 0;

	for(;;) {
		Token t = getToken(br);
		if( t != Token::STAROP ) {
			pushbackToken(t);
			break;
		}

		ParseTree *term = Primary(br);
		if( term == 0 ) {
			printError("Expecting expression after operator");
			return 0;
		}

		itemToReturn = new MultiplyOp(itemToReturn, term);
	}

	return itemToReturn;
}

// SCONST | ICONST | VAR | ( Expr )
ParseTree *
Primary(istream *br)
{
	Token t = getToken(br);
	int ival;
	ParseTree *ex;

	switch( t.getType() ) {
	case Token::SCONST:
		return new SConstant( t.getLexeme() );

	case Token::ICONST:
		ival = atoi( t.getLexeme().c_str() );
		return new IConstant( ival );

	case Token::VAR:
		return new Variable( t.getLexeme() );

	case Token::LPAREN:
		ex = Aop(br);
		if( ex == 0 ) {
			printError("Expecting expression after left paren");
			return 0;
		}
		if( (t = getToken(br)) != Token::RPAREN ) {
			printError("Expecting right paren");
			return 0;
		}
		return ex;

	default:
		// an error, so return a null pointer
		return 0;
	}
}
