import pymysql

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             database='senatimarketdbs',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

try:
    with connection.cursor() as cursor:

        cursor.execute('SELECT VERSION()')

        version = cursor.fetchone()

        print(f'Database version: {version[0]}')

finally:

    connection.close()
