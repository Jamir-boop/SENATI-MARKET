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


while True:
    connection = conectar()
    # Peticion para obtener codigoProd
    try:
        with connection.cursor() as cursor:
            sql = "SELECT `codigoProd` FROM `producto` LIMIT 1;"

            cursor.execute(sql)
            codigoPedido = cursor.fetchone()

            if codigoPedido is not None:
                obj = Gen(codigoPedido["codigoProd"], "PRO")
                entrada = obj.generar()

                print(codigoPedido["codigoProd"])
                print(entrada)

                # Peticion para update
                conn = conectar()
                try:
                    with conn.cursor() as cursor:
                        sql = "UPDATE `producto` SET `codigoProd` = %s WHERE `producto`.`codigoProd` = %s;"

                        cursor.execute(sql, (entrada, codigoPedido["codigoProd"]))

                        # guardando
                        conn.commit()
                        print("guardado", "\n")
                finally:
                    conn.close()

            else:
                print("terminado")
                break

    finally:
        connection.close()
