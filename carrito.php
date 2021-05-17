<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="icon" href="assets/img/icono.ico">

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>𝘾𝙖𝙧𝙧𝙞𝙩𝙤</title>
        
        <link rel="stylesheet" href="assets/css/reset.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/contenido_index.css" />
        <link rel="stylesheet" href="assets/css/carrito.css" />
        <link rel="stylesheet" href="assets/css/notificacion.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
    </head>
    <body>
        <!-- ==================================== Bloque 1 ==================================== -->
        <div class="contenedor_barra_navegacion">
            <header class="cabecera">
                <article class="contenedor_logo flex">
                    <img src="assets/img/logo2.png" id="logoCambiar" alt="logo de la tienda" width="250px" />
                    <script src="assets/js/logotoindex.js"></script>
                </article>
                
                
                <article class="buscar">
                    <form action="" method="GET">
                        <input type="search" placeholder="Buscar"/>
                        <button type="submit"><img src="assets/img/search.svg" alt="buscar" class="icon"/></button>
                    </form>
                </article>
                
                
                <article class="botones flex">
                    <a href="#" class="botones_extra"><img src="assets/img/luna.svg" alt="modo nocturno" class="icon noche"></a>
                    
                    <%-- OCULTANDO NOTIFICACION DE CANTIDAD DE PRODUCTOS EN EL CARRITO SI ES CERO --%>
                    <a href="carrito.jsp" class="botones_extra" id="notificacion">
                        <img src="assets/img/carrito.svg" alt="carrito de compra" class="icon">
                    <%
                        Connection connection = null;
                        Statement state = null;
                        ResultSet resultSet = null;

                        String estado = "readonly";

                        try {
                        Class.forName("com.mysql.jdbc.Driver");
                        connection = DriverManager.getConnection("jdbc:mysql://localhost/pathfindingdbs?user=root&password");

                        state = connection.createStatement();
                        resultSet = state.executeQuery("select count(*) from carrito");

                        while (resultSet.next()){
                            if ( resultSet.getInt(1) == 0){
                                estado = "hidden";
                            }
                        %>
                            <span class="badge" <%=estado%>><%=resultSet.getString(1)%></span>
                    <%                                            
                        }
                        //cerrando
                        connection.close();
                        state.close();
                        resultSet.close();
                                
                        }catch (Exception e) {

                        }
                    %>
                    </a>                    
                    <%
                    // REVISAR COOKIES
                    String ocultar = "display: none;";
                    String registerState = "";

                    String sesion = request.getParameter("sesion");
                    
                    Cookie cookie = null;
                    Cookie[] cookies = null;
                    String nombreCliente = null;
                    String direccionCorreo = null;
                    
                    try{
                        if(sesion != null){
                            cookies = request.getCookies();
                            cookie = cookies[1];
                            cookie.setMaxAge(0);
                            response.addCookie(cookie);
                        }
                    }catch (Exception e) {}


                    try{
                
                    cookies = request.getCookies();
                    cookie = cookies[1];
                    
                    nombreCliente = cookie.getName();
                    direccionCorreo = cookie.getValue();
                    
                    if(nombreCliente != null){
                        registerState = "display: none;";
                        ocultar = "";
                    }
                    }catch(Exception e){}

                    %>
                    <a href="index.jsp?sesion=true&reload=true" class="botones_usuario" style="<%=ocultar%>">cerrar sesión</a>

                    <a href="login.jsp" class="botones_usuario" style="<%=registerState%>">iniciar sesión</a>
                    <a href="register.jsp" class="botones_usuario" style="<%=registerState%>">registrar</a>
                    <div style="<%=ocultar%>">
                        <img class="botones_usuario" src="https://img.icons8.com/cute-clipart/64/000000/add-user-male.png" style="margin-left: 24%;" alt="imagen de sesion"/>
                        <p style="color: #fc427b;"><%=direccionCorreo%></p>
                    </div>
                </article>
            </header>


            <nav class="barra_navegacion">
                <ul>
                    <%
                        try {
                        Class.forName("com.mysql.jdbc.Driver");
                        connection = DriverManager.getConnection("jdbc:mysql://localhost/pathfindingdbs?user=root&password");

                        state = connection.createStatement();
                        resultSet = state.executeQuery("select catProd from productos group by catProd limit 8");

                        while (resultSet.next()){
                    %>
                        <li><a href="index.jsp?cat=<%=resultSet.getString(1)%>"><%=resultSet.getString(1)%></a></li>
                    <%                                            
                        }
                        //cerrando
                        connection.close();
                        state.close();
                        resultSet.close();
                                
                        }catch (Exception e) {}
                    %>

                    <li><a href="#" class="mas">Más categorías</a></li>
                </ul>
            </nav>
        </div>
        <!-- ================================================================================== -->




                <%-- GENERANDO ARRAY DE INDICES DE PRODUCTOS PEDIDOS --%>
               <%
                ArrayList<String> pedidos = new ArrayList<String>();
                ArrayList<String> cantidades = new ArrayList<String>();

                //List<Integer> cantidades = new ArrayList<Integer>();

                try {
                        Class.forName("com.mysql.jdbc.Driver");
                        connection = DriverManager.getConnection("jdbc:mysql://localhost/pathfindingdbs?user=root&password");

                        state = connection.createStatement();
                        resultSet = state.executeQuery("select indice, cantidad from carrito");
                        
                        while (resultSet.next()){
                            String appended = resultSet.getString(1);
                            pedidos.add(appended);

                            String cantidad = resultSet.getString(2);
                            cantidades.add(cantidad);
                        }
                        //cerrando
                        connection.close();
                        state.close();
                        resultSet.close();
                         
                    }catch (Exception e) {
                        out.println(e);
                    }
                %>

                <%-- MUESTRA DE  PRODUCTOS PEDIDOS--%>
        <div class="wrap">
            <div class="contenedor_productos_comprados">
                <div class="producto_comprado">
                    <%
                    double total = 0;
                    double totalProd;

                    for(int i=0; i<pedidos.size(); ++i){
                        try{
                            Class.forName("com.mysql.jdbc.Driver");
                            connection = DriverManager.getConnection("jdbc:mysql://localhost/pathfindingdbs?user=root&password");

                            state = connection.createStatement();
                            resultSet = state.executeQuery("select mainProd, nombreProd, precioProd from productos where indiceProd='"+pedidos.get(i)+"'");
                            
                            while (resultSet.next()){
                                totalProd = Integer.parseInt(cantidades.get(i)) * resultSet.getInt(3);
                                total += totalProd;
                    %>
                    <div class="ctn_prod_com">
                        <img alt="" src="<%=resultSet.getString(1)%>" />
                    </div>
                    <div class="ctn_info">
                        <h3><%=resultSet.getString(2)%></h3>
                        <p>Cantidad: <%=cantidades.get(i)%></p>
                        <p>Precio Unidad: s/. <%=resultSet.getString(3)%></p>
                        <p>Precio Total: s/. <%=(Integer.parseInt(cantidades.get(i)) * resultSet.getInt(3))%></p>
                    </div>
                    <div class="botones_accion_comp">
                        <a href="delete.jsp?codigo=<%=pedidos.get(i)%>">Eliminar</a>                       
                    
                        <!-- <a href="delete.jsp?codigo=<%=pedidos.get(i)%>">Eliminar unidad</a> -->
                    </div>

                    <%
                            
                            }
                            //cerrando
                            connection.close();
                            state.close();
                            resultSet.close();
                            
                        }catch (Exception e) {
                            out.println(e);
                        }
                    }
                    
                    %>
                </div>
            </div>
            <%-- TOTAL --%>
            <div class="contenedor_precio_total">
                <div class="precio_total">
                    <h3 class="total">total: </h3>

                    <p class="num_total">s/.<%=total%></p>
                    <a href="carrito.jsp?pagar=true">Pagar</a>
                    <%
                    try{
                        String pagar = request.getParameter("pagar");
                        if (pagar != null){
                            if(direccionCorreo != null){
                                %>
                                <br><br>
                                <p style="color: #A6E22D;font-size: 20px; font-weight: 700;">Pago exitoso <%=direccionCorreo%></p>
                                <%

                            }else{
                                %>
                                <br><br>
                                <p style="color: #fc427b;font-size: 20px; font-weight: 700;;">Para pagar debe registrarse e iniciar sesión</p>
                                <%}
                        }

                    }
                    catch (Exception e){out.println(e);}

                    %>
                </div>
            </div>
        </div>







        <!-- ================================ Más categorias ================================ -->
        <div class="mas_categorias ocultar_extra">
            <ul>
            <% try {
                Class.forName("com.mysql.jdbc.Driver");
                connection = DriverManager.getConnection("jdbc:mysql://localhost/pathfindingdbs?user=root&password");

                state = connection.createStatement();
                resultSet = state.executeQuery("select catProd from productos group by catProd");

                while (resultSet.next()){
            %>
                <li><a href="index.jsp?cat=<%=resultSet.getString(1)%>"><%=resultSet.getString(1)%></a></li>
            <%
              }                      
                //cerrando
                connection.close();
                state.close();
                resultSet.close();
                        
                }catch (Exception e) {} 
            %>

            </ul>
        </div>
        <!-- ================================================================================ -->



        <script src="assets/js/mas_categorias.js"></script>
        <script src="assets/js/darkmode.js"></script>
    </body>
</html>