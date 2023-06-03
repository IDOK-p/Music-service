from API import MusicDB

# Методы класса MusicDB
# find_all_releases()   - Возвращает названия всех альбомов в бд.
# find_releases(title)  - Принимает название, возвращает list c id подходящих альбомов.
# get_release(id)       - Принимает id, возвращает dict альбома.
# release_info(release) - Принимает dict альбома, красиво выводит его в консоль.
# add_release(title)    - Принимает название, добавляет один пустой релиз с этим названием, возвращает id релиза.
# delete_release(id)    - Принимает id, удаляет соответствующий релиз.
# update_release(id, title, date, genre) - Принимает id существующего релиза и новые атрибуты, обновляет атрибуты.
# update_track(id, track_name, performer, path) - Принимает id существующего релиза и атрибуты трека,
# добавляет новый трек или обновляет существующий.
# delete_track(id, name) - Принимает id существующего релиза и название трека, удаляет трек.

# Создаём БД
db = MusicDB()

# Просмотрим, какие сейчас есть релизы в базе данных
print('\n         Current releases')
print(db.find_all_releases())

# Поищем релизы (сначала введём ерунду)
print("\n         Search")
info = db.find_releases('aboba')
print('Returned:', info)        # должно вывести [] - пустой лист
db.release_info(info)           # Если info пустое, то метод ничего не делает

# Теперь поищем нормальный релиз
info = db.find_releases('Brothers in Christ')
print('\nReturned:', info)

# Выведем информацию об альбоме
print("\n         Info")
print('Original format\n', db.get_release(info[0]))
# А теперь в нормальном виде...
print('Readable format')
db.release_info(db.get_release(info[0]))

# Поработаем с редактированием релизов.
# Добавляем 3 релиза и сохраняем их id в лист
print("\n         Addition")
added_ids = []
for i in range(3):
    _id = db.add_release("aboba release"+str(i))
    added_ids.append(_id)
print('Releases: ', db.find_all_releases())
print('Added_ids: ', added_ids)

# Теперь удалим эти три релиза, передав лист с id-шниками
print("\n        Disposal!")
for i in added_ids:
    db.delete_release(i)
print('Releases: ', db.find_all_releases())

# Теперь попробуем пройти полный путь релиза в базе данных.
print("\n\n        Full Life Circle Testing")

# Создадим пустой релиз aboba, сохраним его id
aboba_id = db.add_release("aboba")
# если релиз уже создан, можно найти его id через поиск, примерно вот так:
# aboba_id = db.get_release(db.find_releases('aboba')[0])

# Выведем о нём информацию (её нет, он пока маленький)
aboba_data = db.get_release(aboba_id)
print('Newborn Aboba!')
print(aboba_data)
db.release_info(aboba_data)

# Теперь проапгрейдим абобу - дадим ему нормальное название, дату выхода и жанр:
db.update_release(aboba_id, 'Great Aboba', '14.04.2023', 'Hell Abomination Sounds')

# Какой же альбом без треков? Добавим!
db.update_track(aboba_id, "Buzzing of Flies in Beelzebub's Abdomen", "DoomJazz Orchestra", 'C://womb/')
db.update_track(aboba_id, "Howls of The Lost Souls", "Mad Preachers Choir", 'C://womb/')
db.update_track(aboba_id, "Collapsing Foundations of Your Mind", "DJ Dogma", 'C://womb/')
db.update_track(aboba_id, "OFF WITH HER HEAD!", "Queen of Hearts", 'C://womb/')
db.update_track(aboba_id, "Peaceful Murmurs of Crickets in The Night", "Mother Nature", 'C://womb/')

# Ой, последний трек не сюда... Удаляем!
db.delete_track(aboba_id, "Peaceful Murmurs of Crickets in The Night")

# Теперь абоба - балдёжный альбом!
print('\nAboba is adult!')
db.release_info(db.get_release(aboba_id))

# Абобе конец, и его лейбл-правообладатель отправляет его обратно в пучины Ада.
print('\n        The End!\n')
db.delete_release(aboba_id)
print(db.find_all_releases())

