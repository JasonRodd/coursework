/*
 * parser.cpp
 *
 */

#include "ParseTree.h"
#include "parser.h"
#include "var.h"



void printError(string err){
	cerr << linenum << ": " << err;
}



ParseTree *Program(stack<TokeWLine> *stack){
	ParseTree *sl = StmtList(stack);

	if(!stack->empty()){
		//cout << "missing SC" << endl;
	}

	return sl;
}

ParseTree *StmtList(stack<TokeWLine> *stack){
	ParseTree *stmt = Stmt(stack);

	if(stack->top().getToken() == Token::SC){
		stack->pop();
	} else {
		return NULL;
	}


	if(stmt != 0 && !stack->empty()) {
		return new StatementList(stmt,StmtList(stack) );
	}

	return stmt;
}

ParseTree *Stmt(stack<TokeWLine> *stack){
	if(stack->top().getToken() == Token::PRINTKW){
		stack->pop();
		return new PrintStatement(Aop(stack));
	} else if(stack->top().getToken() == Token::INTKW){
		stack->pop();
		Token toke = stack->top().getToken();
		stack->pop();
		return new DeclStatement(toke.getLexeme(),INTEGER);
	} else if(stack->top().getToken() == Token::STRKW){
		stack->pop();
		Token toke = stack->top().getToken();
		stack->pop();
		return new DeclStatement(toke.getLexeme(),STRING);
	} else {
		return new AssignStatement(Aop(stack));
	}
}

Expression *Aop(stack<TokeWLine> *stack){
	if(stack->top().getToken() == Token::VAR){
		TokeWLine topToken = stack->top();
		stack->pop();
		if(stack->top().getToken() == Token::EQOP){
			stack->pop();
			Variable *var = new Variable(topToken.getToken().getLexeme());
			Expression *aop = Aop(stack);
			return new AssignOp(var,aop);
		} else {
			stack->push(topToken);
			return new Expression(Expr(stack),0);
		}
	}

		return new Expression(Expr(stack),0);
}

Expression *Expr(stack<TokeWLine> *stack){
	Expression *term = Term(stack);
	while(stack->top().getToken() == Token::PLUSOP || stack->top().getToken() == Token::MINUSOP){
		if(stack->top().getToken() == Token::PLUSOP){
			stack->pop();
			Expression *exp = Expr(stack);
			return new AddOp(term,exp);
		} else if(stack->top().getToken() == Token::MINUSOP){
			stack->pop();
			Expression *exp = Expr(stack);
			return new SubtractOp(term,exp);
		}
	}

	return new Expression(term,0);

/*	if(newTop == Token::PLUSOP){
		stack->pop();
		return new AddOp(term,Term(stack));
	} else if(newTop == Token::MINUSOP){
		stack->pop();
		return new SubtractOp(term,Term(stack));
	} else {
		return new Expression(term,0);
	}*/

}

Expression *Term(stack<TokeWLine> *stack){
	ParseTree *prime = Primary(stack);
	stack->pop();

	while(stack->top().getToken() == Token::STAROP){
		stack->pop();
		return new MultiplyOp(new Expression(prime,0),Term(stack));
	}

	return new Expression(prime,0);


/*
	if(newTop == Token::STAROP){
		stack->pop();
		return new MultiplyOp(new Expression(prime,0),Term(stack));
	} else {
		return new Expression(prime,0);
	}*/

}

ParseTree *Primary(stack<TokeWLine> *stack){
	if(stack->top().getToken() == Token::SCONST){
		return new SConstant(stack->top().getToken().getLexeme());
	} else if(stack->top().getToken() == Token::ICONST){
		return new IConstant(stack->top().getToken().getLexeme());
	} else if(stack->top().getToken() == Token::VAR){
		return new Variable(stack->top().getToken().getLexeme());
	} else if(stack->top().getToken() == Token::LPAREN){
		stack->pop();
		Expression *aop = Aop(stack);
		return new Expression(aop,0);
	} else {
		return 0;
	}
}


