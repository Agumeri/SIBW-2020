/*Esta funcion despliega la seccion de los comentarios y los comentarios ya existentes, en esta práctica serán los predefinidos */
function desplegarComentarios()
{
    document.getElementsByClassName("Formulario")[0].style.visibility = "visible"
    document.getElementsByClassName("Formulario")[0].style.margin = 0
    mostrarComentariosExistentes()
}

/*Esta funcion hace que se generen dos comentarios y se publiquen directamente en la seccion de comentarios, simulando que estos son mensajes ya enviados con aterioridad*/
function mostrarComentariosExistentes()
{
    //Creamos el primer comentario predefinido
    var newDiv = document.createElement("div")
    newDiv.className = "user_comment"

    //Establecemos los separadores para separar eventos y comentarios, y comentarios entre ellos
    var separadorini = document.createElement("hr")
    var separadorfin = document.createElement("hr")
    separadorini.className = "separador"
    separadorfin.className = "separador"

    //Establecemos el nombre del propietario del comentario
    var newH = document.createElement("h2")
    var newUsername = document.createTextNode("Willy")
    newH.appendChild(newUsername)

    //Establecemos el contenido del comentario
    var newComment = document.createElement("p")
    var comentario = document.createTextNode("Pues el muñeco es para heroes. Metes un piño aleatorio y si le da al enemigo, 50% menos de la vida. Ojalá en el parche de mid-season lo dejen inutil.")
    newComment.appendChild(comentario)
    
    //Establecemos la hora de entrega del comentario
    var newDate = document.createElement("h4")
    newDate = document.createTextNode(29 + "/" + 2 + "/" + 2020 + " | " + 22 + ":" + 22)
 
    //Lo enlazamos todo al nodo newDiv
    newDiv.appendChild(separadorini)
    newDiv.appendChild(newH)
    newDiv.appendChild(newComment)
    newDiv.appendChild(newDate)
        
    //En el apartado "SeccionComentarios se añade el nuevo mensaje creado y almacenado en el nodo newDiv"
    document.getElementById("SeccionComentarios").appendChild(newDiv)
    
    /*******************************************************************************************************************/

    //Creamos el segundo comentario predefinido
    var div2 = document.createElement("div")
    div2.className = "user_comment"

    //Establecemos el nombre del propietario del comentario
    var h2 = document.createElement("h2")
    var user2 = document.createTextNode("JoJo")
    h2.appendChild(user2)

    //Establecemos el contenido del comentario
    var c2 = document.createElement("p")
    var comentario2 = document.createTextNode("Es un personaje bastante balanceado, todos los novatos deberían estar con él al menos los primeros meses para aprenderse todos los movimientos. En mi equipo siempre va a estar.")
    c2.appendChild(comentario2)

    //Establecemos la hora de entrega del comentario
    var newDate2 = document.createElement("h4")
    newDate2 = document.createTextNode(8 + "/" + 3 + "/" + 2020 + " | " + 12 + ":" + 31)
    
    //Lo enlazamos todo al nodo ndiv2
    div2.appendChild(separadorfin)
    div2.appendChild(h2)
    div2.appendChild(c2)
    div2.appendChild(newDate2)
    
    //En el apartado "SeccionComentarios" se añade el nuevo mensaje creado y almacenado en el nodo div2
    document.getElementById("SeccionComentarios").appendChild(div2)
}

function aniadeComentario(nombre, texto, correo){
    //Creamos un nuevo apartado y lo asociamos a una clase para aplicarle el css correspondiente
    var newDiv = document.createElement("div")
    newDiv.className = "user_comment"
    
    //Establecemos los separadores para separar eventos y comentarios, y comentarios entre ellos
    var separador = document.createElement("hr")
    separador.className = "separador"

    //Establecemos el nombre del propietario del comentario, el cual esta almacenado en la variable nombre
    var newH = document.createElement("h2")
    var newUsername = document.createTextNode(nombre.value)
    newH.appendChild(newUsername)

    //Establecemos el contenido del comentario, el cual está almacenado en la variable texto
    var newP = document.createElement("p")
    var comentario = document.createTextNode(texto.value)
    newP.appendChild(comentario)

    //Establecemos la hora de entrega del comentario
    date = document.createElement("h6")
    var d = new Date()
    var m = d.getMonth() + 1
    var h = d.getHours()
    var min = d.getMinutes()

    newDate = document.createTextNode(d.getDate() + "/" + m + "/" + d.getFullYear() + " | " + h + ":" + min)

    //Lo enlazamos todo al nodo newDiv
    newDiv.appendChild(separador)
    newDiv.appendChild(newH)
    newDiv.appendChild(newP)
    newDiv.appendChild(newDate)
    
    //En el apartado "SeccionComentarios" se añade el nuevo mensaje creado y almacenado en el nodo div2
    document.getElementById("SeccionComentarios").appendChild(newDiv)

    //Reseteamos los valores de las casillas del formulario a su valor inicial
    nombre.value = "";
    texto.value = "";
    correo.value = "";
}

//ESTA FUNCION SE UTILIZA CON LA MANERA ALTERNATIVA COMENTADA EN EL METODO VALIDARCOMENTARIO 
/******************************************************************************************/
/*Funcion que genera en el string salida n numero de asteriscos de longitud tam*/
function generaAsterisco(tam) {
    var salida = "";

    for(let i=0;i<tam;i++) 
        salida += "*";
    
    return salida;
}


//Array constante con palabras prohibidas que se censurarán al enviar el mensaje
const array = ["caca","culo","pedo","pis", "putos","nazi","puta","polla","subnormal","zorra"]

/*Funcion que hace de filtro para validar un mensaje enviado. Saltara un mensaje de aviso en dos ocasiones: si no se ha rellenado algún campo del formulario, o si el formato
  del correo es erroneo. Si */
function validarComentario(){
    var esValido=true

    //Obtenemos los datos enviados por el usuario a través del formulario
    var nombre=document.getElementById("user_name");
    var correo=document.getElementById("email");
    var texto=document.getElementById("Mensaje");

    //Comprobamos si se han rellenado las casillas de nombre y texto
    if(nombre.value == "" || texto.value == ""){
        esValido=false
    }

    //Si no se ha rellenado alguno de los dos anteriores, salta el mensaje y no se envía comentario
    if (esValido == false){
        alert ("RELLENA TODAS LAS CASILLAS PARA PODER ENVIAR EL COMENTARIO");
        return false;
    }
    
    //Si no  se ha rellenado la casilla correspondiente al correo o este no tiene el formato adecuado, salta el mensaje y no se envia el comentario
    if(!validacionEmail(correo.value)){
        alert("EL EMAIL ES INCORRECTO, VUELVA A INTRODUCIRLO")
        return false;
    }
    
    //MANERA ALTERNATIVA DE CAMBIAR PALABRAS PROHIBIDAS POR ASTERISCOS
    /**************************************************************************/

    //Pasamos un filtro que irá sustituyendo las palabras que estan en el vector array (palabras prohibidas) por asteriscos de la longitud de la palabra
    //array.forEach(itm => texto.value = texto.value.replace(itm, generaAsterisco(itm.length)));

    /**************************************************************************/


    //Se llama a la funcion aniadeComentario para añadirlo finalmente a la seccion de comentarios
    aniadeComentario(nombre, texto, correo)

}


//Funcion encargada de sustituir las palabras por asteriscos EN TIEMPO DE ESCRITURA si estas estan dentro del array con las palabras baneadas
function cambiarPalabraAsteriscos(){
    //Obtenemos el mensaje en tiempo de escritura
    const texto = document.getElementById("Mensaje")

    //El array lo ponemos como variable local con formato regex, para que actue en replace de manera similar a como comprobamos el correo
    var array = /caca|culo|pedo|pis|putos|nazi|puta|polla|subnormal|zorra/gi;

    //Usamos una funcion auxiliar par 
    var texto_actual = texto.value

    //Si algo del texto corresponde a alguna de las palabras prohibidas (contenido de la variable constante array)
    var cambiazo = texto_actual.replace(array,'****');

    //El contenido que hay hasta el momento se cambia por 
    document.getElementById("Mensaje").value = cambiazo

}

//Funcion encargada de comprobar si el formato de la variable mail es correcto
function validacionEmail(mail){
    if (mail=="") return false;
    
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
        return true;
    }

    return false;
    
}

//Estructura de TODOS los comentarios (han de tener na estructura parecida)
/*
                <div>
                    <!--Comentario de ejemplo 1-->
                    <p class="username">Willy</p>
                    <p class="user_comment">Pues el muñeco es para heroes. Metes un piño aleatorio y si le da al enemigo, 50% menos de la vida. 
                        Ojalá en el parche de mid-season lo dejen inutil. 
                    </p>
                    <p class="fecha">08/03/2020 | 04:20</p>

                    <hr style=" margin-right: 10%;" size="2px" color="black"/>
                    
                    <!--Comentario de ejemplo 2-->
                    <p class="username">Vegetta</p>
                    <p class="user_comment">Es un personaje bastante balanceado, todos los novatos deberían estar con él al menos
                        los primeros meses para aprenderse todos los movimientos. En mi equipo siempre va a estar. 
                    </p>
                    <p class="fecha">11/03/2020 | 00:39</p>
                </div>
*/