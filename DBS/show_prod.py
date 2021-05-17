import pymysql.cursors


# Connect to the database
connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             database='pathfindingdbs',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

indice = -1
with connection:
    with connection.cursor() as cursor:
        sql = "SELECT `indiceProd`, `nombreProd` FROM `productos` WHERE `catProd`='Celulares'"
        cursor.execute(sql)
        result = cursor.fetchall()

        for item in result:
            print("="*10)
            print(item)


        sql = "SELECT COUNT(*) FROM `productos`"
        cursor.execute(sql)
        size = cursor.fetchone()
        realsize = size['COUNT(*)']

        #for _ in range(realsize):
            # sql = "SELECT `nombreProd` FROM `productos` WHERE `mainProd`='assets/img/producto139-m.png'"
            # sql = "select * from productos catProd='Celulares' limit 10"
            
            # sql = "select * from productos where catProd='Celulares'"

            # indice += 1
            # cursor.execute(sql, indice)
            # cursor.execute(sql)

            # result = cursor.fetchone()

            # print(result) if not None else print("VACIO\n")
        

