import pymysql.cursors

# archivo = open("CAT_SMA.txt", "r", encoding="utf-8")
archivo = open("casemica.txt", "r")
contenido = archivo.read()

producto = contenido.split("@")
columna = []


# Connect to the database
connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             database='pathfindingdbs',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)
indice = 125
with connection:
    with connection.cursor() as cursor:
        # Create a new recorpymysqld
        sql = "INSERT INTO `productos` (`indiceProd`, `catProd`, `nombreProd`, `precioProd`, `descProd`, `mainProd`, `secProd`) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        for i in range(len(producto)):
            if i != 0:
                indice += 1
                columna = producto[i].split("$")
                cat = columna[1]
                nombre = columna[2]
                precio = columna[3]
                desc = columna[4]
                imgMain = columna[5]
                sec = columna[6]

                cursor.execute(sql, (indice, cat, nombre, precio, desc, imgMain, sec))
            # guardando
            connection.commit()

# UPDATE productos
# SET catProd='Memorias USB-SD'
# WHERE catProd='CATEGORIA_ALMACENAMIENTO\n';

#DELETE FROM productos WHERE catProd='';    

