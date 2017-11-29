//============================================================================
// Name        : BridgeProgram.cpp
// Author      : Jason Rodd
// Version     : 12.23.12.12.11.11.1.1.1.1.1.123.123.14.15.1
// Copyright   : Your copyright notice
// Description : Calculates the bridge hands!
//============================================================================

#include <iostream>
#include <string>
#include <fstream>
#include <cctype>
#include <vector>

using namespace std;

const int ERROR = 0;
const int GETTING_CARD = 1;
const int ADD_CARD_TO_HAND = 2;
const int CALCULATE_HAND_VALUE = 3;


int currentState;
string card;
char inChar;
vector<string> Hand;
int cardsInHand = 0;
int errorState = 0;
int currentHand = 1;

//ErrorStates
// 0 = no error
// 1 = Bad format
// 2 = wrong num of cards
// 3 = duplicates found


void DoLogic(int currentState);
int SetState(char input);
void HandValue(vector<string> Hand);
bool isDuplicate(string inCard, vector<string> inHand);
void ChangeErrorState(int i);


int main() {
	while((inChar = cin.get()) != EOF ) {
		//decides which state we are in based on inChar
		currentState = SetState(inChar);
		//decides what should be done based on currentState
		DoLogic(currentState);
	}
	return 0;
}


void DoLogic(int currentState){

	if(currentState == GETTING_CARD){

		card += inChar;

	}else if(currentState == ADD_CARD_TO_HAND){

		if(card.size() == 2){

			if(isDuplicate(card,Hand)){
				ChangeErrorState(3);
			}


			if(card.substr(0,1) == "2"  || card.substr(0,1) == "3"  || card.substr(0,1) == "4"  || card.substr(0,1) == "5"  || card.substr(0,1) == "6"  || card.substr(0,1) == "7"  || card.substr(0,1) == "8"  || card.substr(0,1) == "9"  || card.substr(0,1) == "J"  || card.substr(0,1) == "Q"  || card.substr(0,1) == "K"  || card.substr(0,1) == "A"){
				if(card.substr(1,2) == "C" || card.substr(1,2) == "D" || card.substr(1,2) == "H" || card.substr(1,2) == "S"){
					Hand.push_back(card);
					cardsInHand += 1;
				} else {
					ChangeErrorState(1);
				}
			} else {
				ChangeErrorState(1);
			}

		}

		//special case for 10
		if(card.size() == 3){

			if(isDuplicate(card.substr(0,1) + card.substr(2,3), Hand)){
				ChangeErrorState(3);
			}


			if(card.substr(0,1) == "1"){
				if(card.substr(2,3) == "C" || card.substr(2,3) == "D" || card.substr(2,3) == "H" || card.substr(2,3) == "S"){
					Hand.push_back(card.substr(0,1) + card.substr(2,3));
					cardsInHand += 1;
				} else {
					ChangeErrorState(1);
				}
			} else {
				ChangeErrorState(1);
			}

		}


		if(card.size() != 0 && card.size() != 2 && card.size() != 3){
			ChangeErrorState(1);
		}


		card = "";

	}else if(currentState == CALCULATE_HAND_VALUE){

		if(card != ""){
			ChangeErrorState(1);
		}

		if(cardsInHand != 13 && errorState == 0){
			ChangeErrorState(2);
		}

		if(errorState == 0){
			HandValue(Hand);
		} else if(errorState == 1){
			cout << "BAD FORMAT" << endl;
		} else if(errorState == 2){
			cout << "WRONG NUMBER OF CARDS" << endl;
		} else if(errorState == 3){
			cout << "DUPLICATE CARDS" << endl;
		}

		Hand.clear();
		cardsInHand = 0;
		errorState = 0;
	}

}

void ChangeErrorState(int i){
	if(errorState == 0){
		errorState = i;
	}
}


bool isDuplicate(string inCard, vector<string> inHand){
	for(int i=0; i < inHand.size(); i++){
		if(inCard == inHand[i]){
			return true;
		}
	}
	return false;
}


void HandValue(vector<string> Hand){
	int handValue = 0;
	int numAces = 0;
	int numJacks = 0;
	int numQueens = 0;
	int numKings = 0;
	int numSpades = 0;
	int numHearts = 0;
	int numClubs = 0;
	int numDiamonds = 0;

	for(int i = 0; i < Hand.size(); i++){
		if(Hand[i].substr(0,1) == "A"){
			numAces += 1;
		}
		if(Hand[i].substr(0,1) == "J"){
			numJacks += 1;
		}
		if(Hand[i].substr(0,1) == "Q"){
			numQueens += 1;
		}
		if(Hand[i].substr(0,1) == "K"){
			numKings += 1;
		}

		if(Hand[i].substr(1,2) == "S"){
			numSpades += 1;
		}
		if(Hand[i].substr(1,2) == "H"){
			numHearts += 1;
		}
		if(Hand[i].substr(1,2) == "C"){
			numClubs += 1;
		}
		if(Hand[i].substr(1,2) == "D"){
			numDiamonds += 1;
		}

	}


	handValue += (numAces*4);
	handValue += (numKings*3);
	handValue += (numQueens*2);
	handValue += (numJacks*1);


	if(numAces == 0){
		handValue -= 1;
	}
	if(numAces == 4){
		handValue += 1;
	}

	if(numKings == 1){
		handValue -= 1;
	}
	if(numQueens == 1){
		handValue -= 1;
	}
	if(numJacks == 1){
		handValue -= 1;
	}

	if(numSpades > 4){
		handValue += (numSpades-4);
	}
	if(numHearts > 4){
		handValue += (numHearts-4);
	}
	if(numClubs > 4){
		handValue += (numClubs-4);
	}
	if(numDiamonds > 4){
		handValue += (numDiamonds-4);
	}

	if(numSpades == 0){
		handValue += 3;
	}
	if(numHearts == 0){
		handValue += 3;
	}
	if(numClubs == 0){
		handValue += 3;
	}
	if(numDiamonds == 0){
		handValue += 3;
	}

	if(numSpades == 1){
		handValue += 2;
	}
	if(numHearts == 1){
		handValue += 2;
	}
	if(numClubs == 1){
		handValue += 2;
	}
	if(numDiamonds == 1){
		handValue += 2;
	}

	if(numSpades == 2){
		handValue += 1;
	}
	if(numHearts == 2){
		handValue += 1;
	}
	if(numClubs == 2){
		handValue += 1;
	}
	if(numDiamonds == 2){
		handValue += 1;
	}


	cout << "HAND " << currentHand << " TOTAL POINTS " << handValue << endl;
	currentHand += 1;
}




int SetState(char input){
	int state;

	if(input == '.'){
		state = CALCULATE_HAND_VALUE;
	}else if(input == ','|| input == ' ' || (int) input == 10){
		// 10 = ascii new line char
		state = ADD_CARD_TO_HAND;
	} else if(isalnum(input)){
		state = GETTING_CARD;
	} else{
		state = ERROR;
	}

	return state;
}

