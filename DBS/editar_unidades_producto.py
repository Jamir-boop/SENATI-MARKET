import pymysql.cursors
from clase_Gen import Gen


# Connect to the database
def conectar():
    return pymysql.connect(host='localhost',
                           user='root',
                           password='',
                           database='senatimarketdbs',
                           charset='utf8mb4',
                           cursorclass=pymysql.cursors.DictCursor)


# while True:
connection = conectar()
# Peticion para obtener codigoProd
try:
    with connection.cursor() as cursor:
        sql = "UPDATE `producto` SET `unidadesProd` = %s WHERE `producto`.`categoriaProd` = %s;"

        cursor.execute(sql, ('2', 'Cables'))

        # guardando
        connection.commit()
        print("guardado", "\n")
finally:
    connection.close()
