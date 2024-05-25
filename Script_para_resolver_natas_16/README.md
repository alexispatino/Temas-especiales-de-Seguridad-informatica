# Script para resolver natas 16

# Tipo de vulnerabilidad
La vulnerabilidad de este nivel consiste en una de tipo **Blind SQL Injection**, que es es una técnica de ataque de inyección de código SQL que se basa en las respuesta de error de la página web ante determinadas entradas. Es un tipo de ataque en el que un atacante utiliza técnicas de inyección SQL para extraer información de una base de datos, pero sin que se muestren los resultados en la página web.
Este tipo de ataque se basa en la explotación de vulnerabilidades en las aplicaciones web que no filtran adecuadamente las entradas del usuario y no validan correctamente los datos que se reciben.

**Fuente:** https://www.mundotelematico.com/inyeccion-blind-sql-basada-en-sqlite/#:~:text=La%20SQL%20Blind%20injection%20es,de%20los%20parámetros%20de%20entrada.

# Mitigación de la vulnerabilidad
Para mitigar esta vulnerabilidad, basta con sanear (limpieza de las partes de aspecto sospechoso de los datos) o escapar los parámetros para que no sea posible inyectar parámetros especiales como, por ejemplo, las comillas. Al hablar de “escapar caracteres” estamos haciendo referencia a añadir la barra invertida “\” delante de las cadenas utilizadas en las consultas SQL para evitar que estas corrompan la consulta. Algunos de estos caracteres especiales que es aconsejable escapar son las comillas dobles (“), las comillas simples (‘) o los caracteres \x00 o \x1a ya que son considerados como peligrosos pues pueden ser utilizados durante los ataques.
Otra opción sería que algunos lenguajes de programacion ya ofrecen funciones para escapar los caracteres, en el caso de php, podemos optar por la función **mysql_real_scape_string()**, que toma como parámetro una cadena y la modifica evitando todos los caracteres especiales, devolviéndola totalmente segura para ser ejecutada dentro de la instrucción SQL.
Si se está trabajando con una base de datos bajo MySQL, es posible sanear los parámetros tal como se indica a continuación:
```
SELECT * FROM usuarios WHERE usuario= mysql_real_escape_string('$usuario') and mysql_real_escape_string(password='$password');
```
**Fuente:**
- https://www.welivesecurity.com/la-es/2013/04/26/funcionamiento-de-una-inyeccion-sql/
- https://pressroom.hostalia.com/white-papers/ataques-inyeccion-sql/

# Modo de uso
1. Descargar el archivo "natas16.php"
2. Usar el siguiente comando: `php natas16.php`

# Salida

```
Verificando caracteres en la contraseña...
Caracteres filtrados: bdhkmnsuvBCEHIKLRSUX0179
Usando fuerza bruta para obtener la contraseña final...
X
Xk
XkE
XkEu
XkEuC
XkEuCh
XkEuChE
XkEuChE0
XkEuChE0S
XkEuChE0Sb
XkEuChE0Sbn
XkEuChE0SbnK
XkEuChE0SbnKB
XkEuChE0SbnKBv
XkEuChE0SbnKBvH
XkEuChE0SbnKBvH1
XkEuChE0SbnKBvH1R
XkEuChE0SbnKBvH1RU
XkEuChE0SbnKBvH1RU7
XkEuChE0SbnKBvH1RU7k
XkEuChE0SbnKBvH1RU7ks
XkEuChE0SbnKBvH1RU7ksI
XkEuChE0SbnKBvH1RU7ksIb
XkEuChE0SbnKBvH1RU7ksIb9
XkEuChE0SbnKBvH1RU7ksIb9u
XkEuChE0SbnKBvH1RU7ksIb9uu
XkEuChE0SbnKBvH1RU7ksIb9uuL
XkEuChE0SbnKBvH1RU7ksIb9uuLm
XkEuChE0SbnKBvH1RU7ksIb9uuLmI
XkEuChE0SbnKBvH1RU7ksIb9uuLmI7
XkEuChE0SbnKBvH1RU7ksIb9uuLmI7s
XkEuChE0SbnKBvH1RU7ksIb9uuLmI7sd
Contraseña: XkEuChE0SbnKBvH1RU7ksIb9uuLmI7sd
```
