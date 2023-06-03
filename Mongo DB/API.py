from pymongo import MongoClient


class MusicDB:
    def __init__(self):
        self.collection = self.init_connection()

    @staticmethod
    def init_connection():
        uri = "mongodb://localhost:27017"
        client = MongoClient(uri)
        db = client['DBMS']
        return db['Music']

# ------------------------------------------------  RELEASES  ----------------------------------------------------------
    # Возвращает названия всех альбомов в бд.
    def find_all_releases(self):
        cursor = self.collection.find()
        titles = []
        for record in cursor:
            titles.append(record['title'])
        return titles

    # Принимает название, возвращает list c id подходящих альбомов.
    def find_releases(self, title):
        query = {"title": title}
        cursor = self.collection.find(query, {'title': 0, 'release date': 0, 'genre': 0, 'tracks': 0})
        data = []
        for release in cursor:
            data.append(release['_id'])
        return data

    # Принимает id, возвращает dict альбома.
    def get_release(self, _id):
        query = {"_id": _id}
        cursor = self.collection.find(query)
        for release in cursor:
            return release

    # Принимает dict альбома, красиво выводит его в консоль.
    @staticmethod
    def release_info(release):
        if not release:
            return
        title = release['title']
        date = release['release date']
        genre = release['genre']
        tracks = release['tracks']
        print(title, '(', date, ') - ', genre)
        for tr in tracks:
            print(tracks[tr]['performer'], ' - ', tr)

    # Принимает название, добавляет один пустой релиз с этим названием, возвращает id релиза.
    def add_release(self, title):
        query = {'title': title, 'release date': '', 'genre': '', 'tracks': {}}
        return self.collection.insert_one(query).inserted_id

    # Принимает id, удаляет соответствующий релиз.
    def delete_release(self, _id):
        query = {'_id': _id}
        self.collection.delete_one(query)

    # Принимает id существующего релиза и новые атрибуты, обновляет атрибуты.
    def update_release(self, _id, title, date, genre):
        query = {"_id": _id}
        info = {"$set": {'title': title, 'release date': date, 'genre': genre}}
        self.collection.update_one(query, info)

# ------------------------------------------------  TRACKS  ------------------------------------------------------------
    # Принимает id существующего релиза и атрибуты трека, добавляет новый трек или обновляет существующий.
    def update_track(self, _id, track_name, performer, path):
        tracks = self.get_release(_id)['tracks']
        tracks[track_name] = {'performer': performer, 'path': path}
        query = {"_id": _id}
        updated = {"$set": {'tracks': tracks}}
        self.collection.update_one(query, updated)

    # Принимает id существующего релиза и название трека, удаляет трек.
    def delete_track(self, _id, name):
        tracks = self.get_release(_id)['tracks']
        del tracks[name]
        query = {"_id": _id}
        updated = {"$set": {'tracks': tracks}}
        self.collection.update_one(query, updated)
