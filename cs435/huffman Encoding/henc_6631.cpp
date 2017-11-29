//Jason Rodd cs435 6631 mp

#include <iostream>
#include <fstream>
#include <stdio.h>
#include <stdlib.h>
#include <math.h>

using namespace std;

typedef unsigned char byte;

struct data {
	int phi;
	byte b;
};

struct TreeNode {
	data d;
	TreeNode *left;
	TreeNode *right;
};

struct ByteFrequency {
	data d;
	bool end;
	ByteFrequency *left;
	ByteFrequency *right;
};

struct PreFixes {
	string s;
	byte b;
};


long fileSize(ifstream *input);
char* setBuffer(long size, ifstream *input);
ByteFrequency* InitializeFrequencies();
void setFrequencies(long size, char *buffer, ByteFrequency *frequencies);

void BuildMinHeap(ByteFrequency *frequencies, int heapSize);
void HeapifyDown(ByteFrequency *frequencies, int i, int heapSize);
ByteFrequency ExtractMin(ByteFrequency *frequencies, int &heapSize);
ByteFrequency Insert(ByteFrequency newFreq, ByteFrequency *frequencies, int &heapSize);

ByteFrequency BuildPreFixTree(ByteFrequency *frequencies,int &heapSize);
PreFixes* InitializePreFixes();
void setPreFixes(ByteFrequency root, string pf, PreFixes *prefixes);


int main(int argc, char *argv[]) {
	if(argc == 1){
		cout << argv[0] << endl;
	} else if (argc == 2){
		PreFixes *prefixes;
		ByteFrequency *frequencies;
		ifstream *infile;
		char *buffer;
		long size;
		int heapSize = 256;
		
		
		string f = (string) argv[1] + ".huf";
		ofstream OutFile;
		OutFile.open(f.c_str(), ios::out | ios::binary);
		
		ifstream input(argv[1], ios::in|ios::binary|ios::ate);
		infile = &input;

		size = fileSize(infile);
		buffer = setBuffer(size, infile);
		frequencies = InitializeFrequencies();
		
		setFrequencies(size, buffer, frequencies);
		
		for(int i = 0; i < 256; i++){
			OutFile.write((char*)&frequencies[i].d.phi,sizeof(frequencies[i].d.phi));
		}
		
		BuildMinHeap(frequencies,heapSize);	

		prefixes = InitializePreFixes();
		
		ByteFrequency root = BuildPreFixTree(frequencies, heapSize);
		
		setPreFixes(root, "",prefixes);
		
		string bitString = "";
		for(int i = 0; i < size; i++){
			byte c = (byte) buffer[i];
			bitString += prefixes[(int) c].s;
		}
		
		//cout << bitString.length() << endl;
		
		while(bitString.length() % 8 != 0){
			bitString += '0';
		}		
		
		string substring = "";
		string good = "";
		for(int i = 0; i < bitString.length(); i+=8){
			substring = bitString.substr(i,8);
			
			int sum = 0;
			int j = 7;
			for(int i = 0; i < 8; i++){
				string bit = substring.substr(i,1);
				//cout << bit << " : ";
				sum += (bit == "1") ? pow(2,j) : 0; 
				j--;
			}
			
			//cout << endl << substring << " : " << sum << endl;
			char *c = new char;
			*c = (char) sum;
			good += *c;

			substring = "";
		}
		
		//cout << good << endl;
		OutFile.write( good.c_str(), good.size());

		
		OutFile.close();
		delete[] buffer;
		remove(argv[1]);
	} else{
		cout << "to many arguments" << endl;
	}
	
	return 0;
}

void setFrequencies(long size, char *buffer, ByteFrequency *frequencies){
	for(int i = 0; i < size; i++){
		byte b = (byte) buffer[i];
		frequencies[(int) b].d.phi++;
		//printf("%x : %x\n", b, frequencies[(int) b].b);
	}	
}

ByteFrequency* InitializeFrequencies(){
	ByteFrequency * frequencies;
	frequencies = new ByteFrequency[256];
	
	for(int i = 0; i < 256; i++){
		ByteFrequency f = {0,(byte) i, true};
		f.left = NULL;
		f.right = NULL;
		frequencies[i] = f;
	}
	
	return frequencies;
}

char* setBuffer(long size, ifstream *input){
	char * buffer;
	buffer = new char[size];
	input->read (buffer, size);
	input->close();
	return buffer;
}


long fileSize(ifstream *input){
	long size;
	size = input->tellg();
	input->seekg (0, ios::beg);
	return size;
}

void BuildMinHeap(ByteFrequency *frequencies, int heapSize){
	int c = 1;
	for(int i = ((heapSize/2)-1); i >= 0; i--){
		//cout << c << " : " << i << endl;
		c++;
		HeapifyDown(frequencies, i, heapSize);
	}
	
}

void HeapifyDown(ByteFrequency *frequencies, int i, int heapSize){
	int left = (2*i)+1;
	int right = (2*i)+2;
	int smallest = i;
	
	if (left < heapSize && frequencies[left].d.phi < frequencies[i].d.phi){
		smallest = left;
	}
	if(right < heapSize && frequencies[right].d.phi < frequencies[smallest].d.phi){
		smallest = right;
	}
	if(smallest != i){
		ByteFrequency temp = frequencies[i];
		frequencies[i] = frequencies[smallest];
		frequencies[smallest] = temp;
		HeapifyDown(frequencies, smallest, heapSize);
	}
	

}


ByteFrequency ExtractMin(ByteFrequency *frequencies, int &heapSize){
	ByteFrequency f = frequencies[0];
	frequencies[0] = frequencies[heapSize-1];
	HeapifyDown(frequencies, 0, heapSize);
	heapSize--;
	return f;
}

ByteFrequency Insert(ByteFrequency newFreq, ByteFrequency *frequencies, int &heapSize){
	heapSize++;
	frequencies[heapSize-1] = newFreq;
	//printf("--%d--\n", frequencies[heapSize-1].d.phi);
	
	int i = heapSize - 1;
	while(frequencies[(int)floor(i/2)].d.phi > frequencies[i].d.phi){
		//printf("%d is less then %d\n", frequencies[i].d.phi, frequencies[(int)floor(i/2)].d.phi);
		ByteFrequency temp = frequencies[(int)floor(i/2)];
		frequencies[(int)floor(i/2)] = frequencies[i] ;
		frequencies[i] = temp;
		i = (int)floor(i/2);
	}

}

ByteFrequency BuildPreFixTree(ByteFrequency *frequencies,int &heapSize){
	
	while(heapSize > 1){
		ByteFrequency smallest = ExtractMin(frequencies, heapSize);
		ByteFrequency secondSmallest = ExtractMin(frequencies, heapSize);
		
		ByteFrequency combined;
		combined.d.phi = smallest.d.phi + secondSmallest.d.phi;
		combined.d.b = 0;
		combined.end = false;
		
		ByteFrequency *L = new ByteFrequency;
		ByteFrequency *R = new ByteFrequency;
		
		*L = smallest;
		*R = secondSmallest;
		
		combined.left = L;
		combined.right = R;
		
		//printf("%x %d %d  -- %x %d %d  -- %x %d %d \n",smallest.d.b, smallest.d.phi, smallest.end, secondSmallest.d.b, secondSmallest.d.phi, secondSmallest.end,  combined.d.b, combined.d.phi, combined.end);
		
		Insert(combined,frequencies,heapSize);
		
	}

	
	ByteFrequency last = ExtractMin(frequencies, heapSize);
	
	
	return last;
	
}

PreFixes* InitializePreFixes(){
	PreFixes * prefixes;
	prefixes = new PreFixes[256];
	
	for(int i = 0; i < 256; i++){
		PreFixes p = {"",(byte) i};	
		prefixes[i] = p;
	}
	
	return prefixes;
}

	
void setPreFixes(ByteFrequency root, string pf, PreFixes *prefixes){

	if(!root.end){
		
		if(root.left != NULL){
			setPreFixes(*root.left,pf+'0',prefixes);
			
		}
		
		if(root.right != NULL){
			setPreFixes(*root.right,pf+'1',prefixes);	
		} 	
	} else {
		prefixes[(int) root.d.b].s = pf;
		//printf("%x : %x ", root.d.b, prefixes[(int) root.d.b].b);
		//cout << prefixes[(int) root.d.b].s << endl;
	}
}