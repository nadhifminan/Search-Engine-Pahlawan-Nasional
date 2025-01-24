import re
import sys
import json
import pickle
import math

#Argumen check
if len(sys.argv) !=3 :
	print ("\n\\Use python \n\t tf-idf.py [data.json] [output]\n")
	sys.exit(1)


#data argumen
input_data = sys.argv[1]
output_data = sys.argv[2]

with open(input_data, 'r', encoding='utf-8') as file:
        content = json.load(file)
        
sw = open("stopword.txt").read().split("\n")

# Clean string function
def clean_str(text) :
	text = (text.encode('ascii', 'ignore')).decode("utf-8")
	text = re.sub("&.*?;", "", text)
	text = re.sub(">", "", text)    
	text = re.sub("[\]\|\[\@\,\$\%\*\&\\\(\)\":]", "", text)
	text = re.sub("-", " ", text)
	text = re.sub("\.+", "", text)
	text = re.sub("^\s+","" ,text)
	text = text.lower()
	return text



df_data={}
tf_data={}
idf_data={}

i=0;
for data in content :
	tf={} 
	#clean and list word
	clean_title = clean_str(data['nama'])
	list_word = clean_title.split(" ")
	
	for word in list_word :
		if word in sw:
			continue
		
		#tf term frequency
		if word in tf :
			tf[word] += 1
		else :
			tf[word] = 1

		#df document frequency
		if word in df_data :
			df_data[word] += 1
		else :
			df_data[word] = 1

	tf_data[data['img']] = tf


# Calculate Idf
for x in df_data :
   idf_data[x] = 1 + math.log10(len(tf_data)/df_data[x])

tf_idf = {}

for word in df_data:
	list_doc = []
	for data in content:
		tf_value = 0

		if word in tf_data[data['img']] :
			tf_value = tf_data[data['img']][word]

		weight = tf_value * idf_data[word]

		doc = {
			'img' : data['img'],
			'nama' : data['nama'],
			'namaLngkp' : data['nama2'],
			'asal' : data['asal'],
			'kategori' : data['kategori'],
			'history' : data['history'],
			'lahir' : data['lahir'],
			'gugur' : data['gugur'],
			'lokMakam' : data['lokasimakam'],
			'score' : weight
		}

		if doc['score'] != 0 :
			if doc not in list_doc:
				list_doc.append(doc)
		
		
	tf_idf[word] = list_doc

# Write dictionary to file
with open(output_data, 'wb') as file:
     pickle.dump(tf_idf, file)