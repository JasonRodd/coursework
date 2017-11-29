//Jason Rodd cs435 6631 mp
#include <iostream>
#include <fstream>
#include <stdio.h>
#include <stdlib.h>
#include <math.h>

using namespace std;

struct Lexicon {
	int n;
	int m;
	char **T;
	char *A;
	char *lastNull;
};

Lexicon* HashCreate(int size);
bool HashEmpty(Lexicon L);
bool hashFull(Lexicon L);
void HashInsert(Lexicon *L, string word);
bool HashDelete(Lexicon *L, string word);
int HashSearch(Lexicon *L, string word);
void HashPrint(Lexicon L);
void HashBatch(char *filename);

int main(int argc, char *argv[]) {
	
	if(argc == 1){
		cout << argv[0] << endl;
	} else if (argc == 2){
			
		HashBatch(argv[1]);
		
	} else {
		cout << "to many arguments" << endl;
	}
	
	
	
}

void HashBatch(char *filename){
		ifstream inFile;
		inFile.open(filename);
		string str;
		Lexicon *L;
		
		while(getline(inFile,str)){
			string op = "";
			string compliment = "";
			bool hasSpace = false;
			int len = str.length();
			for(int i = 0; i < len; i++){
				string c = str.substr(i,1);
				if(c == " "){
					hasSpace = true;
					op = str.substr(0,i);
					compliment = str.substr(i+1,((len-i)-2));	
					break;
				}
			}
			
			if(!hasSpace){
				if(len == 3){
					op = str.substr(0,len-1);
				} else {
					op = str.substr(0,len);
				}
			}
			
			//cout << "'" << op << "'" << " : " << "'" << compliment << "'" << endl;
			
			if(op == "10"){
					HashInsert(L,compliment);
			} else if(op == "11"){
					HashDelete(L,compliment);
			} else if(op == "12"){
					//cout << "a12a" << endl;
			} else if(op == "13"){
					HashPrint(*L);
					
			}else if(op == "14"){
					int m = atoi(compliment.c_str());
					L = HashCreate(m);
			}
			
		}
		
		inFile.close();
}

Lexicon* HashCreate(int size){
	
	Lexicon *L = new Lexicon;
	L->n = 0;
	L->m = size;

	L->T = new char*[size];
	for(int i = 0; i < size; i++){
		L->T[i] = new char;
		*L->T[i] = (char) 255;
	}

	//L->T = t;
	
	L->A = new char[15 * size];
	for(int i = 0; i < (15*size); i++){
		L->A[i] = ' ';
	}
	L->lastNull = &L->A[0];
	return L;
}

void HashInsert(Lexicon *L, string word){
	bool validInsert = false;
	int sum = 0;
	for(int i = 0; i < word.length(); i++){
		char *c = &word.at(i);
		//cout << *c << endl;
		sum += (int) *c;
	}
	
	for(int i = 0; i < L->m; i++){
		int poll = sum % L->m;
		poll += pow(i,2);
		poll = poll % L->m;
		//cout << poll << endl;
		
		if( *L->T[poll] == (char) 255 or *L->T[poll] == (char) 254 ){
			validInsert = true;
			char *start;
			start = L->lastNull + sizeof(char);
			L->T[poll] = L->lastNull + sizeof(char);
			for(int i = 0; i < word.length(); i++){
				char *c = &word.at(i);
				*start = *c;
				start += sizeof(char);
			}
			*start = '\0';
			L->lastNull = start;

			break;
		}
	}
	
}

bool HashDelete(Lexicon *L, string word){
	int poll = HashSearch(L,word);
	*L->T[poll] = (char) 254;
	//cout << poll << endl;
}

int HashSearch(Lexicon *L, string word){
	int found = -1;
	
	int sum = 0;
	for(int i = 0; i < word.length(); i++){
		char *c = &word.at(i);
		//cout << *c << endl;
		sum += (int) *c;
	}
	
	for(int i = 0; i < L->m; i++){
		int poll = sum % L->m;
		poll += pow(i,2);
		poll = poll % L->m;
		//cout << poll << endl;
		
	if( *L->T[poll] != (char) 255 or *L->T[poll] != (char) 254 ){
			int i = 0;
			char *c = &word.at(i);
			char *k = L->T[poll];
			if(*c == *k){
				found = poll;
				while(*k != '\0' && i != word.length()-1){
					i++;
					c = &word.at(i);
					k += sizeof(char);
					if (*c == *k){
						continue;
					} else {
						found = -1;
						break;
					}
				}
				
				
				break;
			}
	}
	}
		
	
	return found;
}

bool HashEmpty(Lexicon L){
	if(L.n == 0){
		return 1;
	} else {
		return 0;
	}
}

bool hashFull(Lexicon L){
	if(L.n == L.m){
		return 1;
	} else {
		return 0;
	}
}


void HashPrint(Lexicon L){
	
	int l = 0;
	int len = 15 * L.m;
	for(int i = 0; i < len; i++){
		cout << L.A[i];
	}
	cout << l << endl;
	
	for(int i = 0; i < L.m; i++){
		cout << i << ": ";
		char *c = L.T[i];
		if(*c > (int) 0 && *c < (int) 127){
			while(*c != '\0'){
				cout << *c;
				c += sizeof(char);
			}
		}
		cout << endl;
	}
	
	

}




