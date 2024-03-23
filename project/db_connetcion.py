import pymongo

url = 'mongodb://localhost:27017'

stagiaire = pymongo.MongoClient(url)

db = stagiaire['gestion_stagiaire']