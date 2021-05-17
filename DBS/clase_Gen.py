class Gen:
    def __init__(self, codigo, tipo):
        self.entrada = codigo
        self.tipo = tipo

    def __revisar_entrada(self):
        if len(self.entrada) < 8:
            return True

    def __return_ceros(self):
        numero = self.entrada.replace(self.tipo, "")
        contador = 0

        for i in numero:
            if i == "0":
                contador += 1
            else:
                break

        return contador, int(numero)

    def generar(self):
        numero = self.__return_ceros()

        cantidad_ceros = numero[0]
        suma = numero[1]
        suma += 1

        if suma == 10 or suma == 100 or suma == 1000 or suma == 10000:
            cantidad_ceros -= 1

        if self.__revisar_entrada():
            cantidad_ceros = 8 - (len(str(suma)) + 3)

        # print(tipo + "0" * cantidad_ceros + str(suma))
        # print(len(tipo + "0" * cantidad_ceros + str(suma)))
        return self.tipo + "0" * cantidad_ceros + str(suma)


# obj = Gen("CLI00099", "CLI")
# salida = obj.generar()
# print(salida)

