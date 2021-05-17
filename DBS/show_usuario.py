import pymysql.cursors

# Connect to the database
connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             database='pathfindingdbs',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

with connection:
    # with connection.cursor() as cursor:
    #     # Create a new recorpymysqld
    #     sql = "INSERT INTO `usuario` (`email`, `password`) VALUES (%s, %s)"
    #     cursor.execute(sql, ('webmaster@python.org', 'very-secret'))
    # # connection is not autocommit by default. So you must commit to save
    # # your changes.
    # connection.commit()

    with connection.cursor() as cursor:
        sql = "SELECT COUNT(*) FROM `cliente`"
        cursor.execute(sql)
        size = cursor.fetchone()

        realsize = size['COUNT(*)']
        index = 0
        val = ""

        for _ in range(realsize - 1):
            # Read a single 
            index = int(index)
            index += 1

            if index <= 9:
                val = "CLI0"
            else:
                val = "CLI"

            sql = "SELECT `nombreCliente`, `claveCliente` FROM `cliente` WHERE `codigoCliente`=%s"

            index = str(index)

            salida = val + index

            if int(index) - 1 == 0:
                salida = "CLI00"

            cursor.execute(sql, salida)

            result = cursor.fetchone()
            print(salida)
            print(result) if not None else print("vacio")
