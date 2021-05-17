# archivo = open("CAT_SMA.txt", "r", encoding="utf-8")
archivo = open("casemica.txt", "r")

contenido = archivo.read()

producto = contenido.split("@")
# columna = producto[1].split("$")
# secundarias = columna[6].split("+")

# print(secundarias)

columna = []
indice = -1
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
			print("="*20)
			print(indice)
			print(nombre)
	

